<?php

namespace Database\Factories;

use App\Models\Slot;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlotFactory extends Factory
{
    protected $model = Slot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $slotCounter = 1;
        $isBreak = ($slotCounter++ === 5);
        $startTime = now()->startOfDay()->addMinutes(($slotCounter - 1) * 30);
        $endTime = $startTime->copy()->addMinutes($isBreak ? 15 : 30);

        return [
            'start_time' => $startTime->toTimeString(),
            'end_time' => $endTime->toTimeString(),
            'is_break' => $isBreak,
        ];
    }
}
