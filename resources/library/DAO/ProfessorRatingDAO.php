<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:38 PM
 */

require_once '../database/DatabaseConnection.php';

class ProfessorRatingDAO
{
    public function getAllProfessorRatings(): array
    {
        $professorRatings = array();

        $sql = "SELECT * FROM professorrating";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $professorRating = new ProfessorRating();

                $professorRating->setProfessorRating($row["rating"]);
                $professorRating->setProfessorRatingId($row["professorRatingId"]);
                $professorRating->setProfessorReview($row["comments"]);
                $professorRating->setStudentId($row["studentId"]);
                $professorRating->setProfessorId($row["professorId"]);

                $professorRatings[] = $professorRating;
            }
        }

        $conn->close();

        return $professorRatings;
    }

    public function getProfessorRatingFromId(int $professorRatingId): ProfessorRating
    {
        $professorRating = new ProfessorRating();

        $sql = "SELECT * FROM professorrating
                WHERE professorRatingId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$professorRatingId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $professorRating->setProfessorRating($row["rating"]);
            $professorRating->setProfessorRatingId($row["professorRatingId"]);
            $professorRating->setProfessorReview($row["comments"]);
            $professorRating->setStudentId($row["studentId"]);
            $professorRating->setProfessorId($row["professorId"]);
        }

        $conn->close();

        return $professorRating;
    }

    public function getProfessorRatingFromStudentAndProfessorId(int $studentId,int $professorId): ProfessorRating
    {
        $professorRating = new ProfessorRating();

        $sql = "SELECT * FROM professorrating
                WHERE studentId = ?
                AND professorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("ii",$studentId,$professorId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $professorRating->setProfessorRating($row["rating"]);
            $professorRating->setProfessorRatingId($row["professorRatingId"]);
            $professorRating->setProfessorReview($row["comments"]);
            $professorRating->setStudentId($row["studentId"]);
            $professorRating->setProfessorId($row["professorId"]);
        }

        $conn->close();

        return $professorRating;
    }

    public function getProfessorRatingsFromProfessorId(int $professorId): array
    {
        $professorRatings = array();

        $sql = "SELECT * FROM professorrating
                WHERE professorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$professorId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $professorRating = new ProfessorRating();

                $professorRating->setProfessorRating($row["rating"]);
                $professorRating->setProfessorRatingId($row["professorRatingId"]);
                $professorRating->setProfessorReview($row["comments"]);
                $professorRating->setStudentId($row["studentId"]);
                $professorRating->setProfessorId($row["professorId"]);

                $professorRatings[] = $professorRating;
            }
        }

        $conn->close();

        return $professorRatings;
    }

    public function updateProfessorRating(ProfessorRating $professorRating): bool
    {
        $sql = "UPDATE professorrating SET
                professorRatingId = ?,
                studentId = ?,
                professorId = ?,
                rating = ?,
                comments = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iiiis",$professorRating->getProfessorRatingId(),$professorRating->getStudentId(),$professorRating->getProfessorId(),$professorRating->getProfessorRating(),$professorRating->getProfessorReview());

        $result = $pst->execute();

        $conn->close();

        return $result;
    }

    public function insertProfessorRating(ProfessorRating $professorRating): bool
    {
        $sql = "INSERT INTO professorrating (studentId, professorId, rating, comments)
                VALUES (?,?,?,?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iiis",$professorRating->getStudentId(),$professorRating->getProfessorId(),$professorRating->getProfessorRating(),$professorRating->getProfessorReview());

        $result = $pst->execute();

        $professorRating->setProfessorRatingId($conn->insert_id);

        $conn->close();

        return $result;
    }

    public function deleteProfessorRating(ProfessorRating $professorRating): bool
    {
        $sql = "DELETE FROM professorrating
                WHERE professorRatingId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$professorRating->getProfessorRatingId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}