<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/13/2018
 * Time: 11:51 AM
 */

require_once "../DAO/PrefixDAO.php";
require_once "../POPO/Prefix.php";
require_once "../DAO/DepartmentDAO.php";
require_once "../POPO/Department.php";

class CourseOverview
{
    public function scrapeScheduleOverViewPage(): void
    {
        $doc = $this->getScheduleRoot();
        $departmentSection = $this->getDepartmentSection($doc);
        $this->processDepartmentSection($departmentSection);
    }

    private function getScheduleRoot(): DOMDocument
    {
        $scheduleRoot = "http://coursecatalog.tamuc.edu/undergrad/courses/#text";
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($scheduleRoot);
        libxml_clear_errors();

        return $doc;
    }

    private function getDepartmentSection(DOMDocument $doc): DOMElement
    {
        $content = $doc->getElementById("textcontainer");

        return $content;
    }

    private function processDepartmentSection(DOMElement $departmentSection)
    {
        $departments = $departmentSection->getElementsByTagName("p");
        $strayHeader = $departmentSection->getElementsByTagName("h6");
        $strayHeaderIndex = 0;
        for ($i = 0; $i < $departments->length; $i++)
        {
            $strayHeaderFound = false;

            $department = $departments->item($i);
            $departmentName = $department->getElementsByTagName("strong")->item(0)->textContent;
            $innards = $department->getElementsByTagName("a");

            if($departmentName != null && $innards == null)
            {
                $i++;
                $department = $departments->item($i);
                $innards = $department->getElementsByTagName("a");
            }
            else if($departmentName == null)
            {
                $departmentName = $strayHeader->item($strayHeaderIndex)->textContent;
                $strayHeaderIndex++;
                $strayHeaderFound = true;
            }

            echo($departmentName.'<br><br>');

            $prefixString = $department->textContent;
            $prefixString = str_replace("\xC2\xA0", ' ', $prefixString);
            $prefixString = utf8_decode($prefixString);
            if(!$strayHeaderFound)
            {
                $prefixString = substr($prefixString, strlen($departmentName));
            }

            //echo($prefixString . '<br>');

            foreach($innards as $prefix)
            {
                //echo($prefix->textContent."<br>");

                $split = explode('('.$prefix->textContent.')',$prefixString);
                $prefixName = $split[0];
                $prefixCode = $prefix->textContent;

                $this->insertPrefix($prefixName,$prefixCode,$departmentName);

                //echo($prefixName . ' - ' . $prefixCode."<br>");

                $prefixString = $split[1];
            }

        }
    }

    private function insertPrefix(string $prefixName, string $prefixCode,string $departmentName)
    {
        $prefixDAO = new PrefixDAO();
        $prefix = new Prefix();
        $departmentDAO = new DepartmentDAO();
        $department = $departmentDAO->getDepartmentFromName($departmentName);

        $prefix->setPrefixName($prefixCode);
        $prefix->setDepartment($department);
        $prefixDAO->insertPrefix($prefix);
    }
}

