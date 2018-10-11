<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/16/2018
 * Time: 5:16 PM
 */

require_once "../resources/library/DAO/DepartmentDAO.php";
require_once "../resources/library/POPO/Department.php";

require_once "../resources/library/DAO/CourseDAO.php";
require_once "../resources/library/POPO/Course.php";

require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";

include_once ("common/loginCheck.php");

$departmentDAO = new DepartmentDAO();
$departments = $departmentDAO->getAllDepartments();

$studentDAO = new StudentDAO();
$student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);

if (!empty($_GET["courseId"]))
{
    $courseDAO = new CourseDAO();
    $course = $courseDAO->getCourseFromId($_GET["courseId"]);

    $courses[] = $course;

    $student->setCoursesTaken($courses);
    $studentDAO->updateStudent($student);
}

include_once ("common/header.php");
?>

<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Available Courses</label>
            </form>
        </div>
        <div class="card-body" class="mainContent">
            <form accept-charset="UTF-8" role="form">
                    <?php
                    foreach ($departments as $department)
                    {
                        echo('<div class="card mt-2">');
                            echo('<div class="card-header">');
                                    echo("<a class='department' href='#' onclick='loadPrefixes(".$department->getDepartmentId().")'>".$department->getDepartmentName()."</a>");
                            echo('</div>');
                            echo('<div id="department_'.$department->getDepartmentId().'">');
                            echo('</div>');

                        echo('</div>');
                    }
                    ?>
            </form>
        </div>
    </div>

</main>

<script>

    function loadPrefixes(departmentId)
    {
        $.ajax({url: "prefixes.php",
            data: {
                "id" : departmentId
            },
            success: function(result){
                var divId = "#department_" + departmentId;
                $(divId).html(result);
            }});
    }

    function loadCourses(prefixId)
    {
        $.ajax({url: "courseList.php",
            data: {
                "id" : prefixId
            },
            success: function(result){
                var divId = "#prefix_" + prefixId;
                $(divId).html(result);
            }});
    }

    function addCourse(courseId)
    {
        $.ajax({url: "courses.php",
            data: {
                "type" : "addCourse",
                "courseId" : courseId
            },
            success: function(result){
                $(".courseId").disabled = true;
            }});
    }


</script>

</body>

</html>
