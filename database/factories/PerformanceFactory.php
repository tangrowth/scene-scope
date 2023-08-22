<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PerformanceFactory extends Factory
{
    public function definition()
    {
        $address = Str::replaceFirst($this->faker->postcode, '', $this->faker->address);

        return [
            'title' => $this->faker->word,
            'description' => $this->faker->realText,
            'zip' => $this->faker->postcode,
            'address' => trim($address),
            'venue' => $this->faker->city,
            'web_site_url' => $this->faker->url,
            'company_id' => Company::inRandomOrder()->first()->id,
        ];
    }
}
