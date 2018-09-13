<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/13/2018
 * Time: 1:27 PM
 */

require_once "CourseOverview.php";
require_once "ScheduleCourses.php";

ini_set('max_execution_time', 300);
ini_set('memory_limit', '1000M');

$scheduleCourses = new ScheduleCourses();
$scheduleCourses->scrapeEachDepartmentPage();

