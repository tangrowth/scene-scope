<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PerformanceFactory extends Factory
{
    public function definition()
    {
        $address = Str::replaceFirst($this->faker->postcode, '', $this->faker->address);

        $imagePath = 'storage\images\default.png';

        return [
            'title' => $this->faker->word,
            'description' => $this->faker->realText,
            'zip' => $this->faker->postcode,
            'address' => trim($address),
            'venue' => $this->faker->city,
            'web_site_url' => $this->faker->url,
            'company_id' => $this->faker->numberBetween(1, 10),
            'img_url' => $imagePath,
        ];
    }
}
