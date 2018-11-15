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
        $scheduleDAO = new ScheduleDAO();
        $sectionDAO = new SectionDAO();

        $sql = "SELECT * 
                FROM section /* Get All Sections */
                INNER JOIN course c ON section.courseId = c.courseId 
                
                AND c.courseId NOT IN 
                ( /*Get Courses student hasn't taken yet */
                  SELECT courseId FROM studentcourse WHERE studentId = ?
                )
                
                AND c.courseId IN
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
                AND section.sectionId NOT IN(".implode(',',$scheduleBuilderRequest->getSectionIdBlackList()).") ";

        $sql .= $this->getTimeSQL($scheduleBuilderRequest);


        $schedule->setStudentId($scheduleBuilderRequest->getStudentId());
        $schedule->setScheduleName("test");

        $conn = (new DatabaseConnection())->getConnection();
        $pst = $conn->prepare($sql);
        $pst->bind_param("iiii",$scheduleBuilderRequest->getStudentId(),$scheduleBuilderRequest->getStudentId(),$scheduleBuilderRequest->getStudentId(),$scheduleBuilderRequest->getStudentId());
        $pst->execute();
        $result = $pst->get_result();

        $sections = $sectionDAO->getSectionsFromResult($result);

        $sections = $this->filterSections($sections,$scheduleBuilderRequest);

        $schedule->setSections($sections);
        $scheduleDAO->insertSchedule($schedule);

        $conn->close();

        return $schedule;
    }

    private function filterSections(array $sections, ScheduleBuilderRequest $scheduleBuilderRequest): array
    {
        $filteredSections = array();
        $totalHours = 0;
        $totalOnlineHours = 0;
        foreach ($sections as $section)
        {
            if($scheduleBuilderRequest->getMaximumHours() == $totalHours || $scheduleBuilderRequest->getMinimumHours() <= $totalHours)
            {
                break;
            }

            if(($section->getCourse()->getHours() + $totalHours) > $scheduleBuilderRequest->getMaximumHours())
            {
                continue;
            }

            if($this->sectionsContainCourseId($filteredSections,$section->getCourse()->getCourseId()))
            {
                continue;
            }

            if($section->getWeekDays() == "Web")
            {
                if(($section->getCourse()->getHours() + $totalOnlineHours) > $scheduleBuilderRequest->getMaximumOnlineHours())
                {
                    continue;
                }
                $totalOnlineHours += $section->getCourse()->getHours();
            }
            $totalHours += $section->getCourse()->getHours();
            $filteredSections[] = $section;


        }
        return $filteredSections;
    }


    private function sectionsContainCourseId($sections,$courseId) : bool
    {
        foreach ($sections as $section)
        {
            if($section->getCourse()->getCourseId() == $courseId)
            {
                return true;
            }
        }
        return false;
    }

    private function getTimeSQL(ScheduleBuilderRequest $scheduleBuilderRequest) : string
    {
        $sql = " AND ((section.weeKDays = 'Web') OR (1=1 ";
        $filters = $scheduleBuilderRequest->getFilter();

        foreach($filters->getMondayRanges() as $mondayRange)
        {
            $sql .= " AND ((section.startTime >= '" . $mondayRange->getStartTime() . "' AND section.endTime <= '".$mondayRange->getEndTime()."') OR section.weekDays NOT LIKE '%M%' )";
        }

        foreach($filters->getMondayRanges() as $tuesdayRange)
        {
            $sql .= " AND ((section.startTime >= '" . $tuesdayRange->getStartTime() . "' AND section.endTime <= '".$tuesdayRange->getEndTime()."') OR section.weekDays NOT LIKE '%T%' )";
        }

        foreach($filters->getMondayRanges() as $wednesdayRange)
        {
            $sql .= " AND ((section.startTime >= '" . $wednesdayRange->getStartTime() . "' AND section.endTime <= '" . $wednesdayRange->getEndTime()."') OR section.weekDays NOT LIKE '%W%' )";
        }

        foreach($filters->getMondayRanges() as $thursdayRange)
        {
            $sql .= " AND ((section.startTime >= '" . $thursdayRange->getStartTime() . "' AND section.endTime <= '".$thursdayRange->getEndTime()."') OR section.weekDays NOT LIKE '%R%' )";
        }

        foreach($filters->getMondayRanges() as $fridayRange)
        {
            $sql .= " AND ((section.startTime >= '" . $fridayRange->getStartTime() . "' AND section.endTime <= '".$fridayRange->getEndTime()."') OR section.weekDays NOT LIKE '%F%' )";
        }

        $sql .= "))";
        return $sql;
    }

}