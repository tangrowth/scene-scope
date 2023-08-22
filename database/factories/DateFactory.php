<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Date;
use App\Models\Performance;

class DateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Date::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now'),
            'capacity' => $this->faker->numberBetween(10, 50),
            'performance_id' => Performance::inRandomOrder()->first()->id,
        ];
    }
}
