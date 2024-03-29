<?php

namespace Database\Factories;

use App\Models\Date;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(1, 4),
            'uuid' => $this->faker->uuid,
            'date_id' => 56,
            'user_id' => User::inRandomOrder()->first()->id,
            'is_canceled' =>$this->faker->boolean,
            'is_used' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
