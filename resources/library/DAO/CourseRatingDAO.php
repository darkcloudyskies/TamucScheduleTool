<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:33 PM
 */

require_once __DIR__.'/../database/DatabaseConnection.php';

class CourseRatingDAO
{
    public function getAllCourseRatings(): array
    {
        $courseRatings = array();

        $sql = "SELECT *
                FROM courserating";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            $courseRatings = $this->getCourseRatingsFromResult($result);
        }

        $conn->close();

        return $courseRatings;
    }

    public function getCourseRatingFromId(int $courseRatingId): CourseRating
    {
        $courseRating = new CourseRating();

        $sql = "SELECT *
                FROM courserating
                WHERE courseRatingId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$courseRatingId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $courseRating = $this->getCourseRatingFromRow($row);
        }

        $conn->close();

        return $courseRating;
    }

    public function getCourseRatingFromStudentAndCourseId(int $studentId,int $courseId): CourseRating
    {
        $courseRating = new CourseRating();

        $sql = "SELECT *
                FROM courserating
                WHERE studentId = ?
                AND courseId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("ii",$studentId,$courseId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $courseRating = $this->getCourseRatingFromRow($row);
        }

        $conn->close();

        return $courseRating;
    }

    public function getCourseRatingsFromCourseId(int $courseId): array
    {
        $courseRatings = array();

        $sql = "SELECT *
                FROM courserating
                WHERE courseId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$courseId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            $courseRatings = $this->getCourseRatingsFromResult($result);
        }

        $conn->close();

        return $courseRatings;
    }

    private function getCourseRatingsFromResult(mysqli_result $result): array
    {
        $courseRatings = array();

        while($row = $result->fetch_assoc())
        {
            $courses[] = $this->getCourseRatingFromRow($row);
        }

        return $courseRatings;
    }

    private function getCourseRatingFromRow(array $row): CourseRating
    {
        $courseRating = new CourseRating();

        $courseRating->setCourseRating($row["rating"]);
        $courseRating->setCourseRatingId($row["courseRatingId"]);
        $courseRating->setCourseReview($row["comments"]);
        $courseRating->setStudentId($row["studentId"]);
        $courseRating->setCourseId($row["courseId"]);

        return $courseRating;
    }

    public function updateCourseRating(CourseRating $courseRating): bool
    {
        $sql = "UPDATE courserating SET
                studentId = ?,
                courseId = ?,
                rating = ?,
                comments = ?
                WHERE courseRatingId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iiisi",$courseRating->getStudentId(),$courseRating->getCourseId(),$courseRating->getCourseRating(),$courseRating->getCourseReview(),$courseRating->getCourseRatingId());

        $result = $pst->execute();

        $conn->close();

        return $result;
    }

    public function insertCourseRating(CourseRating $courseRating): bool
    {
        $sql = "INSERT INTO courserating (studentId, courseId, rating, comments)
                VALUES (?,?,?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iiis",$courseRating->getStudentId(),$courseRating->getCourseId(),$courseRating->getCourseRating(),$courseRating->getCourseReview());

        $result = $pst->execute();

        $courseRating->setCourseRatingId($conn->insert_id);

        $conn->close();

        return $result;
    }

    public function deleteCourseRating(CourseRating $courseRating): bool
    {
        $sql = "DELETE FROM courserating
                WHERE courseRatingId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$courseRating->getCourseRatingId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}