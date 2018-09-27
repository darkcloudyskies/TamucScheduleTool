<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:36 PM
 */

require_once __DIR__.'/../database/DatabaseConnection.php';
require_once __DIR__.'/DepartmentDAO.php';

class PrefixDAO
{
    public function getAllPrefixes(): array
    {
        $prefixes = array();

        $sql = "SELECT * FROM prefix";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            if($result->num_rows > 0)
            {
                $prefixes = $this->getPrefixesFromResult($result);
            }
        }

        $conn->close();

        return $prefixes;
    }

    public function getPrefixFromId(int $prefixId): Prefix
{
    $prefix = new Prefix();

    $sql = "SELECT * FROM prefix
                WHERE prefixId = ?";

    $conn = (new DatabaseConnection())->getConnection();
    $pst = $conn->prepare($sql);
    $pst->bind_param("i",$prefixId);
    $pst->execute();
    $result = $pst->get_result();

    if($result->num_rows > 0 && $row = $result->fetch_assoc())
    {
        $prefix = $this->getPrefixFromRow($row);
    }

    $conn->close();

    return $prefix;
}

    public function getPrefixesFromDepartmentId(int $departmentId): array
    {
        $prefixes = array();

        $sql = "SELECT * FROM prefix
                WHERE departmentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$departmentId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            $prefixes = $this->getPrefixesFromResult($result);
        }

        $conn->close();

        return $prefixes;
    }

    public function getPrefixFromName(string $prefixName): Prefix
    {
        $prefix = new Prefix();

        $sql = "SELECT * FROM prefix
                WHERE prefixName = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("s",$prefixName);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $prefix = $this->getPrefixFromRow($row);
        }

        $conn->close();

        return $prefix;
    }

    private function getPrefixesFromResult(mysqli_result $result): array
    {
        $prefixes = array();

        while($row = $result->fetch_assoc())
        {
            $prefixes[] = $this->getPrefixFromRow($row);
        }

        return $prefixes;
    }

    private function getPrefixFromRow(array $row): Prefix
    {
        $prefix = new Prefix();

        $prefix->setPrefixId($row["prefixId"]);
        $prefix->setPrefixName($row["prefixName"]);
        $prefix->setDepartment((new DepartmentDAO())->getDepartmentFromId($row["departmentId"]));

        return $$prefix;
    }

    public function updatePrefix(Prefix $prefix): bool
    {
        $sql = "UPDATE prefix SET
                prefixName = ?,
                departmentId = ?
                WHERE prefixId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("sii",$prefix->getPrefixName(),$prefix->getDepartment()->getDepartmentId(),$prefix->getPrefixId());

        $result = $pst->execute();

        $conn->close();

        return $result;
    }

    public function insertPrefix(Prefix $prefix): bool
    {
        $sql = "INSERT INTO prefix (prefixName, departmentId)
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("si",$prefix->getPrefixName(),$prefix->getDepartment()->getDepartmentId());

        $result = $pst->execute();

        $prefix->setPrefixId($conn->insert_id);

        $conn->close();

        return $result;
    }

    public function deletePrefix(Prefix $prefix): bool
    {
        $sql = "DELETE FROM prefix
                WHERE prefixId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$prefix->getPrefixId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}