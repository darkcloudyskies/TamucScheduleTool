<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:21 PM
 */

class ProfessorRating
{
    private $professorRatingId;
    private $professorRating;
    private $professorReview;

    /**
     * @return mixed
     */
    public function getProfessorRatingId(): int
    {
        return $this->professorRatingId;
    }

    /**
     * @param mixed $professorRatingId
     */
    public function setProfessorRatingId(int $professorRatingId): void
    {
        $this->professorRatingId = $professorRatingId;
    }

    /**
     * @return mixed
     */
    public function getProfessorRating(): int
    {
        return $this->professorRating;
    }

    /**
     * @param mixed $professorRating
     */
    public function setProfessorRating(int $professorRating): void
    {
        $this->professorRating = $professorRating;
    }

    /**
     * @return mixed
     */
    public function getProfessorReview(): string
    {
        return $this->professorReview;
    }

    /**
     * @param mixed $professorReview
     */
    public function setProfessorReview(string $professorReview): void
    {
        $this->professorReview = $professorReview;
    }
}