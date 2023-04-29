<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Performance;

class PerformanceFactory extends Factory
{
    public function definition()
    {
        $imagePath = '/storage/img/cat.jpg';

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
            'img_url'
            => $imagePath,
        ];
    }
}
