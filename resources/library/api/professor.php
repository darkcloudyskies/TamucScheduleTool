<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/5/2018
 * Time: 2:51 PM
 */

require_once "../DAO/ProfessorDAO.php";
require_once "../POPO/Professor.php";

$professorDAO = new ProfessorDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["professorId"]))
        {
            $professorId=intval($_GET["professorId"]);
            $professor=$professorDAO->getProfessorFromId($professorId);
            echo json_encode($professor);
        }
        else if(!empty($_GET["professorName"]))
        {
            $professorName = $_GET["professorName"];
            $professor = $professorDAO->getProfessorFromName($professorName);
            echo json_encode($professor);
        }
        else if(!empty($_GET["sectionId"]))
        {
            $sectionId = $_GET["sectionId"];
            $professors = $professorDAO->getProfessorsFromSectionId($sectionId);
            echo json_encode($professors);
        }
        else
        {
            $professors = $professorDAO->getAllProfessors();
            echo json_encode($professors);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}