<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder
{
    public function run()
    {
        $shops = [
            ['id' => 1, 'name' => 'Advance Auto Parts', 'account_id' => null, 'created_at' => '2023-08-24 16:55:08', 'updated_at' => '2023-08-24 16:58:24'],
            ['id' => 2, 'name' => 'AutoZone', 'account_id' => null, 'created_at' => '2023-08-24 16:57:38', 'updated_at' => '2023-08-24 16:57:38'],
            ['id' => 3, 'name' => 'Pep Boys', 'account_id' => null, 'created_at' => '2023-08-24 16:58:43', 'updated_at' => '2023-08-24 16:58:43'],
            ['id' => 4, 'name' => 'Walmart', 'account_id' => null, 'created_at' => '2023-08-24 16:58:54', 'updated_at' => '2023-08-24 16:58:54'],
            ['id' => 5, 'name' => 'Amazon', 'account_id' => null, 'created_at' => '2023-08-24 16:59:07', 'updated_at' => '2023-08-24 16:59:07'],
            ['id' => 6, 'name' => 'eBay Motors', 'account_id' => null, 'created_at' => '2023-08-24 16:59:24', 'updated_at' => '2023-08-24 16:59:24'],
            ['id' => 7, 'name' => "O'Reilly Auto Parts", 'account_id' => null, 'created_at' => '2023-08-24 16:59:47', 'updated_at' => '2023-08-24 16:59:47'],
            ['id' => 12, 'name' => 'FIRESTONE', 'account_id' => null, 'created_at' => '2023-10-04 02:55:09', 'updated_at' => '2023-10-04 02:57:44'],
            ['id' => 13, 'name' => 'Huffines Hyundai', 'account_id' => null, 'created_at' => '2023-10-04 04:10:28', 'updated_at' => '2023-10-04 04:10:28'],
            ['id' => 14, 'name' => 'NAPA Auto', 'account_id' => 2, 'created_at' => '2023-10-13 17:30:07', 'updated_at' => '2023-10-23 01:25:25'],
            ['id' => 15, 'name' => 'Discount Tire', 'account_id' => 2, 'created_at' => '2023-10-13 18:22:48', 'updated_at' => '2023-10-23 01:25:57'],
            ['id' => 16, 'name' => 'D & V Auto Repair', 'account_id' => null, 'created_at' => '2023-10-18 18:54:13', 'updated_at' => '2023-10-18 18:54:13'],
            ['id' => 17, 'name' => 'Just Tires', 'account_id' => null, 'created_at' => '2023-10-20 02:10:54', 'updated_at' => '2023-10-20 02:10:54'],
            ['id' => 27, 'name' => 'Emad', 'account_id' => 1, 'created_at' => '2023-10-23 22:14:04', 'updated_at' => '2023-10-23 22:14:04'],
            ['id' => 29, 'name' => 'Amazon By Emad', 'account_id' => 2, 'created_at' => '2023-10-24 00:37:56', 'updated_at' => '2023-10-24 00:38:41'],
            ['id' => 30, 'name' => 'Amazon User2', 'account_id' => 7, 'created_at' => '2023-10-24 00:57:40', 'updated_at' => '2023-10-24 00:57:40'],
            ['id' => 31, 'name' => 'Just Test', 'account_id' => 1, 'created_at' => '2023-11-01 02:06:45', 'updated_at' => '2023-11-01 02:09:58'],
            ['id' => 32, 'name' => 'CreatedbyWriter2', 'account_id' => 7, 'created_at' => '2023-11-02 04:41:52', 'updated_at' => '2023-11-02 04:41:52'],
            ['id' => 33, 'name' => 'Emad Shop', 'account_id' => 1, 'created_at' => '2023-11-06 00:38:04', 'updated_at' => '2023-11-06 00:38:04'],
            ['id' => 34, 'name' => 'User 2 Shop', 'account_id' => 7, 'created_at' => '2023-11-06 00:38:56', 'updated_at' => '2023-11-06 00:38:56'],
        ];

        DB::table('shops')->insert($shops);
    }
}
