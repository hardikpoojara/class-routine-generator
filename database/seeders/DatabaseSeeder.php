<?php

use Database\Seeders\ClassesTableSeeder;
use Database\Seeders\SectionsTableSeeder;
use Database\Seeders\SlotsTableSeeder;
use Database\Seeders\SubjectsTableSeeder;
use Database\Seeders\TeachersTableSeeder;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Slot;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TeachersTableSeeder::class,
            ClassesTableSeeder::class,
            SectionsTableSeeder::class,
            SubjectsTableSeeder::class,
            SlotsTableSeeder::class
        ]);
        // Seed teachers
        /*Teacher::factory(25)->create();

        // Seed subjects
        $subjects = ['Maths', 'Science', 'English', 'History', 'Geography', 'Art', 'Music', 'Physical Education', 'Computer Science', 'Social Studies'];

        foreach ($subjects as $subjectName) {
            $subject = Subject::factory()->create(['name' => $subjectName]);
            // Assign subjects uniquely to teachers
            $teachers = Teacher::inRandomOrder()->take(rand(1, 5))->get();
            foreach ($teachers as $teacher) {
                // Check if teacher already has this subject
                if (!$teacher->subjects()->where('subject_id', $subject->id)->exists()) {
                    $teacher->subjects()->attach($subject->id);
                }
            }
        }*/
    }
}
