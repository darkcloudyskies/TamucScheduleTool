<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/10/2018
 * Time: 4:43 PM
 */

class DateRange
{
    private $startTime;
    private $endTime;

    /**
     * @return mixed
     */
    public function getStartTime() : string
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

}