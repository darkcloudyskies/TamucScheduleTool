<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:19 PM
 */

require_once __DIR__.'/Department.php';

class Prefix implements JsonSerializable
{
    private $prefixId;
    private $prefixName;

    private $department;

    /**
     * @return mixed
     */
    public function getPrefixId(): int
    {
        return $this->prefixId;
    }

    /**
     * @param mixed $prefixId
     */
    public function setPrefixId(int $prefixId): void
    {
        $this->prefixId = $prefixId;
    }

    /**
     * @return mixed
     */
    public function getPrefixName(): string
    {
        return $this->prefixName;
    }

    /**
     * @param mixed $prefixName
     */
    public function setPrefixName(string $prefixName): void
    {
        $this->prefixName = $prefixName;
    }

    /**
     * @return mixed
     */
    public function getDepartment(): Department
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment(Department $department): void
    {
        $this->department = $department;
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
            'prefixId' => $this->getPrefixId(),
            'department' => $this->getDepartment(),
            'prefixName' => $this->getPrefixName()
        ];
    }

    public function __toString() : String
    {
        return $this->getPrefixId();
    }
}