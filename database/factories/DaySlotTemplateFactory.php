<?php

namespace Database\Factories;

use App\Models\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DaySlotTemplate>
 */
class DaySlotTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = [
            'dayNumber' => fake()->numberBetween(1, 7),
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
                ];

                break;
            default:
                throw new \InvalidArgumentException();
        }

        return array_merge($data, $extra);
    }
}
