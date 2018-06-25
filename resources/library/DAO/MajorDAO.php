<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:35 PM
 */

require_once '../database/DatabaseConnection.php';
require_once 'CourseDAO.php';

class MajorDAO
{
    public function getAllMajors(): array
    {
        $majors = array();

        $sql = "SELECT * FROM major";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $major = new major();

                $major->setCourses((new CourseDAO())->getCoursesFromMajorId($row["majorId"]));
                $major->setMajorId($row["majorId"]);
                $major->setMajorName($row["majorName"]);

                $majors[] = $major;
            }
        }

        $conn->close();

        return $majors;
    }

    public function getMajorFromId(int $majorId): Major
    {
        $major = new major();

        $sql = "SELECT * FROM major
                WHERE majorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$majorId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $major->setCourses((new CourseDAO())->getCoursesFromMajorId($row["majorId"]));
            $major->setMajorId($row["majorId"]);
            $major->setMajorName($row["majorName"]);
        }

        $conn->close();

        return $major;
    }

    public function getMajorFromName(String $majorName): Major
    {
        $major = new major();

        $sql = "SELECT * FROM major
                WHERE majorName = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("s",$majorName);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $major->setCourses((new CourseDAO())->getCoursesFromMajorId($row["majorId"]));
            $major->setMajorId($row["majorId"]);
            $major->setMajorName($row["majorName"]);
        }

        $conn->close();

        return $major;
    }

    public function getMajorsFromStudentId(int $studentId): array
    {
        $majors = array();

        $sql = "SELECT * FROM major
                WHERE majorId IN
                (SELECT majorId FROM studentmajor
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
                $major = new major();

                $major->setCourses((new CourseDAO())->getCoursesFromMajorId($row["majorId"]));
                $major->setMajorId($row["majorId"]);
                $major->setMajorName($row["majorName"]);

                $majors[] = $major;
            }
        }

        $conn->close();

        return $majors;
    }

    public function updateMajor(Major $major): bool
    {
        $sql = "UPDATE major SET
                majorId = ?,
                majorName = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("is",$major->getMajorId(),$major->getMajorName());

        $result = $pst->execute();
        $result &= $this->updateCourseMajor($major);

        $conn->close();

        return $result;
    }

    private function updateCourseMajor(Major $major): bool
    {
        $sql = "UPDATE coursemajor SET
                courseId = ?,
                majorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($major->getCourses() as $course)
        {
            $pst->bind_param("ii",$course->getCourseId(),$major->getMajorId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function insertMajor(Major $major): bool
    {
        $sql = "INSERT INTO major (majorName)
                VALUES (?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("s",$major->getMajorName());

        $result = $pst->execute();
        $result &= $this->insertCourseMajor($major);

        $major->setMajorId($conn->insert_id);

        $conn->close();

        return $result;
    }

    private function insertCourseMajor(Major $major): bool
    {
        $sql = "INSERT INTO coursemajor (courseId, majorId)
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($major->getCourses() as $course)
        {
            $pst->bind_param("ii",$course->getCourseId(),$major->getMajorId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function deleteMajor(Major $major): bool
    {
        $sql = "DELETE FROM major
                WHERE majorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$major->getMajorId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}