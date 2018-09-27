<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:33 PM
 */

require_once __DIR__.'/../database/DatabaseConnection.php';

class DepartmentDAO
{
    public function getAllDepartments(): array
    {
        $departments = array();

        $sql = "SELECT * FROM department";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $departments = $this->getDepartmentsFromResult($result);
            }
        }

        $conn->close();

        return $departments;
    }

    public function getDepartmentFromId(int $departmentId): Department
    {
        $department = new Department();

        $sql = "SELECT * FROM department
               WHERE departmentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$departmentId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $department = $this->getDepartmentFromRow($row);
        }

        $conn->close();

        return $department;
    }

    public function getDepartmentFromCode(string $departmentCode): Department
    {
        $department = new Department();

        $sql = "SELECT * FROM department
               WHERE departmentCode = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("s",$departmentCode);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $department = $this->getDepartmentFromRow($row);
        }

        $conn->close();

        return $department;
    }

    public function getDepartmentFromName(string $departmentName): Department
    {
        $department = new Department();

        $sql = "SELECT * FROM department
               WHERE departmentName = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("s",$departmentName);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $department = $this->getDepartmentFromRow($row);
        }

        $conn->close();

        return $department;
    }

    private function getDepartmentsFromResult(mysqli_result $result): array
    {
        $departments = array();

        while($row = $result->fetch_assoc())
        {
            $departments[] = $this->getDepartmentFromRow($row);
        }

        return $departments;
    }

    private function getDepartmentFromRow(array $row): Department
    {
        $department = new Department();

        $department->setDepartmentCode($row["departmentCode"]);
        $department->setDepartmentId($row["departmentId"]);
        $department->setDepartmentName($row["departmentName"]);

        return $department;
    }

    public function updateDepartment(Department $department): bool
    {
        $sql = "UPDATE department SET
                departmentName = ?,
                departmentCode = ?
                WHERE departmentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("ssi",$department->getDepartmentName(),$department->getDepartmentCode(),$department->getDepartmentId());

        $result = $pst->execute();

        $conn->close();

        return $result;
    }

    public function insertDepartment(Department $department): bool
    {
        $sql = "INSERT INTO department (departmentName, departmentCode)
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("ss",$department->getDepartmentName(),$department->getDepartmentCode());

        $result = $pst->execute();

        $department->setDepartmentId($conn->insert_id);

        $conn->close();

        return $result;
    }

    public function deleteDepartment(Department $department): bool
    {
        $sql = "DELETE FROM department
                WHERE departmentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$department->getDepartmentId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}