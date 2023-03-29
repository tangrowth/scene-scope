<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerformanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description'
            => $this->faker->realText,
            'venue'
            => $this->faker->city,
            'price'
            => $this->faker->numberBetween(0, 2000),
            'web_site_url'
            => $this->faker->url,
            'company_id'
            => $this->faker->numberBetween(1, 3),
        ];
    }
}
