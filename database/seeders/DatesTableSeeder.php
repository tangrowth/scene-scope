<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Date;

class DatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Date::factory()->count(30)->create();
    }
}
