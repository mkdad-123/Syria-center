<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customusers')->insert([
            [
                'name' => 'user1',
                'email' => 'user1@example.com',
                'password' => 'password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user2',
                'email' => 'user2@example.com',
                'password' => 'password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
