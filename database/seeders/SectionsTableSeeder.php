<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = range('A', 'K');

        $sections = range('A', 'K');
        foreach ($sections as $section) {
            Section::create(['name' => $section]);
        }
    }
}
