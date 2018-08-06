<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 4:38 PM
 */

require_once 'Section.php';

class Schedule implements JsonSerializable
{
    private $scheduleId;
    private $scheduleName;

    private $sections = array();

    private $studentId;

    /**
     * @return mixed
     */
    public function getScheduleId(): int
    {
        return $this->scheduleId;
    }

    /**
     * @param mixed $scheduleId
     */
    public function setScheduleId(int $scheduleId): void
    {
        $this->scheduleId = $scheduleId;
    }

    /**
     * @return mixed
     */
    public function getScheduleName(): string
    {
        return $this->scheduleName;
    }

    /**
     * @param mixed $scheduleName
     */
    public function setScheduleName(string $scheduleName): void
    {
        $this->scheduleName = $scheduleName;
    }

    /**
     * @return array
     */
    public function getSections(): array
    {
        return $this->sections;
    }

    /**
     * @param array $sections
     */
    public function setSections(array $sections): void
    {
        $this->sections = $sections;
    }

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId): void
    {
        $this->studentId = $studentId;
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
            'studentId' => $this->getStudentId(),
            'scheduleId' => $this->getScheduleId(),
            'sections' => $this->getSections(),
            'scheduleName' => $this->getScheduleName()
        ];
    }
}