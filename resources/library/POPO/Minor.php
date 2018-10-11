<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 4:37 PM
 */

require_once __DIR__.'/Course.php';

class Minor implements JsonSerializable
{
    private $minorId = -1;
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
            'minorId' => $this->getMinorId(),
            'minorName' => $this->getMinorName()
        ];
    }

    public function __toString() : String
    {
        return $this->getMinorId();
    }
}