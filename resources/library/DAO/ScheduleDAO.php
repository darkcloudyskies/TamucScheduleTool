<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:38 PM
 */

require_once '../database/DatabaseConnection.php';
require_once 'SectionDAO.php';

class ScheduleDAO
{
    public function getAllSchedules(): array
    {
        $schedules = array();

        $sql = "SELECT * FROM schedule";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $schedule = new schedule();

                $schedule->setSections((new SectionDAO())->getSectionsFromScheduleId($row["scheduleId"]));
                $schedule->setScheduleId($row["scheduleId"]);
                $schedule->setScheduleName($row["scheduleName"]);
                $schedule->setStudentId($row["studentId"]);

                $schedules[] = $schedule;
            }
        }

        $conn->close();

        return $schedules;
    }

    public function getScheduleFromId(int $scheduleId): Schedule
    {
        $schedule = new Schedule();

        $sql = "SELECT * FROM schedule
                WHERE scheduleId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$scheduleId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $schedule->setSections((new SectionDAO())->getSectionsFromScheduleId($row["scheduleId"]));
            $schedule->setScheduleId($row["scheduleId"]);
            $schedule->setScheduleName($row["scheduleName"]);
            $schedule->setStudentId($row["studentId"]);
        }

        $conn->close();

        return $schedule;
    }

    public function getScheduleFromStudentId(int $studentId): Schedule
    {
        $schedule = new Schedule();

        $sql = "SELECT * FROM schedule
                WHERE studentId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$studentId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $schedule->setSections((new SectionDAO())->getSectionsFromScheduleId($row["scheduleId"]));
            $schedule->setScheduleId($row["scheduleId"]);
            $schedule->setScheduleName($row["scheduleName"]);
            $schedule->setStudentId($row["studentId"]);
        }

        $conn->close();

        return $schedule;
    }

    public function updateSchedule(Schedule $schedule): bool
    {
        $sql = "UPDATE schedule SET
                scheduleId = ?,
                studentId = ?,
                scheduleName = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iis",$schedule->getScheduleId(),$schedule->getStudentId(),$schedule->getScheduleName());

        $result = $pst->execute();
        $result &= $this->updateScheduleSection($schedule);

        $conn->close();

        return $result;
    }

    private function updateScheduleSection(Schedule $schedule): bool
    {
        $sql = "UPDATE schedulesection SET
                scheduleId = ?,
                sectionId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($schedule->getSections() as $section)
        {
            $pst->bind_param("ii",$schedule->getScheduleId(),$section->getSectionId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function insertSchedule(Schedule $schedule): bool
    {
        $sql = "INSERT INTO schedule (studentId, scheduleName)
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("is",$schedule->getStudentId(),$schedule->getScheduleName());

        $result = $pst->execute();
        $result &= $this->insertScheduleSection($schedule);

        $schedule->setScheduleId($conn->insert_id);

        $conn->close();

        return $result;
    }

    private function insertScheduleSection(Schedule $schedule): bool
    {
        $sql = "INSERT INTO schedulesection (scheduleId, sectionId) 
                VALUES (?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $result = true;

        foreach ($schedule->getSections() as $section)
        {
            $pst->bind_param("ii",$schedule->getScheduleId(),$section->getSectionId());
            $result &= $pst->execute();
        }

        $conn->close();

        return $result;
    }

    public function deleteSchedule(Schedule $schedule): bool
    {
        $sql = "DELETE FROM schedule
                WHERE scheduleId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$schedule->getScheduleId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}