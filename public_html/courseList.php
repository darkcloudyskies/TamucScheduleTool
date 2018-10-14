<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/16/2018
 * Time: 7:48 PM
 */

require_once "../resources/library/DAO/CourseDAO.php";
require_once "../resources/library/POPO/Course.php";

if (!empty($_GET))
{
    $prefixId = $_GET["id"];


    $courseDAO = new CourseDAO();
    $courses = $courseDAO->getCoursesFromPrefixId($prefixId);

    ?>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <?php
            foreach ($courses as $course)
            {
                echo('<li class="list-group-item">');
                echo("<a class='prefix' href='coursedetail.php?courseId=".$course->getCourseId()."' data-id='".$course->getCourseId()."'>".$course->getCourseName()."</a>");
                echo('<button type="button" class="btn btn-outline-success float-right ' .$course->getCourseId().  '" name="courseId" onclick="addCourse(' .$course->getCourseId() .')" >Add Course</button>');
                echo('</li>');
            }
            ?>
        </ul>
    </div>

    <?php


}