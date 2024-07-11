<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\SchoolClass;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        $subjects = ['Math', 'Science', 'English', 'History', 'Geography', 'Physics', 'Chemistry', 'Biology', 'Computer', 'Arts'];
        $classes = SchoolClass::all();

        foreach ($classes as $class) {
            foreach ($subjects as $subject) {
                Subject::create(['name' => $subject, 'class_id' => $class->id]);
            }
        }
    }
}
