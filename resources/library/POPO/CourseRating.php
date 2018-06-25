<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:19 PM
 */

class CourseRating
{
    private $courseRatingId;
    private $courseReview;
    private $courseRating;

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
    public function getCourseRating(): CourseRating
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
}