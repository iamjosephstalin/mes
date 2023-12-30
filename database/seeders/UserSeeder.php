<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        if (Schema::hasTable('users')) {
            // DB::table('users')->truncate();
            DB::table('users')->insert([
                [
                    "name" => "Super Admin",
                    "role_id" => "1",
                    "email" => 'superadmin@gmail.com',
                    "password" => '$2a$12$U0jmoqoNcRmvYU5OoHAK0e2Y1ROt./D5zm9mh6tZ86rjwk2rVhuGK',
                    'mobile' => '9876543210',
                    'status' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]);
        }
        Schema::enableForeignKeyConstraints();
    
    }
}
