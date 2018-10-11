<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/10/2018
 * Time: 4:28 PM
 */

class ScheduleBuilderDAO
{
    public function generateSchedule(ScheduleBuilderRequest $scheduleBuilderRequest): Schedule
    {
        $schedule = new Schedule();

        $sql = "SELECT * 
                FROM section /* Get All Sections */
                INNER JOIN course c ON section.courseId = c.courseId 
                
                AND c.courseId NOT IN 
                ( /*Get Courses student hasn't taken yet */
                  SELECT courseId FROM studentcourse WHERE studentId = ?
                )
                
                AND c.courseId NOT IN
                ( /* Get Only Courses in Student's major / minor */
                    SELECT c2.courseId FROM coursemajor c2 WHERE c2.majorId IN (SELECT majorId FROM studentmajor WHERE studentId = ?)
                    UNION
                    SELECT c3.courseId from courseminor c3 WHERE c3.minorId IN (SELECT minorId FROM studentminor WHERE studentId = ?)
                ) 
                
                AND c.courseId NOT IN /* Exclude Courses student can't take because he doesn't have prereq */
                (  
                    SELECT c4.courseId
                    FROM course
                    LEFT JOIN courseprereq c4 ON course.courseId = c4.courseId
                    WHERE c4.preReqId NOT IN (SELECT courseId from studentcourse WHERE studentId = ?)
                )
                 WHERE section.startTime
                
                ";

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("i",$scheduleId);
        $pst->execute();
        $result = $pst->get_result();

        if($result->num_rows > 0 && $row = $result->fetch_assoc())
        {
            $schedule = $this->getScheduleFromRow($row);
        }

        $conn->close();

        return $schedule;
    }
}