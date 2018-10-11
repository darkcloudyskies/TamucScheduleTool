<?php

require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";

require_once "../resources/library/DAO/MajorDAO.php";
require_once "../resources/library/POPO/Major.php";

require_once "../resources/library/DAO/CourseDAO.php";
require_once "../resources/library/POPO/Minor.php";

require_once "../resources/library/DAO/CourseDAO.php";
require_once "../resources/library/POPO/Course.php";

include_once ("common/loginCheck.php");

$studentDAO = new StudentDAO();
$student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);

$majors = $student->getMajors();

$minors = $student->getMinors();

$courses = $student->getCoursesTaken();

if (!empty($_GET))
{
    if($_GET["type"] == "Major")
    {
        $majorDAO = new MajorDAO();
        $major = $majorDAO->getMajorFromId($_GET["majorId"]);

        if($_GET["action"] == "Add")
        {
            $majors[] = $major;
        }
        else if($_GET["action"] == "Delete")
        {
            $majors = array_diff($majors,array($major));
        }

        $student->setMajors($majors);
        $studentDAO->updateStudent($student);
    }
    else if($_GET["type"]=="Minor")
    {
        $minorDAO = new MinorDAO();
        $minor = $minorDAO->getMinorFromId($_GET["minorId"]);

        if($_GET["action"] == "Add")
        {
            $minors[] = $minor;
        }
        else if($_GET["action"] == "Delete")
        {
            $minors = array_diff($minors,[$minor]);
        }

        $student->setMinors($minors);
        $studentDAO->updateStudent($student);
    }
    else if($_GET["type"]=="Course")
    {
        $courseDAO = new CourseDAO();
        $course = $courseDAO->getCourseFromId($_GET["courseId"]);

        if($_GET["action"] == "Add")
        {
            $courses[] = $course;
        }
        else if($_GET["action"] == "Delete")
        {
            $courses = array_diff($courses,[$course]);
        }
        $student->setCoursesTaken($courses);
        $studentDAO->updateStudent($student);
    }
}

include_once ("common/header.php");
?>


<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header ">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Majors</label>
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="window.location.href='majors.php'">Add A Major</button>
            </form>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <input type="hidden" name="type" value="Major">
                <input type="hidden" name="action" value="Delete">
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($majors as $major)
                    {
                        echo('<li class="list-group-item">');
                        echo($major->getMajorName());
                        echo('<button type="submit" class="btn btn-outline-danger float-right" name="majorId" value="'.$major->getMajorId().'">Remove</button>');
                        echo('</li>');
                    }
                    ?>
                </ul>
            </form>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Minors</label>
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="window.location.href='minors.php'">Add A Minor</button>
            </form>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <input type="hidden" name="type" value="Minor">
                <input type="hidden" name="action" value="Delete">
                <ul class="list-group list-group-flush">

                    <?php
                    foreach ($minors as $minor)
                    {
                        echo('<li class="list-group-item">');
                        echo($minor->getMinorName());
                        echo('<button type="submit" class="btn btn-outline-danger float-right" name="minorId" value="'.$minor->getMinorId().'">Remove</button>');
                        echo('</li>');
                    }
                    ?>

                </ul>
            </form>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Courses Taken</label>
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="window.location.href='courses.php'">Add A Course</button>
            </form>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <input type="hidden" name="type" value="Course">
                <input type="hidden" name="action" value="Delete">
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($courses as $course)
                    {
                        echo('<li class="list-group-item">');
                        echo($course->getPrefix()->getPrefixName().' - '.$course->getCourseNum().' - '.$course->getCourseName());
                        echo('<button type="submit" class="btn btn-outline-danger float-right" name="courseId" value="'.$course->getCourseId().'">Remove</button>');
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