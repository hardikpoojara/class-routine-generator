<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Services\TimetableGeneratorService;

class TimetableController extends Controller
{
    public function generateTimetable()
    {
        $timetable = TimetableGeneratorService::generate();
        $teachers = Teacher::all();
        return view('timetable.index', compact('timetable', 'teachers'));
    }
}
