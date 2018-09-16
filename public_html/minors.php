<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/16/2018
 * Time: 5:16 PM
 */

require_once "../resources/library/DAO/MinorDAO.php";
require_once "../resources/library/POPO/Minor.php";

include_once ("common/loginCheck.php");

$minorDAO = new MinorDAO();
$minors = $minorDAO->getAllMinors();
include_once ("common/header.php");

?>

<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Available Minors</label>
            </form>
        </div>
        <div class="card-body">
            <form accept-charset="UTF-8" role="form">
                <input type="hidden" name="type" value="Course">
                <input type="hidden" name="action" value="Delete">
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($minors as $minor)
                    {
                        echo('<li class="list-group-item">');
                        echo($minor->getMinorName());
                        echo('<button type="submit" class="btn btn-outline-success float-right" name="minorId" value="'.$minor->getMinorId().'">Add Minor</button>');
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
