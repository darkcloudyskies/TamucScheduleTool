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
                echo("<a class='prefix' href='#' data-id='".$course->getCourseId()."'>".$course->getCourseName()."</a>");
                echo('</li>');
            }
            ?>
        </ul>
    </div>

    <?php


}