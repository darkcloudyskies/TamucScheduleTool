<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:20 PM
 */

require_once __DIR__.'/ProfessorRating.php';

class Professor implements JsonSerializable
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
            'professorName' => $this->getProfessorName(),
            'professorRatings' => $this->getProfessorRatings()
        ];
    }

    public function __toString() : String
    {
        return $this->getProfessorId();
    }
}