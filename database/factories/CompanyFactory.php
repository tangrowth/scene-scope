<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description'
            => $this->faker->realText,
            'web_site_url'
            => $this->faker->url,
        ];
    }
}
