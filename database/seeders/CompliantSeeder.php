<?php

namespace Database\Seeders;

use App\Models\CustomUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompliantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compliants')->insert([
            [
                'custom_user_id' => CustomUser::all()->first()->id,
                'content' => 'شكوى بخصوص تأخر صرف المنح',
                'email' => 'user1@example.com',
                'date' => '2024-05-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'custom_user_id' => CustomUser::all()->first()->id,
                'content' => 'اقتراح لتنظيم ورش عمل جديدة',
                'email' => 'user2@example.com',
                'date' => '2024-05-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
