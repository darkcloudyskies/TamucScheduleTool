<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/4/2018
 * Time: 2:36 PM
 */

require_once "../DAO/ScheduleDAO.php";
require_once "../POPO/Schedule.php";

$scheduleDAO = new ScheduleDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["scheduleId"]))
        {
            $scheduleId=intval($_GET["scheduleId"]);
            $schedule = $scheduleDAO->getScheduleFromId($scheduleId);
            echo json_encode($schedule);
        }
        else if(!empty($_GET["studentId"]))
        {
            $studentId=intval($_GET["studentId"]);
            $schedule = $scheduleDAO->getScheduleFromStudentId($studentId);
            echo json_encode($schedule);
        }
        else
        {
            //Here we would give them all the schedules, if we wanted to (we don't).
            $schedules = $scheduleDAO->getAllSchedules();
            echo json_encode($schedules);
        }
        break;
    case 'POST':
        if(!empty($_POST["schedule"]))
        {
            $schedule = json_decode($_POST["schedule"]);
            if(!$scheduleDAO->updateSchedule($schedule))
            {
                $scheduleDAO->insertSchedule($schedule);
            }
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}