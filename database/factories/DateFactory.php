<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTime,
            'performance_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
