<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/10/2018
 * Time: 4:41 PM
 */

class Filter
{
    private $mondayRanges;
    private $tuesdayRanges;
    private $wednesdayRanges;
    private $thursdayRanges;
    private $fridayRanges;

    /**
     * @return mixed
     */
    public function getMondayRanges() : array
    {
        return $this->mondayRanges;
    }

    /**
     * @param mixed $mondayRanges
     */
    public function setMondayRanges(array $mondayRanges): void
    {
        $this->mondayRanges = $mondayRanges;
    }

    /**
     * @return mixed
     */
    public function getTuesdayRanges() : array
    {
        return $this->tuesdayRanges;
    }

    /**
     * @param mixed $tuesdayRanges
     */
    public function setTuesdayRanges(array $tuesdayRanges): void
    {
        $this->tuesdayRanges = $tuesdayRanges;
    }

    /**
     * @return mixed
     */
    public function getWednesdayRanges() : array
    {
        return $this->wednesdayRanges;
    }

    /**
     * @param mixed $wednesdayRanges
     */
    public function setWednesdayRanges(array $wednesdayRanges): void
    {
        $this->wednesdayRanges = $wednesdayRanges;
    }

    /**
     * @return mixed
     */
    public function getThursdayRanges(): array
    {
        return $this->thursdayRanges;
    }

    /**
     * @param mixed $thursdayRanges
     */
    public function setThursdayRanges(array $thursdayRanges): void
    {
        $this->thursdayRanges = $thursdayRanges;
    }

    /**
     * @return mixed
     */
    public function getFridayRanges(): array
    {
        return $this->fridayRanges;
    }

    /**
     * @param mixed $fridayRanges
     */
    public function setFridayRanges(array $fridayRanges): void
    {
        $this->fridayRanges = $fridayRanges;
    }
}