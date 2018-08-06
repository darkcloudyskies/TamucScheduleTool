<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 4:34 PM
 */

require_once 'Course.php';

class Major implements JsonSerializable
{
    private $majorId;
    private $majorName;

    private $courses = array();

    /**
     * @return mixed
     */
    public function getMajorId(): int
    {
        return $this->majorId;
    }

    /**
     * @param mixed $majorId
     */
    public function setMajorId(int $majorId): void
    {
        $this->majorId = $majorId;
    }

    /**
     * @return mixed
     */
    public function getMajorName(): string
    {
        return $this->majorName;
    }

    /**
     * @param mixed $majorName
     */
    public function setMajorName(string $majorName): void
    {
        $this->majorName = $majorName;
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
            'courses' => $this->getCourses(),
            'majorId' => $this->getMajorId(),
            'majorName' => $this->getMajorName()
        ];
    }
}