<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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


$schedule = $scheduleBuilderDAO->generateSchedule($scheduleBuilderRequest);
$sections = $schedule->getSections();

include_once ("common/header.php");
?>


<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header ">
            <?php echo $student->getSchedule()->getScheduleName(); ?>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <input type="hidden" name="minimumTotalHours" value="<?= $_GET["minimumTotalHours"] ?>">
                <input type="hidden" name="maximumTotalHours" value="<?= $_GET["maximumTotalHours"]?>">
                <input type="hidden" name="maximumOnlineHours" value="<?= $_GET["maximumOnlineHours"]?>">

                <?php
                    foreach($scheduleBuilderRequest->getSectionIdBlackList() as $blacklistedSection)
                    {
                        echo('<input type="hidden" name="sectionBlacklist[]" value="' .$blacklistedSection.'">');
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
