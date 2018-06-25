<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 4:38 PM
 */

require_once 'Section.php';

class Schedule
{
    private $scheduleId;
    private $scheduleName;

    private $sections = array();

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

}