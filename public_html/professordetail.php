<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/13/2018
 * Time: 4:31 PM
 */

require_once "../resources/library/POPO/Student.php";
require_once "../resources/library/DAO/ProfessorDAO.php";
require_once "../resources/library/DAO/ProfessorRatingDAO.php";
require_once "../resources/library/POPO/Professor.php";
require_once "../resources/library/POPO/ProfessorRating.php";


require_once "../resources/library/DAO/StudentDAO.php";

include_once ("common/loginCheck.php");

if (!empty($_GET["professorId"]))
{
    $professorDAO = new ProfessorDAO();
    $professor = $professorDAO->getProfessorFromId($_GET["professorId"]);
    $ratings = $professor->getProfessorRatings();
}
else {
    // Redirect them to the professors page
    header("Location: professors.php");
    exit();
}

if (!empty($_GET["rating"] && $_GET["review"]))
{
    $professorRatingDAO = new ProfessorRatingDAO();
    $studentDAO = new StudentDAO();
    $student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);
    $professorRating = $professorRatingDAO->getProfessorRatingFromStudentAndProfessorId($student->getStudentId(),$professor->getProfessorId());
    $professorRating->setStudentId($student->getStudentId());
    $professorRating->setProfessorId($professor->getProfessorId());
    $professorRating->setProfessorRating($_GET["rating"]);
    $professorRating->setProfessorReview($_GET["review"]);
    ccccccccc
}

include_once ("common/header.php");
?>

<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Professor Detail</label>
            </form>
        </div>
        <div class="card-body" class="mainContent">
            <h5 class="card-title">Professor Name</h5>
            <p class="card-text"><?=$professor->getProfessorName(); ?> </p>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Write A Review</label>
            </form>
        </div>
        <div class="card-body" class="mainContent">
            <form>
                <input type="hidden" name="professorId" value="<?=$professor->getProfessorId(); ?>">
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select multiple class="form-control" name="rating">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea class="form-control" name="review" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Professor Reviews</label>
            </form>
        </div>
        <div class="card-body" class="mainContent">

            <?php
            foreach ($ratings as $rating)
            {
                $studentDAO = new StudentDAO();
                $student = $studentDAO->getStudentFromId($rating->getStudentId());
                ?>
                <h5 class="card-title"><?=$student->getStudentName() ?> 's Rating</h5>
                <p class="card-text">Rating: <?=$rating->getProfessorRating(); ?></p>
                <p class="card-text">Review: <?=$rating->getProfessorReview(); ?></p>
                <?php
            }

            ?>
        </div>
    </div>

</main>
