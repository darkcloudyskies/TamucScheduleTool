<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/4/2018
 * Time: 2:36 PM
 */

require_once "../DAO/StudentDAO.php";
require_once "../POPO/Student.php";

$studentDAO = new StudentDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["studentId"]))
        {
            $studentId=intval($_GET["studentId"]);
            $student=$studentDAO->getStudentFromId($studentId);
            echo json_encode($student);
        }
        else if(!empty($_GET["username"]))
        {
            $username=$_GET["username"];
            $student = $studentDAO->getStudentFromUsername($username);
            echo json_encode($student);
        }
        else
        {
            //Here we would give them all the students, if we wanted to (we don't).
            $students = $studentDAO->getAllStudents();
            echo json_encode($students);
        }
        break;
    case 'POST':
        if(!empty($_POST["student"])) {
            $student = json_decode($_POST["student"]);
            if (!$studentDAO->updateStudent($student))
            {
                $studentDAO->insertStudent($student);
            }
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}