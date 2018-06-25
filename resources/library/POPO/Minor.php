<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 4:37 PM
 */

require_once 'Course.php';

class Minor
{
    private $minorId;
    private $minorName;

    private $courses = array();

    /**
     * @return mixed
     */
    public function getMinorId(): int
    {
        return $this->minorId;
    }

    /**
     * @param mixed $minorId
     */
    public function setMinorId(int $minorId): void
    {
        $this->minorId = $minorId;
    }

    /**
     * @return mixed
     */
    public function getMinorName(): string
    {
        return $this->minorName;
    }

    /**
     * @param mixed $minorName
     */
    public function setMinorName(string $minorName): void
    {
        $this->minorName = $minorName;
    }

    /**
     * @return array
     */
    public function getCourses(): array
    {
        return $this->courses;
    }

    /**
     * @param array $courses
     */
    public function setCourses(array $courses): void
    {
        $this->courses = $courses;
    }
}