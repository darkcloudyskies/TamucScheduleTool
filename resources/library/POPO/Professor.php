<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:20 PM
 */

require_once 'ProfessorRating.php';

class Professor
{
    private $professorId;
    private $professorName;

    private $professorRatings = array();

    /**
     * @return mixed
     */
    public function getProfessorId(): int
    {
        return $this->professorId;
    }

    /**
     * @param mixed $professorId
     */
    public function setProfessorId(int $professorId): void
    {
        $this->professorId = $professorId;
    }

    /**
     * @return mixed
     */
    public function getProfessorName(): string
    {
        return $this->professorName;
    }

    /**
     * @param mixed $professorName
     */
    public function setProfessorName(string $professorName): void
    {
        $this->professorName = $professorName;
    }

    /**
     * @return array
     */
    public function getProfessorRatings(): array
    {
        return $this->professorRatings;
    }

    /**
     * @param array $professorRatings
     */
    public function setProfessorRatings(array $professorRatings): void
    {
        $this->professorRatings = $professorRatings;
    }
}