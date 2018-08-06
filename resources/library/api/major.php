<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/4/2018
 * Time: 6:15 PM
 * 
 */

require_once "../DAO/MajorDAO.php";
require_once "../POPO/Major.php";

$majorDAO = new MajorDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["majorId"]))
        {
            $majorId=intval($_GET["majorId"]);
            $major=$majorDAO->getMajorFromId($majorId);
            echo json_encode($major);
        }
        else if(!empty($_GET["studentId"]))
        {
            $studentId=$_GET["studentId"];
            $majors = $majorDAO->getMajorsFromStudentId($studentId);
            echo json_encode($majors);
        }
        else if(!empty($_GET["majorName"]))
        {
            $majorName = $_GET["majorName"];
            $major = $majorDAO->getMajorFromName($majorName);
            echo json_encode($major);
        }
        else
        {
            $majors = $majorDAO->getAllMajors();
            echo json_encode($majors);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}