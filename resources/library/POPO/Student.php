<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 4:20 PM
 */

require_once __DIR__.'/Major.php';
require_once __DIR__.'/Minor.php';
require_once __DIR__.'/Course.php';
require_once __DIR__.'/Schedule.php';

class Student implements JsonSerializable
{
    private $key = "G";

    private $studentId = -1;
    private $studentName;
    private $username;
    private $password;

    private $majors = array();
    private $minors = array();
    private $coursesTaken = array();
    private $schedule;


    public function getNameFromToken(string $token): string
    {
        $studentname = "";
        $token = rawurldecode($token);
        for($i=0;$i<strlen($token);)
        {
            for($j=0;$j<strlen($this->key ) && $i<strlen($token);$j++,$i++)
            {
                $studentname .= $token{$i} ^ $this->key{$j};
            }
        }
        return $studentname;
    }

    public function getTokenFromName(string $studentname): string
    {
        $token = "";
        for($i=0;$i<strlen($studentname);)
        {
            for($j=0;$j<strlen($this->key) && $i<strlen($studentname);$j++,$i++)
            {
                $token .= $studentname{$i} ^ $this->key{$j};
            }
        }
        return rawurlencode($token);
    }

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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            //'password' => $this->getPassword(),
            'username' => $this->getUsername(),
            'coursesTaken' => $this->getCoursesTaken(),
            'minors' => $this->getMinors(),
            'studentId' => $this->getStudentId(),
            'studentName' => $this->getStudentName(),
            'majors' => $this->getMajors(),
            'schedule' => $this->getSchedule()
        ];
    }

    public function __toString() : String
    {
        return $this->getStudentId();
    }
}