<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MiscellaneousCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('miscellaneous_categories')->insert([
            ['id' => 1, 'name' => 'House-Celina', 'created_at' => '2023-10-11 05:05:33', 'updated_at' => '2023-10-11 05:05:33', 'user_id' => 1],
            ['id' => 2, 'name' => 'House-Lamphere', 'created_at' => '2023-10-11 05:05:58', 'updated_at' => '2023-10-11 05:05:58', 'user_id' => 1],
            ['id' => 3, 'name' => 'M.S.U.I', 'created_at' => '2023-10-29 04:04:22', 'updated_at' => '2023-10-29 04:04:22', 'user_id' => 1],
            ['id' => 4, 'name' => 'Subscription', 'created_at' => '2023-10-30 02:38:08', 'updated_at' => '2023-10-30 02:38:08', 'user_id' => 1],
            ['id' => 5, 'name' => 'UAE', 'created_at' => '2023-11-01 01:53:52', 'updated_at' => '2023-11-01 01:55:08', 'user_id' => 1],
            ['id' => 6, 'name' => 'Bank', 'created_at' => '2023-11-02 14:16:04', 'updated_at' => '2023-11-02 14:16:04', 'user_id' => 1],
            ['id' => 7, 'name' => 'Passport', 'created_at' => '2023-11-02 14:18:55', 'updated_at' => '2023-11-02 14:18:55', 'user_id' => 1]
        ]);
    }
}
