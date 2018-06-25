<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 4:20 PM
 */

require_once 'Major.php';
require_once 'Minor.php';
require_once 'Course.php';
require_once 'Schedule.php';

class Student
{
    private $studentId;
    private $studentName;
    private $username;
    private $password;

    private $majors = array();
    private $minors = array();
    private $coursesTaken = array();
    private $schedule;

    /**
     * @return mixed
     */
    public function getStudentName(): string
    {
        return $this->studentName;
    }

    /**
     * @param mixed $studentName
     */
    public function setStudentName(string $studentName): void
    {
        $this->studentName = $studentName;
    }

    /**
     * @return mixed
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStudentId(): int
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId(int $studentId): void
    {
        $this->studentId = $studentId;
    }

    /**
     * @return array
     */
    public function getMajors(): array
    {
        return $this->majors;
    }

    /**
     * @param array $majors
     */
    public function setMajors(array $majors): void
    {
        $this->majors = $majors;
    }

    /**
     * @return mixed
     */
    public function getSchedule(): Schedule
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     */
    public function setSchedule(Schedule $schedule): void
    {
        $this->schedule = $schedule;
    }

    /**
     * @return array
     */
    public function getMinors(): array
    {
        return $this->minors;
    }

    /**
     * @param array $minors
     */
    public function setMinors(array $minors): void
    {
        $this->minors = $minors;
    }

    /**
     * @return array
     */
    public function getCoursesTaken(): array
    {
        return $this->coursesTaken;
    }

    /**
     * @param array $coursesTaken
     */
    public function setCoursesTaken(array $coursesTaken): void
    {
        $this->coursesTaken = $coursesTaken;
    }
}