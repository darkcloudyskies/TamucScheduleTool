<?php
error_reporting(0);
require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";

require_once "../resources/library/DAO/MajorDAO.php";
require_once "../resources/library/POPO/Major.php";

require_once "../resources/library/DAO/CourseDAO.php";
require_once "../resources/library/POPO/Minor.php";

require_once "../resources/library/DAO/CourseDAO.php";
require_once "../resources/library/POPO/Course.php";

require_once "../resources/library/DAO/ScheduleBuilderDAO.php";
require_once "../resources/library/POPO/ScheduleBuilderRequest.php";

require_once "../resources/library/DAO/ScheduleDAO.php";
require_once "../resources/library/POPO/Schedule.php";

require_once "../resources/library/POPO/Filter.php";
require_once "../resources/library/POPO/TimeRange.php";


include_once ("common/loginCheck.php");

$studentDAO = new StudentDAO();
$student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);

$scheduleBuilderDAO = new ScheduleBuilderDAO();
$scheduleBuilderRequest = new ScheduleBuilderRequest();
$scheduleBuilderRequest->setStudentId($student->getStudentId());


$scheduleBuilderRequest->setMinimumHours($_GET["minimumTotalHours"]);
$scheduleBuilderRequest->setMaximumHours($_GET["maximumTotalHours"]);
$scheduleBuilderRequest->setMaximumOnlineHours($_GET["maximumOnlineHours"]);

if(isset($_GET["sectionBlacklist"]))
{
    $scheduleBuilderRequest->setSectionIdBlackList($_GET["sectionBlacklist"]);
}

$filter = new Filter();
$ranges = array();
$timeRange = new TimeRange();


$mondayStartTimes = $_GET["mondayStartTime"];
$mondayEndTimes = $_GET["mondayEndTime"];

for($x = 0;$x< count($mondayStartTimes); $x++) {
    $timeRange->setStartTime($mondayStartTimes[$x]);
    $timeRange->setEndTime($mondayEndTimes[$x]);
    $ranges[] = $timeRange;
}

$filter->setMondayRanges($ranges);


$scheduleBuilderRequest->setFilter($filter);

$scheduleBuilderRequest->setSortTime($_GET["sortTime"]);

$schedule = $scheduleBuilderDAO->generateSchedule($scheduleBuilderRequest);
$sections = $schedule->getSections();
$scheduleDAO = new ScheduleDAO();
if(isset($_GET["action"]) && $_GET["action"] === "save")
{
    $schedule = $scheduleDAO->getScheduleFromStudentId($student->getStudentId());
    if($schedule == null)
    {
        $schedule = new Schedule();
    }
    $schedule->setSections($sections);
    $schedule->setStudentId($student->getStudentId());
    $schedule->setScheduleName($_GET["name"]);

    if(!$scheduleDAO->updateSchedule($schedule))
    {
        $scheduleDAO->insertSchedule($schedule);
    }
    echo('<meta http-equiv="refresh" content="0; url=schedule.php">');
}

include_once ("common/header.php");
?>


<main role="main" class="container mt-2 ">
    <div class="card mt-2">
    <form accept-charset="UTF-8" role="form">
        <div class="card-header ">
            <input type="text" class="form-control" name="name" placeholder="Schedule Name">
            <button class="btn btn-outline-success mt-2" type="submit" name="action" value="save"">Save Schedule</button>
        </div>
        <div class="card-body">

                <input type="hidden" name="minimumTotalHours" value="<?= $_GET["minimumTotalHours"] ?>">
                <input type="hidden" name="maximumTotalHours" value="<?= $_GET["maximumTotalHours"]?>">
                <input type="hidden" name="maximumOnlineHours" value="<?= $_GET["maximumOnlineHours"]?>">
                <?php
                    foreach($scheduleBuilderRequest->getSectionIdBlackList() as $blacklistedSection)
                    {
                        echo('<input type="hidden" name="sectionBlacklist[]" value="' .$blacklistedSection.'">');
                    }

                    $counter = 0;

                    foreach($scheduleBuilderRequest->getFilter()->getMondayRanges() as $mondayRange)
                    {
                        echo('<input type="hidden" value="'.$mondayRange->getStartTime().'" name="mondayStartTime['.$counter.']">');
                        echo('<input type="hidden" value="'.$mondayRange->getEndTime().'" name="mondayEndTime['.$counter++.']">');
                    }

                    $counter = 0;

                    foreach($scheduleBuilderRequest->getFilter()->getMondayRanges() as $tuesdayRange)
                    {
                        echo('<input type="hidden" value="'.$tuesdayRange->getStartTime().'" name="tuesdayStartTime['.$counter.']">');
                        echo('<input type="hidden" value="'.$tuesdayRange->getEndTime().'" name="tuesdayEndTime['.$counter++.']">');
                    }

                    $counter = 0;

                    foreach($scheduleBuilderRequest->getFilter()->getMondayRanges() as $wednesdayRange)
                    {
                        echo('<input type="hidden" value="'.$wednesdayRange->getStartTime().'" name="wednesdayStartTime['.$counter.']">');
                        echo('<input type="hidden" value="'.$wednesdayRange->getEndTime().'" name="wednesdayEndTime['.$counter++.']">');
                    }


                    $counter = 0;

                    foreach($scheduleBuilderRequest->getFilter()->getMondayRanges() as $thursdayRange)
                    {
                        echo('<input type="hidden" value="'.$thursdayRange->getStartTime().'" name="thursdayStartTime['.$counter.']">');
                        echo('<input type="hidden" value="'.$thursdayRange->getEndTime().'" name="thursdayEndTime['.$counter++.']">');
                    }

                    $counter = 0;

                    foreach($scheduleBuilderRequest->getFilter()->getMondayRanges() as $fridayRange)
                    {
                        echo('<input type="hidden" value="'.$fridayRange->getStartTime().'" name="fridayStartTime['.$counter.']">');
                        echo('<input type="hidden" value="'.$fridayRange->getEndTime().'" name="fridayEndTime['.$counter++.']">');
                    }

                ?>


                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($sections as $section)
                    {
                        echo('<li class="list-group-item">');
                        echo($section->getCourse()->getPrefix()->getPrefixName() . ' - ');
                        echo($section->getCourse()->getCourseNum() . ' - ');
                        echo($section->getCourse()->getCourseName() . ' - ');
                        echo($section->getWeekDays() . ' - ');
                        echo($section->getStartTime() . ' - ');
                        echo($section->getEndTime() . ' - ');
                        echo($section->getLocation() . ' - ');
                        echo($section->getCourse()->getHours());
                        echo('<button type="submit" class="btn btn-outline-success float-right" name="sectionBlacklist[]" value="'.$section->getSectionId().'">Remove & Re-Calculate</button>');
                        echo('</li>');

                    }
                    ?>
                </ul>
            </form>
        </div>
    </div>
</main>
</body>

</html>
