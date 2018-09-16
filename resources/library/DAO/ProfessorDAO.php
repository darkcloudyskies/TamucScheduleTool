<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:37 PM
 */

require_once __DIR__.'/../database/DatabaseConnection.php';
require_once __DIR__.'/ProfessorRatingDAO.php';

class ProfessorDAO
{
    public function getAllProfessors(): array
    {
        $professors = array();

        $sql = "SELECT * FROM professor";

        $conn = (new DatabaseConnection())->getConnection();
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $professor = new professor();

                $professor->setProfessorId($row["professorId"]);
                $professor->setProfessorName($row["professorName"]);
                $professor->setProfessorRatings((new ProfessorRatingDAO())->getProfessorRatingsFromProfessorId($row["professorId"]));

                $professors[] = $professor;
            }
        }

        $conn->close();

        return $professors;
    }

    public function getProfessorFromId(int $professorId): Professor
    {
        $professor = new Professor();

        $sql = "SELECT * FROM professor
                WHERE professorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$professorId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $professor->setProfessorId($row["professorId"]);
            $professor->setProfessorName($row["professorName"]);
            $professor->setProfessorRatings((new ProfessorRatingDAO())->getProfessorRatingsFromProfessorId($row["professorId"]));
        }

        $conn->close();

        return $professor;
    }

    public function getProfessorFromName(int $professorName): Professor
    {
        $professor = new Professor();

        $sql = "SELECT * FROM professor
                WHERE professorName = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("s",$professorName);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $professor->setProfessorId($row["professorId"]);
            $professor->setProfessorName($row["professorName"]);
            $professor->setProfessorRatings((new ProfessorRatingDAO())->getProfessorRatingsFromProfessorId($row["professorId"]));
        }

        $conn->close();

        return $professor;
    }

    public function getProfessorsFromSectionId(int $sectionId): array
    {
        $professors = array();

        $sql = "SELECT * FROM professor
                WHERE professorId IN 
                (SELECT professorId FROM sectionprofessor
                WHERE sectionId = ?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$sectionId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $professor = new professor();

                $professor->setProfessorId($row["professorId"]);
                $professor->setProfessorName($row["professorName"]);
                $professor->setProfessorRatings((new ProfessorRatingDAO())->getProfessorRatingsFromProfessorId($row["professorId"]));

                $professors[] = $professor;
            }
        }

        $conn->close();

        return $professors;
    }

    public function updateProfessor(Professor $professor): bool
    {
        $sql = "UPDATE professor SET
                professorName = ?
                WHERE professorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("si",$professor->getProfessorName(),$professor->getProfessorId());

        $result = $pst->execute();

        $conn->close();

        return $result;
    }

    public function insertProfessor(Professor $professor): bool
    {
        $sql = "INSERT INTO professor (professorName)
                VALUES (?)";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);

        $pst->bind_param("s",$professor->getProfessorName());

        $result = $pst->execute();

        $professor->setProfessorId($conn->insert_id);

        $conn->close();

        return $result;
    }

    public function deleteProfessor(Professor $professor): bool
    {
        $sql = "DELETE FROM professor
                WHERE professorId = ?";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$professor->getProfessorId());
        $result = $pst->execute();

        $conn->close();

        return $result;
    }
}