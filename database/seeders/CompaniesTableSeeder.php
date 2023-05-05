<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->count(10)->create();
        $param = [
            'name' => '劇団１',
            'description' => 'これはテストの劇団です',
            'web_site_url' => 'http://127.0.0.1:8000/',
            'img_url' => 'storage\images\default.png',
            'user_id' => 2,
        ];
        DB::table('companies')->insert($param);
    }
}
