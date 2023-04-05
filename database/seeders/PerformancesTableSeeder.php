<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Performance;

class PerformancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Performance::factory()->count(10)->create();
    }
}
