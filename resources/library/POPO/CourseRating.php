<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:19 PM
 */

class CourseRating implements JsonSerializable
{
    private $courseRatingId = -1;
    private $courseReview;
    private $courseRating;

    private $studentId;
    private $courseId;

    /**
     * @return mixed
     */
    public function getCourseRatingId(): int
    {
        return $this->courseRatingId;
    }

    /**
     * @param mixed $courseRatingId
     */
    public function setCourseRatingId(int $courseRatingId): void
    {
        $this->courseRatingId = $courseRatingId;
    }

    /**
     * @return mixed
     */
    public function getCourseReview(): string
    {
        return $this->courseReview;
    }

    /**
     * @param mixed $courseReview
     */
    public function setCourseReview(string $courseReview): void
    {
        $this->courseReview = $courseReview;
    }

    /**
     * @return mixed
     */
    public function getCourseRating(): int
    {
        return $this->courseRating;
    }

    /**
     * @param mixed $courseRating
     */
    public function setCourseRating(int $courseRating): void
    {
        $this->courseRating = $courseRating;
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
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * @param mixed $courseId
     */
    public function setCourseId($courseId): void
    {
        $this->courseId = $courseId;
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
            'courseId' => $this->getCourseId(),
            'studentId' => $this->getStudentId(),
            'courseReview' => $this->getCourseReview(),
            'courseRating' => $this->getCourseRating(),
            'courseRatingId' => $this->getCourseRatingId()
        ];
    }

    public function __toString() : String
    {
        return $this->getCourseRatingId();
    }

}