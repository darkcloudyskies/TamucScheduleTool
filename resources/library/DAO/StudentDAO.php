<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 2:20 PM
 */

require_once __DIR__.'/../database/DatabaseConnection.php';
require_once __DIR__.'/MajorDAO.php';
require_once __DIR__.'/MinorDAO.php';
require_once __DIR__.'/CourseDAO.php';
require_once __DIR__.'/ScheduleDAO.php';

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
            $students = $this->getStudentsFromResult($result);
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
            $student = $this->getStudentFromRow($row);
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
            $student = $this->getStudentFromRow($row);
        }

        $conn->close();

        return $student;
    }

    private function getStudentsFromResult(mysqli_result $result): array
    {
        $students = array();

        while($row = $result->fetch_assoc())
        {
            $students[] = $this->getStudentFromRow($row);
        }

        return $students;
    }

    private function getStudentFromRow(array $row): Student
    {
        $student = new Student();

        $student->setMajors((new MajorDAO())->getMajorsFromStudentId($row["studentId"]));
        $student->setMinors((new MinorDAO())->getMinorsFromStudentId($row["studentId"]));
        $student->setPassword($row["password"]);
        $student->setSchedule((new ScheduleDAO)->getScheduleFromStudentId($row["studentId"]));
        $student->setStudentId($row["studentId"]);
        $student->setStudentName($row["studentName"]);
        $student->setUsername($row["username"]);
        $student->setCoursesTaken((new CourseDAO())->getCoursesFromStudentId($row["studentId"]));

        return $student;
    }

    public function updateStudent(Student $student): bool
    {
        $sql = "UPDATE student SET
                studentName = ?,
                username = ?,
                password = ?
                WHERE studentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("sssi",$student->getStudentName(),$student->getUsername(),$student->getPassword(),$student->getStudentId());

        $result = $pst->execute();
        $result &= $this->updateStudentCourse($student);
        $result &= $this->updateStudentMajor($student);
        $result &= $this->updateStudentMinor($student);

        $conn->close();

        return $result;
    }

    private function updateStudentMajor(Student $student): bool
    {
        $sql = "DELETE FROM studentmajor WHERE studentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        $pst->bind_param("i",$student->getStudentId());
        $result &= $pst->execute();
        $result &= $this->insertStudentMajor($student);


        $conn->close();

        return $result;
    }

    private function updateStudentMinor(Student $student): bool
    {
        $sql = "DELETE FROM studentminor WHERE studentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        $pst->bind_param("i",$student->getStudentId());
        $result &= $pst->execute();
        $result &= $this->insertStudentMinor($student);


        $conn->close();

        return $result;
    }

    private function updateStudentCourse(Student $student): bool
    {
        $sql = "DELETE FROM studentcourse WHERE studentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        $pst->bind_param("i",$student->getStudentId());
        $result &= $pst->execute();
        $result &= $this->insertStudentCourse($student);


        $conn->close();

        return $result;
    }

    public function insertStudent(Student $student): bool
    {
        $sql = "INSERT INTO student (studentName, username, password)
                VALUES (?,?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        if($pst = $conn->prepare($sql))
        {

        }
        else {
            $error = $conn->errno . ' ' . $conn->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }

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
