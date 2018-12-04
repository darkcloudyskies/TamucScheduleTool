<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/16/2018
 * Time: 5:16 PM
 */
error_reporting(0);
require_once "../resources/library/DAO/MajorDAO.php";
require_once "../resources/library/POPO/Major.php";
require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";

include_once ("common/loginCheck.php");

$majorDAO = new MajorDAO();


if (!empty($_GET))
{
    $studentDAO = new StudentDAO();
    $student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);


    $major = $majorDAO->getMajorFromId($_GET["majorId"]);

    $majors = $student->getMajors();
    $majors[] = $major;

    $student->setMajors($majors);
    $studentDAO->updateStudent($student);

    header("Location: account.php");
    exit();
}

$majors = $majorDAO->getAllMajors();

include_once ("common/header.php");

?>

<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Available Majors</label>
            </form>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($majors as $major)
                    {
                        echo('<li class="list-group-item">');
                        echo($major->getMajorName());
                        echo('<button type="submit" class="btn btn-outline-success float-right" name="majorId" value="'.$major->getMajorId().'">Add Major</button>');
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
