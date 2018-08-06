<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:21 PM
 */

class ProfessorRating implements JsonSerializable
{
    private $professorRatingId;
    private $professorRating;
    private $professorReview;

    private $studentId;
    private $professorId;

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

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId): void
    {
        $this->studentId = $studentId;
    }

    /**
     * @return mixed
     */
    public function getProfessorId()
    {
        return $this->professorId;
    }

    /**
     * @param mixed $professorId
     */
    public function setProfessorId($professorId): void
    {
        $this->professorId = $professorId;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'professorId' => $this->getProfessorId(),
            'studentId' => $this->getStudentId(),
            'professorReview' => $this->getProfessorReview(),
            'professorRating' => $this->getProfessorRating(),
            'profesorRatingId' => $this->getProfessorRatingId()
        ];
    }
}