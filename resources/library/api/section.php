<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/5/2018
 * Time: 2:59 PM
 */


require_once "../DAO/SectionDAO.php";
require_once "../POPO/Section.php";

$sectionDAO = new SectionDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["sectionId"]))
        {
            $sectionId=intval($_GET["sectionId"]);
            $section=$sectionDAO->getSectionFromId($sectionId);
            echo json_encode($section);
        }
        else if(!empty($_GET["scheduleId"]))
        {
            $scheduleId = $_GET["scheduleId"];
            $sections = $sectionDAO->getSectionsFromScheduleId($scheduleId);
            echo json_encode($sections);
        }
        else if(!empty($_GET["sectionCallNum"]))
        {
            $sectionCallNum = $_GET["sectionCallNum"];
            $section = $sectionDAO->getSectionFromCallNum($sectionCallNum);
            echo json_encode($section);
        }
        else
        {
            $sections = $sectionDAO->getAllSections();
            echo json_encode($sections);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}