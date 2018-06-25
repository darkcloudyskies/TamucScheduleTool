<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 6:37 PM
 */

require_once 'Course.php';
require_once 'Professor.php';

class Section
{
    private $sectionId;
    private $startTime;
    private $endTime;
    private $startDate;
    private $endDate;
    private $weekDays;
    private $location;
    private $sectionNum;
    private $callNum;

    private $course;
    private $professors = array();

    /**
     * @return mixed
     */
    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    /**
     * @param mixed $sectionId
     */
    public function setSectionId(int $sectionId): void
    {
        $this->sectionId = $sectionId;
    }

    /**
     * @return mixed
     */
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime(string $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime(): string
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime(string $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate(string $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getWeekDays(): string
    {
        return $this->weekDays;
    }

    /**
     * @param mixed $weekDays
     */
    public function setWeekDays(string $weekDays): void
    {
        $this->weekDays = $weekDays;
    }

    /**
     * @return mixed
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getSectionNum(): string
    {
        return $this->sectionNum;
    }

    /**
     * @param mixed $sectionNum
     */
    public function setSectionNum(string $sectionNum): void
    {
        $this->sectionNum = $sectionNum;
    }

    /**
     * @return mixed
     */
    public function getCallNum(): int
    {
        return $this->callNum;
    }

    /**
     * @param mixed $callNum
     */
    public function setCallNum(int $callNum): void
    {
        $this->callNum = $callNum;
    }

    /**
     * @return mixed
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }


    /**
     * @return array
     */
    public function getProfessors(): array
    {
        return $this->professors;
    }

    /**
     * @param array $professors
     */
    public function setProfessors(array $professors): void
    {
        $this->professors = $professors;
    }

    /**
     * @return mixed
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }
}