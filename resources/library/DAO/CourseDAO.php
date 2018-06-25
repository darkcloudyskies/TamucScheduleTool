<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:30 PM
 */

require_once '../database/DatabaseConnection.php';
require_once 'PrefixDAO.php';
require_once 'CourseRatingDAO.php';

class CourseDAO
{
    public function getAllCourses(): array
    {
        $courses = array();

        $sql = "SELECT * FROM course";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $course = new Course();

                $course->setCourseId($row["courseId"]);
                $course->setCourseName($row["courseName"]);
                $course->setCourseNum($row["courseNum"]);
                $course->setCourseRatings((new CourseRatingDAO())->getCourseRatingsFromCourseId($row["courseId"]));
                $course->setHours($row["hours"]);
                $course->setPrefix((new PrefixDAO())->getPrefixFromId($row["prefixId"]));
                $course->setCoursePrereqs($this->getCoursePrereqFromId($row{"courseId"}));

                $courses[] = $course;
            }
        }

        $conn->close();

        return $courses;
    }

    public function getCourseFromId(int $courseId): Course
{
    $course = new Course();

    $sql = "SELECT * FROM course
                WHERE courseId = ?";

    $conn = (new DatabaseConnection())->getConnection();
    $pst = $conn->prepare($sql);
    $pst->bind_param("i",$courseId);
    $pst->execute();
    $result = $pst->get_result();

    if($result->num_rows > 0 && $row = $result->fetch_assoc())
    {
        $course->setCourseId($row["courseId"]);
        $course->setCourseName($row["courseName"]);
        $course->setCourseNum($row["courseNum"]);
        $course->setCourseRatings((new CourseRatingDAO())->getCourseRatingsFromCourseId($row["courseId"]));
        $course->setHours($row["hours"]);
        $course->setPrefix((new PrefixDAO())->getPrefixFromId($row["prefixId"]));
        $course->setCoursePrereqs($this->getCoursePrereqFromId($row{"courseId"}));
    }

    $conn->close();

    return $course;
}

    public function getCourseFromPrefixAndCourseNum(int $prefixId,int $courseNum): Course
    {
        $course = new Course();

        $sql = "SELECT * FROM course
                WHERE prefixId = ?
                AND courseNum = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("ii",$prefixId,$courseNum);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $course->setCourseId($row["courseId"]);
            $course->setCourseName($row["courseName"]);
            $course->setCourseNum($row["courseNum"]);
            $course->setCourseRatings((new CourseRatingDAO())->getCourseRatingsFromCourseId($row["courseId"]));
            $course->setHours($row["hours"]);
            $course->setPrefix((new PrefixDAO())->getPrefixFromId($row["prefixId"]));
            $course->setCoursePrereqs($this->getCoursePrereqFromId($row{"courseId"}));
        }

        $conn->close();

        return $course;
    }

    public function getCoursePrereqFromId(int $courseId): array
    {
        $courses = array();

        $sql = "SELECT *
                FROM course
                WHERE courseId IN 
                  (SELECT preReqId 
                  FROM courseprereq
                  WHERE courseId = ?)";
                

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$courseId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $course = new Course();

                $course->setCourseId($row["courseId"]);
                $course->setCourseName($row["courseName"]);
                $course->setCourseNum($row["courseNum"]);
                $course->setCourseRatings((new CourseRatingDAO())->getCourseRatingsFromCourseId($row["courseId"]));
                $course->setHours($row["hours"]);
                $course->setPrefix((new PrefixDAO())->getPrefixFromId($row["prefixId"]));
                $course->setCoursePrereqs($this->getCoursePrereqFromId($row{"courseId"}));

                $courses[] = $course;
            }
        }

        $conn->close();

        return $courses;
    }

    public function getCoursesFromMajorId(int $majorId): array
    {
        $courses = array();

        $sql = "SELECT *
                FROM course
                WHERE courseId IN 
                  (SELECT courseId 
                  FROM coursemajor
                  WHERE majorId = ?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$majorId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $course = new Course();

                $course->setCourseId($row["courseId"]);
                $course->setCourseName($row["courseName"]);
                $course->setCourseNum($row["courseNum"]);
                $course->setCourseRatings((new CourseRatingDAO())->getCourseRatingsFromCourseId($row["courseId"]));
                $course->setHours($row["hours"]);
                $course->setPrefix((new PrefixDAO())->getPrefixFromId($row["prefixId"]));
                $course->setCoursePrereqs($this->getCoursePrereqFromId($row{"courseId"}));

                $courses[] = $course;
            }
        }

        $conn->close();

        return $courses;
    }

    public function getCoursesFromMinorId(int $minorId): array
    {
        $courses = array();

        $sql = "SELECT *
                FROM course
                WHERE courseId IN 
                  (SELECT courseId 
                  FROM courseminor
                  WHERE minorId = ?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$minorId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $course = new Course();

                $course->setCourseId($row["courseId"]);
                $course->setCourseName($row["courseName"]);
                $course->setCourseNum($row["courseNum"]);
                $course->setCourseRatings((new CourseRatingDAO())->getCourseRatingsFromCourseId($row["courseId"]));
                $course->setHours($row["hours"]);
                $course->setPrefix((new PrefixDAO())->getPrefixFromId($row["prefixId"]));
                $course->setCoursePrereqs($this->getCoursePrereqFromId($row{"courseId"}));

                $courses[] = $course;
            }
        }

        $conn->close();

        return $courses;
    }

    public function getCoursesFromStudentId(int $studentId): array
    {
        $courses = array();

        $sql = "SELECT *
                FROM course
                WHERE courseId IN 
                  (SELECT courseId 
                  FROM studentcourse
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
                $course = new Course();

                $course->setCourseId($row["courseId"]);
                $course->setCourseName($row["courseName"]);
                $course->setCourseNum($row["courseNum"]);
                $course->setCourseRatings((new CourseRatingDAO())->getCourseRatingsFromCourseId($row["courseId"]));
                $course->setHours($row["hours"]);
                $course->setPrefix((new PrefixDAO())->getPrefixFromId($row["prefixId"]));
                $course->setCoursePrereqs($this->getCoursePrereqFromId($row{"courseId"}));

                $courses[] = $course;
            }
        }

        $conn->close();

        return $courses;
    }

    public function updateCourse(Course $course): bool
    {
        $sql = "UPDATE course SET 
                prefixId = ?,
                courseName = ?,
                hours = ?,
                courseNum = ?
                WHERE courseId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("isiii",$course->getPrefix()->getPrefixId(),$course->getCourseName(),$course->getHours(),$course->getCourseNum(),$course->getCourseId());

        $result = $pst->execute();
        $result &= $this->updateCoursePrereq($course);

        $conn->close();

        return $result;
    }

    private function updateCoursePrereq(Course $course): bool
    {

    }

    public function insertCourse(Course $course): bool
    {
        $sql = "INSERT INTO course (prefixId, courseName, hours, courseNum)
                VALUES (?,?,?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);


        $pst->bind_param("isii",$course->getPrefix()->getPrefixId(),$course->getCourseName(),$course->getHours(),$course->getCourseNum());

        $result = $pst->execute();
        $result &= $this->insertCoursePrereq($course);

        $course->setCourseId($conn->insert_id);

        $conn->close();

        return $result;
    }

    private function insertCoursePrereq(Course $course): bool
    {
        $sql = "INSERT INTO courseprereq (courseId, preReqId)
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($course->getCoursePrereqs() as $coursePrereq)
        {
            $pst->bind_param("ii",$course->getCourseId(),$coursePrereq->getCourseId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function deleteCourse(Course $course): bool
    {
        $sql = "DELETE FROM course
                WHERE courseId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$course->getCourseId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}