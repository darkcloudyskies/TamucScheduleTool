<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:39 PM
 */

require_once '../database/DatabaseConnection.php';
require_once 'CourseDAO.php';
require_once 'ProfessorDAO.php';

class SectionDAO
{
    public function getAllSections(): array
    {
        $sections = array();

        $sql = "SELECT * FROM section";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $section = new section();

                $section->setCallNum($row["callNum"]);
                $section->setCourse((new CourseDAO())->getCourseFromId($row["courseId"]));
                $section->setEndDate($row["endDate"]);
                $section->setEndTime($row["endTime"]);
                $section->setLocation($row["location"]);
                $section->setProfessors((new ProfessorDAO())->getProfessorsFromSectionId($row["sectionId"]));
                $section->setSectionId($row["sectionId"]);
                $section->setSectionNum($row["sectionNum"]);
                $section->setStartDate($row["startDate"]);
                $section->setStartTime($row["startTime"]);
                $section->setWeekDays($row["weekDays"]);

                $sections[] = $section;
            }
        }

        $conn->close();

        return $sections;
    }

    public function getSectionFromId(int $sectionId): Section
    {
        $section = new Section();

        $sql = "SELECT * FROM section
                WHERE sectionId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$sectionId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $section->setCallNum($row["callNum"]);
            $section->setCourse((new CourseDAO())->getCourseFromId($row["courseId"]));
            $section->setEndDate($row["endDate"]);
            $section->setEndTime($row["endTime"]);
            $section->setLocation($row["location"]);
            $section->setProfessors((new ProfessorDAO())->getProfessorsFromSectionId($row["sectionId"]));
            $section->setSectionId($row["sectionId"]);
            $section->setSectionNum($row["sectionNum"]);
            $section->setStartDate($row["startDate"]);
            $section->setStartTime($row["startTime"]);
            $section->setWeekDays($row["weekDays"]);
        }

        $conn->close();

        return $section;
    }

    public function getSectionFromCallNum(int $callNum): Section
    {
        $section = new Section();

        $sql = "SELECT * FROM section
                WHERE callNum = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$callNum);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $section->setCallNum($row["callNum"]);
            $section->setCourse((new CourseDAO())->getCourseFromId($row["courseId"]));
            $section->setEndDate($row["endDate"]);
            $section->setEndTime($row["endTime"]);
            $section->setLocation($row["location"]);
            $section->setProfessors((new ProfessorDAO())->getProfessorsFromSectionId($row["sectionId"]));
            $section->setSectionId($row["sectionId"]);
            $section->setSectionNum($row["sectionNum"]);
            $section->setStartDate($row["startDate"]);
            $section->setStartTime($row["startTime"]);
            $section->setWeekDays($row["weekDays"]);
        }

        $conn->close();

        return $section;
    }

    public function getSectionsFromScheduleId(int $scheduleId): array
    {
        $sections = array();

        $sql = "SELECT * FROM section
                WHERE sectionId IN 
                (SELECT sectionId FROM schedulesection
                WHERE scheduleId = ?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$scheduleId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $section = new Section();

                $section->setCallNum($row["callNum"]);
                $section->setCourse((new CourseDAO())->getCourseFromId($row["courseId"]));
                $section->setEndDate($row["endDate"]);
                $section->setEndTime($row["endTime"]);
                $section->setLocation($row["location"]);
                $section->setProfessors((new ProfessorDAO())->getProfessorsFromSectionId($row["sectionId"]));
                $section->setSectionId($row["sectionId"]);
                $section->setSectionNum($row["sectionNum"]);
                $section->setStartDate($row["startDate"]);
                $section->setStartTime($row["startTime"]);
                $section->setWeekDays($row["weekDays"]);

                $sections[] = $section;
            }
        }

        $conn->close();

        return $sections;
    }

    public function updateSection(Section $section): bool
    {
        $sql = "UPDATE section SET
                sectionId = ?,
                courseId = ?,
                startTime = ?,
                endTime = ?,
                startDate = ?,
                endDate = ?,
                weekDays = ?,
                location = ?,
                sectionNum = ?,
                callNum = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iisssssssi",$section->getSectionId(),$section->getCourse()->getCourseId(),$section->getStartTime(),$section->getEndTime(),$section->getStartDate(),$section->getEndDate(),$section->getWeekDays(),$section->getLocation(),$section->getSectionNum(),$section->getCallNum());

        $result = $pst->execute();
        $result &= $this->updateSectionProfessor($section);

        $conn->close();

        return $result;
    }

    private function updateSectionProfessor(Section $section): bool
    {
        $sql = "UPDATE sectionprofessor SET
                professorId = ?,
                sectionId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($section->getProfessors() as $professor)
        {
            $pst->bind_param("ii",$professor->getProfessorId(),$section->getSectionId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function insertSection(Section $section): bool
    {
        $sql = "INSERT INTO section (courseId, startTime, endTime, startDate, endDate, weekDays, location, sectionNum, callNum)
                VALUES (?,?,?,?,?,?,?,?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("isssssssi",$section->getCourse()->getCourseId(),$section->getStartTime(),$section->getEndTime(),$section->getStartDate(),$section->getEndDate(),$section->getWeekDays(),$section->getLocation(),$section->getSectionNum(),$section->getCallNum());

        $result = $pst->execute();
        $result &= $this->insertSectionProfessor($section);

        $section->setSectionId($conn->insert_id);

        $conn->close();

        return $result;
    }

    private function insertSectionProfessor(Section $section): bool
    {
        $sql = "INSERT INTO sectionprofessor (professorId, sectionId) 
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($section->getProfessors() as $professor)
        {
            $pst->bind_param("ii",$professor->getProfessorId(),$section->getSectionId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function deleteSection(Section $section): bool
    {
        $sql = "DELETE FROM section
                WHERE sectionId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$section->getSectionId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}