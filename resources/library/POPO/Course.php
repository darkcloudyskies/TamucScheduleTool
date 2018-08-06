<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:08 PM
 */


require_once 'Prefix.php';
require_once 'CourseRating.php';

class Course implements JsonSerializable
{
    private $courseId;
    private $courseName;
    private $courseNum;
    private $hours;

    private $prefix;
    private $courseRatings = array();
    private $coursePrereqs = array();

    /**
     * @return mixed
     */
    public function getCourseId(): int
    {
        return $this->courseId;
    }

    /**
     * @param mixed $courseId
     */
    public function setCourseId(int $courseId): void
    {
        $this->courseId = $courseId;
    }

    /**
     * @return mixed
     */
    public function getCourseName(): string
    {
        return $this->courseName;
    }

    /**
     * @param mixed $courseName
     */
    public function setCourseName(string $courseName): void
    {
        $this->courseName = $courseName;
    }

    /**
     * @return mixed
     */
    public function getCourseNum(): int
    {
        return $this->courseNum;
    }

    /**
     * @param mixed $courseNum
     */
    public function setCourseNum(int $courseNum): void
    {
        $this->courseNum = $courseNum;
    }

    /**
     * @return mixed
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours(int $hours): void
    {
        $this->hours = $hours;
    }

    /**
     * @return mixed
     */
    public function getPrefix(): Prefix
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix(Prefix $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return array
     */
    public function getCourseRatings(): array
    {
        return $this->courseRatings;
    }

    /**
     * @param array $courseRatings
     */
    public function setCourseRatings(array $courseRatings): void
    {
        $this->courseRatings = $courseRatings;
    }

    /**
     * @return array
     */
    public function getCoursePrereqs(): array
    {
        return $this->coursePrereqs;
    }

    /**
     * @param array $coursePrereqs
     */
    public function setCoursePrereqs(array $coursePrereqs): void
    {
        $this->coursePrereqs = $coursePrereqs;
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
            'courseRatings' => $this->getCourseRatings(),
            'courseId' => $this->getCourseId(),
            'coursePrereqs' => $this->getCoursePrereqs(),
            'courseName' => $this->getCourseName(),
            'courseNum' => $this->getCourseNum(),
            'prefix' => $this->getPrefix(),
            'hours' => $this->getHours()
        ];
    }
}