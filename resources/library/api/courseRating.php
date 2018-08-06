<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/4/2018
 * Time: 6:21 PM
 */

require_once "../DAO/CourseRatingDAO.php";
require_once "../POPO/CourseRating.php";

$courseRatingDAO = new CourseRatingDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["courseRatingId"]))
        {
            $courseRatingId=intval($_GET["courseRatingId"]);
            $courseRating=$courseRatingDAO->getCourseRatingFromId($courseRatingId);
            echo json_encode($courseRating);
        }
        else if(!empty($_GET["courseId"]) && !empty($_GET["studentId"]))
        {
            $studentId=$_GET["studentId"];
            $courseId = $_GET["courseId"];
            $courseRating = $courseRatingDAO->getCourseRatingFromStudentAndCourseId($studentId,$courseId);
            echo json_encode($courseRating);
        }
        else if(!empty($_GET["courseId"]))
        {
            $courseId = $_GET["courseId"];
            $courseRatings = $courseRatingDAO->getCourseRatingsFromCourseId($courseId);
            echo json_encode($courseRatings);
        }
        else
        {
            $courseRatings = $courseRatingDAO->getAllCourseRatings();
            echo json_encode($courseRatings);
        }
        break;
    case 'POST':
        if(!empty($_POST["courseRating"]))
        {
            $courseRating = json_decode($_POST["courseRating"]);
            if(!$courseRatingDAO->updateCourseRating($courseRating))
            {
                $courseRatingDAO->insertCourseRating($courseRating);
            }
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}