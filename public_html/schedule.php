<?php
include_once ("common/loginCheck.php");
include_once ("common/header.php");

require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";

$studentDAO = new StudentDAO();
$student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);

$sections = $student->getSchedule()->getSections();

?>


<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header ">
            <?php echo $student->getSchedule()->getScheduleName(); ?>
        </div>
        <div class="card-body">
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
                    echo('</li>');

                }
                ?>
            </ul>
        </div>
    </div>
</main>
</body>

</html>