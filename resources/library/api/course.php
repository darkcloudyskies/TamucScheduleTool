<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/4/2018
 * Time: 3:39 PM
 */

require_once "../DAO/CourseDAO.php";
require_once "../POPO/Course.php";

$courseDAO = new CourseDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["courseId"]))
        {
            $courseId=intval($_GET["courseId"]);
            $course = $courseDAO->getCourseFromId($courseId);
            echo json_encode($course);
        }
        else if(!empty($_GET["studentId"]))
        {
            $studentId=intval($_GET["studentId"]);
            $courses = $courseDAO->getCoursesFromStudentId($studentId);
            echo json_encode($courses);
        }
        else if(!empty($_GET["prereqId"]))
        {
            $prereqId=intval($_GET["prereqId"]);
            $courses = $courseDAO->getCoursePrereqFromId($prereqId);
            echo json_encode($courses);
        }
        else if(!empty($_GET["majorId"]))
        {
            $majorId=intval($_GET["majorId"]);
            $courses = $courseDAO->getCoursesFromMajorId($majorId);
            echo json_encode($courses);
        }
        else if(!empty($_GET["minorId"]))
        {
            $minorId=intval($_GET["minorId"]);
            $courses = $courseDAO->getCoursesFromMajorId($minorId);
            echo json_encode($courses);
        }
        else if(!empty($_GET["prefixId"]) && (!empty($_GET["courseNum"])))
        {
            $prefixId=intval($_GET["prefixId"]);
            $courseNum=intval($_GET["courseNum"]);
            $course = $courseDAO->getCourseFromPrefixAndCourseNum($prefixId,$courseNum);
            echo json_encode($course);
        }
        else
        {
            $courses = $courseDAO->getAllCourses();
            echo json_encode($courses);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}