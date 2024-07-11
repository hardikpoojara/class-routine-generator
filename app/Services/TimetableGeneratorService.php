<?php

namespace App\Services;

use App\Models\Slot;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SchoolClass;

class TimetableGeneratorService
{
    public static function generate(): array
    {
        $teachers = Teacher::all();
        $classes = SchoolClass::all();
        $sections = Section::all();
        $subjects = Subject::all();
        $slots = Slot::all();

        $timetable = [];
        $assignedTeachers = [];
        $assignedSubjects = [];

        foreach ($classes as $class) {
            foreach ($sections as $section) {
                $classSectionKey = $class->name . '-' . $section->name;
                $timetable[$classSectionKey] = self::generateTimetableForClassSection(
                    $teachers, $subjects, $slots, $assignedTeachers, $assignedSubjects
                );
            }
        }

        return $timetable;
    }

    private static function generateTimetableForClassSection($teachers, $subjects, $slots, &$assignedTeachers, &$assignedSubjects): array
    {
        $timetable = [];

        foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'] as $day) {
            $dailyTimetable = [];

            foreach ($slots as $slot) {
                if ($slot->is_break) {
                    $dailyTimetable[$slot->time] = 'Break';
                } else {
                    $availableSubjects = $subjects->filter(function ($subject) use ($assignedSubjects, $day) {
                        return !isset($assignedSubjects[$subject->id][$day]) || $assignedSubjects[$subject->id][$day] < 4;
                    });

                    $subject = $availableSubjects->isNotEmpty() ? $availableSubjects->random() : $subjects->random();
                    $availableTeachers = $teachers->filter(function ($teacher) use ($assignedTeachers, $subject, $day, $slot) {
                        $isAssignedToday = isset($assignedTeachers[$teacher->id][$day]);
                        $isAssignedSlot = isset($assignedTeachers[$teacher->id][$day][$slot->time]);
                        $isAssignedSubject = isset($assignedTeachers[$teacher->id][$day][$subject->id]);
                        return !$isAssignedToday || (!$isAssignedSlot && !$isAssignedSubject && $assignedTeachers[$teacher->id][$day]['count'] < 4);
                    });

                    if ($availableTeachers->isEmpty()) {
                        $dailyTimetable[$slot->time] = 'No teachers found';
                    } else {
                        $teacher = $availableTeachers->random();

                        if (!isset($assignedTeachers[$teacher->id][$day])) {
                            $assignedTeachers[$teacher->id][$day] = ['count' => 0];
                        }
                        $assignedTeachers[$teacher->id][$day]['count']++;
                        $assignedTeachers[$teacher->id][$day][$slot->time] = $subject->id;
                        $assignedTeachers[$teacher->id][$day][$subject->id] = true;

                        if (!isset($assignedSubjects[$subject->id][$day])) {
                            $assignedSubjects[$subject->id][$day] = 0;
                        }
                        $assignedSubjects[$subject->id][$day]++;

                        $dailyTimetable[$slot->time] = $subject->name . ' by ' . $teacher->name;
                    }
                }
            }

            $timetable[$day] = $dailyTimetable;
        }

        return $timetable;
    }
}
