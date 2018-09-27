<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/16/2018
 * Time: 5:16 PM
 */

require_once "../resources/library/DAO/ProfessorDAO.php";
require_once "../resources/library/POPO/Professor.php";

include_once ("common/loginCheck.php");

$professorDAO = new ProfessorDAO();
$professors = $professorDAO->getAllProfessors();
include_once ("common/header.php");

?>

<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Profesors</label>
            </form>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <input type="hidden" name="type" value="Course">
                <input type="hidden" name="action" value="Delete">
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($professors as $professor)
                    {
                        echo('<li class="list-group-item">');
                        echo("<a class='professor' href='#' data-id='".$professor->getProfessorId()."'>".$professor->getProfessorName()."</a>");
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
