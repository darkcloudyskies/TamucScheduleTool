<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/16/2018
 * Time: 5:16 PM
 */

require_once "../resources/library/DAO/DepartmentDAO.php";
require_once "../resources/library/POPO/Department.php";

include_once ("common/loginCheck.php");

$departmentDAO = new DepartmentDAO();
$departments = $departmentDAO->getAllDepartments();
include_once ("common/header.php");

?>

<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Available Courses</label>
            </form>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <input type="hidden" name="type" value="Course">
                <input type="hidden" name="action" value="Delete">
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($departments as $department)
                    {
                        echo('<div class="card mt-2">');
                            echo('<div class="card-header">');
                                echo('<li class="list-group-item">');
                                    echo($department->getDepartmentName());
                                echo('</li>');
                            echo('</div>');
                            echo('<div id="'.$department->getDepartmentId().'">');
                            echo('</div>');

                        echo('</div>');
                    }
                    ?>
                </ul>
            </form>
        </div>
    </div>

</main>
</body>

</html>
