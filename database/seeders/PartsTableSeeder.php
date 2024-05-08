<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartsTableSeeder extends Seeder
{
    public function run()
    {
        $parts = [
            ['id' => 1, 'name' => 'Brake Rotor-Rear', 'created_at' => '2023-08-24 16:41:32', 'updated_at' => '2023-09-04 14:36:26', 'account_id' => null],
            ['id' => 2, 'name' => 'Brake Rotor-Front', 'created_at' => '2023-08-24 16:49:39', 'updated_at' => '2023-09-04 14:36:42', 'account_id' => null],
            ['id' => 4, 'name' => 'Oil filter', 'created_at' => '2023-08-24 16:51:04', 'updated_at' => '2023-08-24 16:51:04', 'account_id' => null],
            ['id' => 5, 'name' => 'Air filter-Engine', 'created_at' => '2023-08-24 16:51:59', 'updated_at' => '2023-09-04 14:36:57', 'account_id' => null],
            ['id' => 6, 'name' => 'Air filter-Cabin', 'created_at' => '2023-08-24 16:52:25', 'updated_at' => '2023-09-04 14:37:09', 'account_id' => null],
            ['id' => 7, 'name' => 'Brake Pads-Front', 'created_at' => '2023-08-24 16:53:18', 'updated_at' => '2023-08-24 16:53:18', 'account_id' => null],
            ['id' => 8, 'name' => 'Brake Pads-Rear', 'created_at' => '2023-08-24 16:53:33', 'updated_at' => '2023-08-24 16:53:33', 'account_id' => null],
            ['id' => 9, 'name' => 'Light bulb-Front', 'created_at' => '2023-08-24 16:53:55', 'updated_at' => '2023-08-24 16:53:55', 'account_id' => null],
            ['id' => 10, 'name' => 'Light bulb-Rear', 'created_at' => '2023-08-24 16:54:07', 'updated_at' => '2023-08-24 16:54:07', 'account_id' => null],
            ['id' => 11, 'name' => 'Windshield ipers-Front', 'created_at' => '2023-08-24 16:54:32', 'updated_at' => '2023-08-24 16:54:32', 'account_id' => null],
            ['id' => 12, 'name' => 'Windshield wipers-Rear', 'created_at' => '2023-08-24 16:54:46', 'updated_at' => '2023-08-24 16:54:46', 'account_id' => null],
            ['id' => 14, 'name' => 'Battery', 'created_at' => '2023-09-04 15:32:21', 'updated_at' => '2023-09-04 15:32:21', 'account_id' => null],
            ['id' => 20, 'name' => 'Test', 'created_at' => '2023-09-14 14:21:27', 'updated_at' => '2023-09-14 14:21:27', 'account_id' => null],
            ['id' => 21, 'name' => 'Tire Rotation & Alignment', 'created_at' => '2023-10-04 02:27:34', 'updated_at' => '2023-10-04 02:56:08', 'account_id' => null],
            ['id' => 22, 'name' => 'Transmission Fluid', 'created_at' => '2023-10-04 04:07:58', 'updated_at' => '2023-10-04 04:07:58', 'account_id' => null],
            ['id' => 23, 'name' => 'Others', 'created_at' => '2023-10-04 04:09:43', 'updated_at' => '2023-10-04 04:10:58', 'account_id' => null],
            ['id' => 24, 'name' => 'Part1', 'created_at' => '2023-10-13 18:28:15', 'updated_at' => '2023-10-13 18:28:15', 'account_id' => 2],
            ['id' => 25, 'name' => 'Part2', 'created_at' => '2023-10-13 18:41:27', 'updated_at' => '2023-10-13 18:41:27', 'account_id' => 2],
            ['id' => 26, 'name' => 'Part3', 'created_at' => '2023-10-17 04:43:21', 'updated_at' => '2023-10-17 04:43:21', 'account_id' => 2],
            ['id' => 32, 'name' => 'User2', 'created_at' => '2023-10-24 01:00:37', 'updated_at' => '2023-10-24 01:00:37', 'account_id' => 7],
            ['id' => 36, 'name' => 't1', 'created_at' => '2023-11-05 23:37:31', 'updated_at' => '2023-11-05 23:37:31', 'account_id' => 1],
            ['id' => 37, 'name' => 't2', 'created_at' => '2023-11-05 23:39:13', 'updated_at' => '2023-11-05 23:39:13', 'account_id' => 1],
            ['id' => 38, 'name' => 'User 2 A', 'created_at' => '2023-11-06 00:01:11', 'updated_at' => '2023-11-06 00:01:11', 'account_id' => 7],
            ['id' => 39, 'name' => 'Tire', 'created_at' => '2023-11-09 01:26:07', 'updated_at' => '2023-11-09 01:26:07', 'account_id' => null],
            ['id' => 40, 'name' => 'Spark Plug', 'created_at' => '2023-11-23 04:31:06', 'updated_at' => '2023-11-23 04:31:06', 'account_id' => 1],
        ];

        DB::table('parts')->insert($parts);
    }
}
