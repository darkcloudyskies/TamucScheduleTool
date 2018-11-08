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

        //$this->scrapeDepartmentPage($departments[0]);
        for($i = 0;$i < 50; $i++)
        {
            $department = $departments[$i];
            $this->scrapeDepartmentPage($department);
        }
    }

    private function scrapeDepartmentPage(Department $department) : void
    {
        $scheduleRoot = "http://appsprod.tamuc.edu/Schedule/Schedule.aspx?Menu=&ShowMenuDetail=&Debug=&DB=PROD&WO=&2504=Y&Dept=".$department->getDepartmentCode()."&Term=201880&Corq=A&Preq=S";
        $doc = $this->getScheduleDoc($scheduleRoot);
        $scheduleTable = $this->getScheduleTable($doc);
        //echo($scheduleTable->textContent);
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
        $scheduleTable = $scheduleDiv->getElementsByTagName("table")->item(1);
        //echo($scheduleTable->textContent);

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
        //echo($course->getCourseId());
        if($course->getCourseId() != -1) {

            while ($i < $rows->length && $rows->item($i)->getAttribute("class") == "StandardSubHeader") {
                $professor = $this->parseProfessorFromSubRow($rows, $i, $course);
                $this->parseSectionFromSubRow($rows, $i, $course,$professor);
                $i = $this->getNextSectionStart($rows, $i + 1);
            }
        }
    }

    private function parseCourseFromHeaderRow(DOMElement $row) : Course
    {
        //echo($row->textContent . '<br><br>');

        $columns = $row->getElementsByTagName("td");
        //echo($columns->item(0)->textContent);
        $course = new Course();
        $prefix = (new PrefixDAO())->getPrefixFromName($columns->item(0)->textContent);

        if($prefix->getPrefixId() == -1)
        {
            return $course;
        }

        $course->setCourseName(explode("Hours:", trim($columns->item(2)->textContent) )[0]);
        $course->setPrefix($prefix);
        $course->setCourseNum($columns->item(1)->textContent);
        $course->setHours(intval(explode("Hours:", trim($columns->item(2)->textContent) )[1][1]));

        $courseDAO = new CourseDAO();

        $existingCourse = $courseDAO->getCourseFromPrefixAndCourseNum($course->getPrefix()->getPrefixId(),$course->getCourseNum());
        if($existingCourse->getCourseId() == -1)
        {
            $courseDAO->insertCourse($course);
        }
        else
        {
            $course = $existingCourse;
        }

        //echo json_encode($course);

        return $course;
    }

    private function parseProfessorFromSubRow(DOMNodeList $rows, int $i, Course $course)
    {
        $professor = new Professor();
        $columns = $rows->item($i)->getElementsByTagName("td");
        $professor->setProfessorName(explode("Hours:", trim($columns->item(2)->textContent) )[0]);
        //echo($columns->item(2)->textContent);
        $professorDAO = new ProfessorDAO();

        $existingProfessor = $professorDAO->getProfessorFromName($professor->getProfessorName());
        if($existingProfessor->getProfessorId() == -1) {
            //echo json_encode($professor);
            $professorDAO->insertProfessor($professor);
        }
        else
        {
            $professor = $existingProfessor;
        }

        return $professor;
    }

    private function parseSectionFromSubRow(DOMNodeList $rows, int $i, Course $course,Professor $professor) : Section
    {
        $section = new Section();
        $professors = array($professor);
        $section->setProfessors($professors);
        $section->setCourse($course);

        $columns = $rows->item($i)->getElementsByTagName("td");
        $section->setSectionNum($columns->item(0)->textContent);
        $section->setCallNum($columns->item(1)->textContent);
        $infoBlock = $rows->item($i+1)->getElementsByTagName("span")->item(0)->textContent;
        $infoBlock = explode("Vita",$infoBlock)[0];


        //echo($infoBlock);
        $parts = preg_split('/\s+/', $infoBlock);
        if(sizeof($parts) < 6)
        {
            return new Section();
        }


        $section->setStartDate($parts[1]);
        //echo($parts[1]);
        $section->setEndDate($parts[3]);
        //echo($parts[3]);

        $weekDayPortion = $parts[4];

        if(strpos($weekDayPortion, 'Web') !== false)
        {
            $section->setWeekDays("Web");
            $section->setLocation("Web");
            $section->setStartTime("Web");
            $section->setEndTime("Web");
        }
        else {
            $location = explode("Location:",$infoBlock)[1];
            if(strpos($location, 'TBA') !== false)
            {
                return new Section();
            }

            $section->setWeekDays($parts[4]);
            $timeParts = explode("-", $parts[5]);
            if(sizeof($timeParts)<2)
            {
                return new Section();
            }
            $section->setStartTime($timeParts[0]);
            $section->setEndTime($timeParts[1]);
            $section->setLocation($location);
        }

        $sectionDAO = new SectionDAO();

        $existingSection = $sectionDAO->getSectionFromCallNum($section->getCallNum());
        if($existingSection->getSectionId() == -1)
        {
            $sectionDAO->insertSection($section);
        }
        else
        {
            $section = $existingSection;
        }

        return $section;
    }

    private function getNextSectionStart(DOMNodeList $rows, int $i) : int
    {
        while($i < $rows->length && $rows->item($i)->getAttribute("class") != "StandardSubHeader" &&  $rows->item($i)->getAttribute("class") != "StandardRowEven" && $rows->item($i)->getAttribute("class") != "StandardRowOdd" )
        {
            $i++;
        }
        return $i;
    }
}