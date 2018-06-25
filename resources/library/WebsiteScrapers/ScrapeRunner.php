<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/13/2018
 * Time: 1:27 PM
 */

require_once "CourseOverview.php";

$courseOverview = new CourseOverview();
$courseOverview->scrapeScheduleOverViewPage();