<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:19 PM
 */

require_once 'Department.php';

class Prefix
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
}