<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 11/7/2018
 * Time: 7:40 PM
 */

class TimeRange
{
    private $startTime;
    private $endTime;

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime): void
    {
        if (strlen($startTime) == 5)
        {
            $startTime .= ':00';
        }
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime): void
    {
        if (strlen($endTime) == 5)
        {
            $endTime .= ':00';
        }
        $this->endTime = $endTime;
    }
}