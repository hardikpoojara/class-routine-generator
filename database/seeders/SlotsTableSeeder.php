<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotsTableSeeder extends Seeder
{
    public function run()
    {
        $slots = [
            '08:00-08:30', '08:30-09:00', '09:00-09:30', '09:30-10:00',
            '10:00-10:15', // Break
            '10:15-10:45', '10:45-11:15', '11:15-11:45', '11:45-12:15'
        ];

        foreach ($slots as $slot) {
            Slot::create(['time' => $slot]);
        }
    }
}
