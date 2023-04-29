<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerformanceFactory extends Factory
{
    public function definition()
    {
        $imagePath = 'storage\images\default.png';

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
            => $this->faker->numberBetween(1, 10),
            'img_url'
            => $imagePath,
        ];
    }
}
