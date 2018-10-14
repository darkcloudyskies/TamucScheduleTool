<?php
//include_once ("common/loginCheck.php");
include_once ("common/header.php");

require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";


$studentDAO = new StudentDAO();
$student = new Student();

if (!empty($_GET["token"]))
{
    $token = $_GET["token"];
    $student = $studentDAO->getStudentFromUsername($student->getNameFromToken($token));
    if($student->getStudentId() == null)
    {
        include_once ("common/loginCheck.php");
        $student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);
    }
}
else
{
    include_once ("common/loginCheck.php");
    $student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);
}

$studentusername = $student->getUsername();


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

    <div class="card mt-2">
        <div class="card-header ">
            Sharing Link
        </div>
        <div class="card-body">
            <input type="text" class="form-control" value="<?= "http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?')."?token=" . $student->getTokenFromName($studentusername) ?> "  readonly>
        </div>
    </div>
</main>
</body>

</html>