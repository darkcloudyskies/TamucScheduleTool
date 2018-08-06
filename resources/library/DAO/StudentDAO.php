<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 2:20 PM
 */

require_once '../database/DatabaseConnection.php';
require_once 'MajorDAO.php';
require_once 'MinorDAO.php';
require_once 'CourseDAO.php';
require_once 'ScheduleDAO.php';

class StudentDAO
{
    public function getAllStudents(): array
    {
        $students = array();

        $sql = "SELECT * FROM student";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $student = new student();

                $student->setMajors((new MajorDAO())->getMajorsFromStudentId($row["studentId"]));
                $student->setMinors((new MinorDAO())->getMinorsFromStudentId($row["studentId"]));
                $student->setPassword($row["password"]);
                $student->setSchedule((new ScheduleDAO)->getScheduleFromStudentId($row["studentId"]));
                $student->setStudentId($row["studentId"]);
                $student->setStudentName($row["studentName"]);
                $student->setUsername($row["username"]);
                $student->setCoursesTaken((new CourseDAO())->getCoursesFromStudentId($row["studentId"]));

                $students[] = $student;
            }
        }

        $conn->close();

        return $students;
    }

    public function getStudentFromId(int $studentId): Student
    {
        $student = new Student();

        $sql = "SELECT * FROM student
                WHERE studentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$studentId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $student->setMajors((new MajorDAO())->getMajorsFromStudentId($row["studentId"]));
            $student->setMinors((new MinorDAO())->getMinorsFromStudentId($row["studentId"]));
            $student->setPassword($row["password"]);
            $student->setSchedule((new ScheduleDAO)->getScheduleFromStudentId($row["studentId"]));
            $student->setStudentId($row["studentId"]);
            $student->setStudentName($row["studentName"]);
            $student->setUsername($row["username"]);
        }

        $conn->close();

        return $student;
    }

    public function getStudentFromUsername(string $username): Student
    {
        $student = new Student();

        $sql = "SELECT * FROM student
                WHERE username = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("s",$username);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $student->setMajors((new MajorDAO())->getMajorsFromStudentId($row["studentId"]));
            $student->setMinors((new MinorDAO())->getMinorsFromStudentId($row["studentId"]));
            $student->setPassword($row["password"]);
            $student->setSchedule((new ScheduleDAO)->getScheduleFromStudentId($row["studentId"]));
            $student->setStudentId($row["studentId"]);
            $student->setStudentName($row["studentName"]);
            $student->setUsername($row["username"]);
        }

        $conn->close();

        return $student;
    }

    public function updateStudent(Student $student): bool
    {
        $sql = "UPDATE student SET
                studentId = ?,
                studentName = ?,
                username = ?,
                password = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("isss",$student->getStudentId(),$student->getStudentName(),$student->getUsername(),$student->getPassword());

        $result = $pst->execute();
        $result &= $this->updateStudentCourse($student);
        $result &= $this->updateStudentMajor($student);
        $result &= $this->updateStudentMinor($student);

        $conn->close();

        return $result;
    }

    private function updateStudentMajor(Student $student): bool
    {
        $sql = "UPDATE studentmajor SET
                studentId = ?,
                majorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($student->getMajors() as $major)
        {
            $pst->bind_param("ii",$student->getStudentId(),$major->getMajorId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    private function updateStudentMinor(Student $student): bool
    {
        $sql = "UPDATE studentminor SET
                studentId = ?,
                minorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($student->getMinors() as $minor)
        {
            $pst->bind_param("ii",$student->getStudentId(),$minor->getMinorId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    private function updateStudentCourse(Student $student): bool
    {
        $sql = "UPDATE studentcourse SET
                studentId = ?,
                courseId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($student->getCoursesTaken() as $course)
        {
            $pst->bind_param("ii",$student->getStudentId(),$course->getCourseId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function insertStudent(Student $student): bool
    {
        $sql = "INSERT INTO student (studentName, username, password)
                VALUES (?,?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("sss",$student->getStudentName(),$student->getUsername(),$student->getPassword());

        $result = $pst->execute();
        $result &= $this->insertStudentCourse($student);
        $result &= $this->insertStudentMajor($student);
        $result &= $this->insertStudentMinor($student);

        $student->setStudentId($conn->insert_id);

        $conn->close();

        return $result;
    }

    private function insertStudentMajor(Student $student): bool
    {
        $sql = "INSERT INTO studentmajor (studentId, majorId) 
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($student->getMajors() as $major)
        {
            $pst->bind_param("ii",$student->getStudentId(),$major->getMajorId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    private function insertStudentMinor(Student $student): bool
    {
        $sql = "INSERT INTO studentminor (studentId, minorId) 
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($student->getMinors() as $minor)
        {
            $pst->bind_param("ii",$student->getStudentId(),$minor->getMinorId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    private function insertStudentCourse(Student $student): bool
    {
        $sql = "INSERT INTO studentcourse (studentId, courseId) 
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($student->getCoursesTaken() as $course)
        {
            $pst->bind_param("ii",$student->getStudentId(),$course->getCourseId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function deleteStudent(Student $student): bool
    {
        $sql = "DELETE FROM student
                WHERE studentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$student->getStudentId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}
