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
    private $maximumOnlineHours;

    private $filter;

    private $sectionIdBlackList;

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
    public function getMaximumOnlineHours(): int
    {
        return $this->maximumOnlineHours;
    }

    /**
     * @param mixed $maximumOnlineHours
     */
    public function setMaximumOnlineHours(int $maximumOnlineHours): void
    {
        $this->maximumOnlineHours = $maximumOnlineHours;
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
    public function getSectionIdBlackList(): array
    {
        return $this->sectionIdBlackList;
    }

    /**
     * @param mixed $sectionIdBlackList
     */
    public function setSectionIdBlackList(array $sectionIdBlackList): void
    {
        $this->sectionIdBlackList = $sectionIdBlackList;
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