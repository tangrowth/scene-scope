<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '管理者',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 2,
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '劇団１',
            'email' => 'owner@owner.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 1,
        ];

        $param = [
            'name' => 'テストユーザー',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 3,
        ];
        DB::table('users')->insert($param);
    }
}
