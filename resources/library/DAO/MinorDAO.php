<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:36 PM
 */

require_once __DIR__.'/../database/DatabaseConnection.php';
require_once __DIR__.'/CourseDAO.php';

class MinorDAO
{
    public function getAllMinors(): array
    {
        $minors = array();

        $sql = "SELECT * FROM minor";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $minor = new minor();

                $minor->setCourses((new CourseDAO())->getCoursesFromMinorId($row["minorId"]));
                $minor->setMinorId($row["minorId"]);
                $minor->setMinorName($row["minorName"]);

                $minors[] = $minor;
            }
        }

        $conn->close();

        return $minors;
    }

    public function getMinorFromId(int $minorId): Minor
    {
        $minor = new Minor();

        $sql = "SELECT * FROM minor
                WHERE minorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$minorId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $minor->setCourses((new CourseDAO())->getCoursesFromMinorId($row["minorId"]));
            $minor->setMinorId($row["minorId"]);
            $minor->setMinorName($row["minorName"]);
        }

        $conn->close();

        return $minor;
    }

    public function getMinorFromName(string $minorName): Minor
    {
        $minor = new minor();

        $sql = "SELECT * FROM minor
                WHERE minorName = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("s",$minorName);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $minor->setCourses((new CourseDAO())->getCoursesFromMinorId($row["minorId"]));
            $minor->setMinorId($row["minorId"]);
            $minor->setMinorName($row["minorName"]);
        }

        $conn->close();

        return $minor;
    }

    public function getMinorsFromStudentId(int $studentId): array
    {
        $minors = array();

        $sql = "SELECT * FROM minor
                WHERE minorId IN
                (SELECT minorId FROM studentminor
                WHERE studentId = ?)";
        
        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$studentId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $minor = new minor();

                $minor->setCourses((new CourseDAO())->getCoursesFromMinorId($row["minorId"]));
                $minor->setMinorId($row["minorId"]);
                $minor->setMinorName($row["minorName"]);

                $minors[] = $minor;
            }
        }

        $conn->close();

        return $minors;
    }

    public function updateMinor(Minor $minor): bool
    {
        $sql = "UPDATE minor SET
                minorName = ?
                WHERE minorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("si",$minor->getMinorName(),$minor->getMinorId());

        $result = $pst->execute();
        $result &= $this->updateCourseMinor($minor);

        $conn->close();

        return $result;
    }

    private function updateCourseMinor(Minor $minor): bool
    {
        $sql = "DELETE FROM courseminor WHERE minorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        $pst->bind_param("i",$minor->getMinorId());
        $result &= $pst->execute();
        $result &= $this->insertCourseMinor($minor);

        $conn->close();

        return $result;
    }

    public function insertMinor(Minor $minor): bool
    {
        $sql = "INSERT INTO minor (minorName)
                VALUES (?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("s",$minor->getMinorId());

        $result = $pst->execute();
        $result &= $this->insertCourseMinor($minor);

        $minor->setMinorId($conn->insert_id);

        $conn->close();

        return $result;
    }

    private function insertCourseMinor(Minor $minor): bool
    {
        $sql = "INSERT INTO courseminor (courseId, minorId)
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($minor->getCourses() as $course)
        {
            $pst->bind_param("ii",$course->getCourseId(),$minor->getMinorId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function deleteMinor(Minor $minor): bool
    {
        $sql = "DELETE FROM minor
                WHERE minorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$minor->getMinorId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}