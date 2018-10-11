<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/10/2018
 * Time: 4:35 PM
 */

class ScheduleBuilderRequest
{
    private $studentId;

    private $minimumHours;
    private $maximumHours;
    private $minimumOnlineHours;

    private $filter;

    private $courseIdBlackList;

    /**
     * @return mixed
     */
    public function getMinimumHours(): int
    {
        return $this->minimumHours;
    }

    /**
     * @param mixed $minimumHours
     */
    public function setMinimumHours(int $minimumHours): void
    {
        $this->minimumHours = $minimumHours;
    }

    /**
     * @return mixed
     */
    public function getMaximumHours(): int
    {
        return $this->maximumHours;
    }

    /**
     * @param mixed $maximumHours
     */
    public function setMaximumHours(int $maximumHours): void
    {
        $this->maximumHours = $maximumHours;
    }

    /**
     * @return mixed
     */
    public function getMinimumOnlineHours(): int
    {
        return $this->minimumOnlineHours;
    }

    /**
     * @param mixed $minimumOnlineHours
     */
    public function setMinimumOnlineHours(int $minimumOnlineHours): void
    {
        $this->minimumOnlineHours = $minimumOnlineHours;
    }

    /**
     * @return mixed
     */
    public function getFilter(): Filter
    {
        return $this->filter;
    }

    /**
     * @param mixed $filter
     */
    public function setFilter(Filter $filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @return mixed
     */
    public function getCourseIdBlackList(): array
    {
        return $this->courseIdBlackList;
    }

    /**
     * @param mixed $courseIdBlackList
     */
    public function setCourseIdBlackList(array $courseIdBlackList): void
    {
        $this->courseIdBlackList = $courseIdBlackList;
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
}