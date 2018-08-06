<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/4/2018
 * Time: 6:19 PM
 */

require_once "../DAO/MinorDAO.php";
require_once "../POPO/Minor.php";

$minorDAO = new MinorDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["minorId"]))
        {
            $minorId=intval($_GET["minorId"]);
            $minor=$minorDAO->getMinorFromId($minorId);
            echo json_encode($minor);
        }
        else if(!empty($_GET["studentId"]))
        {
            $studentId=$_GET["studentId"];
            $minors = $minorDAO->getMinorsFromStudentId($studentId);
            echo json_encode($minors);
        }
        else if(!empty($_GET["minorName"]))
        {
            $minorName = $_GET["minorName"];
            $minor = $minorDAO->getMinorFromName($minorName);
            echo json_encode($minor);
        }
        else
        {
            $minors = $minorDAO->getAllMinors();
            echo json_encode($minors);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}