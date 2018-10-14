<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:38 PM
 */

require_once __DIR__.'/../database/DatabaseConnection.php';

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
            $professorRatings = $this->getProfessorRatingsFromResult($result);
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
            $professorRating = $this->getProfessorRatingFromRow($row);
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
            $professorRating = $this->getProfessorRatingFromRow($row);
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
            $professorRatings = $this->getProfessorRatingsFromResult($result);
        }

        $conn->close();

        return $professorRatings;
    }

    private function getProfessorRatingsFromResult(mysqli_result $result): array
    {
        $professorRatings = array();

        while($row = $result->fetch_assoc())
        {
            $professorRatings[] = $this->getProfessorRatingFromRow($row);
        }

        return $professorRatings;
    }

    private function getProfessorRatingFromRow(array $row): ProfessorRating
    {
        $professorRating = new ProfessorRating();

        $professorRating->setProfessorRating($row["rating"]);
        $professorRating->setProfessorRatingId($row["professorRatingId"]);
        $professorRating->setProfessorReview($row["comments"]);
        $professorRating->setStudentId($row["studentId"]);
        $professorRating->setProfessorId($row["professorId"]);

        return $professorRating;
    }

    public function updateProfessorRating(ProfessorRating $professorRating): bool
    {
        $sql = "UPDATE professorrating SET
                studentId = ?,
                professorId = ?,
                rating = ?,
                comments = ?
                WHERE professorRatingId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("iiisi",$professorRating->getStudentId(),$professorRating->getProfessorId(),$professorRating->getProfessorRating(),$professorRating->getProfessorReview(),$professorRating->getProfessorRatingId());

        $result = $pst->execute();
        $result &= mysqli_stmt_affected_rows($pst) > 0;

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