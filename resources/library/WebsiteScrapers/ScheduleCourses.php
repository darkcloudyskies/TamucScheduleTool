<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/18/2018
 * Time: 2:02 PM
 */

require_once '../POPO/Course.php';
require_once '../POPO/Section.php';

require_once '../DAO/CourseDAO.php';
require_once '../DAO/SectionDAO.php';
require_once '../DAO/PrefixDAO.php';

class ScheduleCourses
{


    public function scrapeEachDepartmentPage() : void
    {
        $departmentDAO = new DepartmentDAO();
        $departments = $departmentDAO->getAllDepartments();

        foreach ($departments as $department) {
            $this->scrapeDepartmentPage($department);
        }
    }

    private function scrapeDepartmentPage(Department $department) : void
    {
        $scheduleRoot = "http://appsprod.tamuc.edu/Schedule/Schedule.aspx?Menu=&ShowMenuDetail=&Debug=&DB=PROD&WO=&2504=Y&Dept=".$department->getDepartmentCode()."&Term=201880&Corq=A&Preq=S";
        $doc = $this->getScheduleDoc($scheduleRoot);
        $scheduleTable = $this->getScheduleTable($doc);
        $this->parseDataFromScheduleTable($scheduleTable);
    }

    private function getScheduleDoc(string $scheduleRoot): DOMDocument
    {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($scheduleRoot);
        libxml_clear_errors();

        return $doc;
    }

    private function getScheduleTable(DOMDocument $doc): DOMElement
    {
        $form = $doc->getElementsByTagName("form")->item(0);
        $scheduleDiv = $form->getElementsByTagName("div")->item(3);
        //echo($scheduleDiv->textContent);
        $scheduleTable = $scheduleDiv->getElementsByTagName("table")->item(0);

        return $scheduleTable;
    }

    private function parseDataFromScheduleTable(DomElement $scheduleTable): void
    {
        $rows = $scheduleTable->getElementsByTagName("tr");
        $i = 1;
        while($i < $rows->length && ($rows->item($i)->getAttribute("class") == "StandardRowEven" || $rows->item($i)->getAttribute("class") == "StandardRowOdd" ))
        {
            //echo($rows->item($i)->textContent . "<br>");
            $this->parseCourseBlock($rows, $i);
            $i = $this->getNextCourseBlock($rows, $i+1);
        }
    }

    private function getNextCourseBlock(DOMNodeList $rows, int $i) : int
    {
        while($i < $rows->length && $rows->item($i)->getAttribute("class") != "StandardRowEven" && $rows->item($i)->getAttribute("class") != "StandardRowOdd" )
        {
            $i++;
        }
        return $i;
    }

    private function parseCourseBlock(DOMNodeList $rows, int $i) : void
    {

        $course = $this->parseCourseFromHeaderRow($rows->item($i++));

        while($i < $rows->length && $rows->item($i)->getAttribute("class") == "StandardSubHeader" )
        {
            $this->parseSectionFromSubRow($rows,$i, $course);
            $i = $this->getNextSpecialRow($rows,$i+1);
        }
    }

    private function parseCourseFromHeaderRow(DOMElement $row) : Course
    {
        echo($row->textContent . '<br><br>');

        $columns = $row->getElementsByTagName("td");

        $course = new Course();

        (new PrefixDAO())->getPrefixFromName($columns->item(0)->textContent);

        $course->setCourseName(explode("Hours:", trim($columns->item(2)->textContent) )[0]);
        $course->setPrefix((new PrefixDAO())->getPrefixFromName($columns->item(0)->textContent));
        $course->setCourseNum($columns->item(1)->textContent);
        $course->setHours(intval(explode("Hours:", trim($columns->item(2)->textContent) )[1][0]));

        $courseDAO = new CourseDAO();
        $courseDAO->insertCourse($course);

        echo json_encode($course);

        return new Course();
    }

    private function parseSectionFromSubRow(DOMNodeList $rows, int $i, Course $course) : Section
    {
        //echo($rows->item($i)->textContent . '<br>');
        return new Section();
    }

    private function getNextSpecialRow(DOMNodeList $rows, int $i) : int
    {
        while($i < $rows->length && $rows->item($i)->getAttribute("class") != "StandardSubHeader" &&  $rows->item($i)->getAttribute("class") != "StandardRowEven" && $rows->item($i)->getAttribute("class") != "StandardRowOdd" )
        {
            $i++;
        }
        return $i;
    }
}