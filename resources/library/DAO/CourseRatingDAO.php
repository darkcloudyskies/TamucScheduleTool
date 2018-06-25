<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:33 PM
 */

require_once '../database/DatabaseConnection.php';

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
            while($row = $result->fetch_assoc())
            {
                $courseRating = new CourseRating();

                $courseRating->setCourseRating($row["rating"]);
                $courseRating->setCourseRatingId($row["courseRatingId"]);
                $courseRating->setCourseReview($row["comments"]);

                $courseRatings[] = $courseRating;
            }
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
            $courseRating->setCourseRating($row["rating"]);
            $courseRating->setCourseRatingId($row["courseRatingId"]);
            $courseRating->setCourseReview($row["comments"]);
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
            $courseRating->setCourseRating($row["rating"]);
            $courseRating->setCourseRatingId($row["courseRatingId"]);
            $courseRating->setCourseReview($row["comments"]);
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
            while($row = $result->fetch_assoc())
            {
                $courseRating = new CourseRating();

                $courseRating->setCourseRating($row["rating"]);
                $courseRating->setCourseRatingId($row["courseRatingId"]);
                $courseRating->setCourseReview($row["comments"]);

                $courseRatings[] = $courseRating;
            }
        }

        $conn->close();

        return $courseRatings;
    }

    public function updateCourseRating(CourseRating $courseRating, Course $course,Student $student): bool
    {
        $sql = "UPDATE courserating SET
                courseRatingId = ?,
                studentId = ?,
                courseId = ?,
                rating = ?,
                comments = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iiiis",$courseRating->getCourseRatingId(),$student->getStudentId(),$course->getCourseId(),$courseRating->getCourseRating(),$courseRating->getCourseReview());

        $result = $pst->execute();

        $conn->close();

        return $result;
    }

    public function insertCourseRating(CourseRating $courseRating, Course $course,Student $student): bool
    {
        $sql = "INSERT INTO courserating (studentId, courseId, rating, comments)
                VALUES (?,?,?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iiis",$student->getStudentId(),$course->getCourseId(),$courseRating->getCourseRating(),$courseRating->getCourseReview());

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