<?php

require_once '../database/DatabaseConnection.php';
require_once '../DAO/PrefixDAO.php';
require_once '../DAO/DepartmentDAO.php';
require_once '../POPO/Prefix.php';
require_once '../POPO/Department.php';

class ScheduleOverview
{
    public function scrapeScheduleOverViewPage(): void
    {
        $doc = $this->getScheduleRoot();
        $departmentTable = $this->getDepartmentTable($doc);
        $this->parseDataFromDepartmentTable($departmentTable);
    }

    private function getScheduleRoot(): DOMDocument
    {
        $scheduleRoot = "http://appsprod.tamuc.edu/Schedule/Schedule.aspx";
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($scheduleRoot);
        libxml_clear_errors();

        return $doc;
    }

    private function getDepartmentTable(DOMDocument $doc): DOMElement
    {
        $form = $doc->getElementsByTagName("form")->item(0);
        $departmentDiv = $form->getElementsByTagName("div")->item(4);
        $departmentTable = $departmentDiv->getElementsByTagName("table")->item(0);

        return $departmentTable;
    }

    private function parseDataFromDepartmentTable(DomElement $departmentTable): array
    {
        $departments = array();
        $rows = $departmentTable->getElementsByTagName("tr");
        for ($i = 1; $i < $rows->length; $i++) {
            $row = $rows->item($i);
            $department = $this->getDepartmentFromRow($row);
            $prefixes = $this->getPrefixesFromRow($row);

            $this->insertData($department, $prefixes);
        }
        return $departments;
    }

    private function getDepartmentFromRow(DomElement $row): Department
    {
        $department = new Department();

        $columns = $row->getElementsByTagName("td");
        $department->setDepartmentCode($columns->item(0)->getElementsByTagName("a")->item(0)->textContent);
        $department->setDepartmentName($columns->item(1)->getElementsByTagName("a")->item(0)->textContent);

        return $department;
    }

    private function getPrefixesFromRow(DomElement $row): array
    {
        $prefixes = array();

        $columns = $row->getElementsByTagName("td");
        $prefixesInDepartment = ($columns->item(2)->getElementsByTagName("a")->item(0)->textContent);

        foreach (explode(" ", trim($prefixesInDepartment)) as $prefixName) {
            $prefix = new Prefix();
            $prefix->setPrefixName($prefixName);
            $prefixes[] = $prefix;
        }
        return $prefixes;
    }

    private function insertData(Department $department, array $prefixes): void
    {
        $prefixDAO = new PrefixDAO();
        $departmentDAO = new DepartmentDAO();

        $departmentDAO->insertDepartment($department);
        echo($department->getDepartmentId());
        foreach ($prefixes as $prefix) {
            $prefix->setDepartment($department);
            $prefixDAO->insertPrefix($prefix);
            echo($prefix->getPrefixId());
        }
    }
}





