<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description'
            => $this->faker->realText,
            'web_site_url'
            => $this->faker->url,
            'img_url'
            => $this->faker->url,
        ];
    }
}
