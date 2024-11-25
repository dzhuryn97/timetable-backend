<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class DaySlotFactory extends Factory
{
    public function definition()
    {

        $data = [
            'date' => \Carbon\Carbon::createFromTimeStamp(fake()->dateTimeBetween('now', '+7 days')->getTimestamp()),
        ];

        switch (fake()->randomElement(StatusEnum::cases())) {
            case StatusEnum::PRESENT:
                $extra = [
                    'status' => StatusEnum::PRESENT,
                    'workHours' => fake()->randomElement(['09:00-18:00'])
                ];
                break;
            case StatusEnum::ABSENT:

                $extra = [
                    'status' => StatusEnum::ABSENT,
                    'absentReason' => fake()->randomElement(['Відпустка', 'Лікарняний']),
                    'replacementId' => Doctor::factory()->create()
                ];

                break;
            default:
                throw new \InvalidArgumentException();
        }

        return array_merge($data, $extra);
    }
}
