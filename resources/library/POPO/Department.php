<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:18 PM
 */

class Department implements JsonSerializable
{
    private $departmentId = -1;
    private $departmentName;
    private $departmentCode;

    /**
     * @return mixed
     */
    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    /**
     * @param mixed $departmentId
     */
    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return mixed
     */
    public function getDepartmentName(): string
    {
        return $this->departmentName;
    }

    /**
     * @param mixed $departmentName
     */
    public function setDepartmentName(string $departmentName): void
    {
        $this->departmentName = $departmentName;
    }

    /**
     * @return mixed
     */
    public function getDepartmentCode(): string
    {
        return $this->departmentCode;
    }

    /**
     * @param mixed $departmentCode
     */
    public function setDepartmentCode(string $departmentCode): void
    {
        $this->departmentCode = $departmentCode;
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
            'departmentId' => $this->getDepartmentId(),
            'departmentCode' => $this->getDepartmentCode(),
            'departmentName' => $this->getDepartmentName()
        ];
    }

    public function __toString() : String
    {
        return $this->getDepartmentId();
    }
}