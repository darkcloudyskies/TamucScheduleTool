<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/5/2018
 * Time: 2:54 PM
 */

require_once "../DAO/ProfessorRatingDAO.php";
require_once "../POPO/ProfessorRating.php";

$professorRatingDAO = new ProfessorRatingDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["professorRatingId"]))
        {
            $professorRatingId=intval($_GET["professorRatingId"]);
            $professorRating=$professorRatingDAO->getProfessorRatingFromId($professorRatingId);
            echo json_encode($professorRating);
        }
        else if(!empty($_GET["professorId"]) && !empty($_GET["studentId"]))
        {
            $studentId=$_GET["studentId"];
            $professorId = $_GET["professorId"];
            $professorRating = $professorRatingDAO->getProfessorRatingFromStudentAndProfessorId($studentId,$professorId);
            echo json_encode($professorRating);
        }
        else if(!empty($_GET["professorId"]))
        {
            $professorId = $_GET["professorId"];
            $professorRatings = $professorRatingDAO->getProfessorRatingsFromProfessorId($professorId);
            echo json_encode($professorRatings);
        }
        else
        {
            $professorRatings = $professorRatingDAO->getAllProfessorRatings();
            echo json_encode($professorRatings);
        }
        break;
    case 'POST':
        if(!empty($_POST["professorRating"]))
        {
            $professorRating = json_decode($_POST["professorRating"]);
            if(!$professorRatingDAO->updateProfessorRating($professorRating))
            {
                $professorRatingDAO->insertProfessorRating($professorRating);
            }
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}