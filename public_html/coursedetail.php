<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/13/2018
 * Time: 4:31 PM
 */

require_once "../resources/library/POPO/Student.php";
require_once "../resources/library/DAO/CourseDAO.php";
require_once "../resources/library/DAO/CourseRatingDAO.php";
require_once "../resources/library/POPO/Course.php";
require_once "../resources/library/POPO/CourseRating.php";


require_once "../resources/library/DAO/StudentDAO.php";

include_once ("common/loginCheck.php");

if (!empty($_GET["courseId"]))
{
    $courseDAO = new CourseDAO();
    $course = $courseDAO->getCourseFromId($_GET["courseId"]);
    $prefix = $course->getPrefix();
    $department = $prefix->getDepartment();
    $ratings = $course->getCourseRatings();
}
else {
    // Redirect them to the courses page
    header("Location: courses.php");
    exit();
}

if (!empty($_GET["rating"] && $_GET["review"]))
{
    $courseRatingDAO = new CourseRatingDAO();
    $studentDAO = new StudentDAO();
    $student = $studentDAO->getStudentFromUsername($_SESSION['user_id']);
    $courseRating = $courseRatingDAO->getCourseRatingFromStudentAndCourseId($student->getStudentId(),$course->getCourseId());
    $courseRating->setStudentId($student->getStudentId());
    $courseRating->setCourseId($course->getCourseId());
    $courseRating->setCourseRating($_GET["rating"]);
    $courseRating->setCourseReview($_GET["review"]);
    if(!$courseRatingDAO->updateCourseRating($courseRating))
    {
        $courseRatingDAO->insertCourseRating($courseRating);
    }
}

include_once ("common/header.php");
?>

<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Course Detail</label>
            </form>
        </div>
        <div class="card-body" class="mainContent">
            <h5 class="card-title">Department</h5>
            <p class="card-text"><?=$department->getDepartmentName(); ?> ( <?=$department->getDepartmentCode(); ?> )</p>
            <h5 class="card-title">Prefix</h5>
            <p class="card-text"><?=$prefix->getPrefixName(); ?></p>
            <h5 class="card-title">Course Name</h5>
            <p class="card-text"><?=$course->getCourseName(); ?></p>
            <h5 class="card-title">Course Hours</h5>
            <p class="card-text"><?=$course->getHours(); ?></p>
            <h5 class="card-title">Course Number</h5>
            <p class="card-text"><?=$course->getCourseNum(); ?></p>
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
                <input type="hidden" name="courseId" value="<?=$course->getCourseId(); ?>">
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
                <label class="mr-4">Course Reviews</label>
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
                    <p class="card-text">Rating: <?=$rating->getCourseRating(); ?></p>
                    <p class="card-text">Review: <?=$rating->getCourseReview(); ?></p>
                <?php
            }

            ?>
        </div>
    </div>

</main>
