<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:18 PM
 */

class Department
{
    private $departmentId;
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

}