<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['id' => 1, 'name' => 'Create Vehicle', 'guard_name' => 'web', 'created_at' => '2023-10-05 14:26:35', 'updated_at' => '2023-10-07 02:33:53', 'account_id' => 1],
            ['id' => 2, 'name' => 'Edit Vehicle', 'guard_name' => 'web', 'created_at' => '2023-10-05 14:39:14', 'updated_at' => '2023-10-07 02:38:19', 'account_id' => 1],
            ['id' => 3, 'name' => 'Delete Vehicle', 'guard_name' => 'web', 'created_at' => '2023-10-06 04:50:24', 'updated_at' => '2023-10-07 02:38:44', 'account_id' => 1],
            ['id' => 4, 'name' => 'Create Part', 'guard_name' => 'web', 'created_at' => '2023-10-06 04:50:40', 'updated_at' => '2023-10-07 02:38:35', 'account_id' => 1],
            ['id' => 5, 'name' => 'Edit Part', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:39:23', 'updated_at' => '2023-10-07 02:39:23', 'account_id' => 1],
            ['id' => 6, 'name' => 'Delete Part', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:39:38', 'updated_at' => '2023-10-07 02:39:38', 'account_id' => 1],
            ['id' => 7, 'name' => 'Create Shop', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:40:53', 'updated_at' => '2023-10-07 02:40:53', 'account_id' => 1],
            ['id' => 8, 'name' => 'Edit Shop', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:41:06', 'updated_at' => '2023-10-07 02:41:06', 'account_id' => 1],
            ['id' => 9, 'name' => 'Delete Shop', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:41:18', 'updated_at' => '2023-10-07 02:41:18', 'account_id' => 1],
            ['id' => 10, 'name' => 'Create DL', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:41:52', 'updated_at' => '2023-10-07 02:41:52', 'account_id' => 1],
            ['id' => 11, 'name' => 'Edit DL', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:42:05', 'updated_at' => '2023-10-07 02:42:05', 'account_id' => 1],
            ['id' => 12, 'name' => 'Delete DL', 'guard_name' => 'web', 'created_at' => '2023-10-07 02:42:26', 'updated_at' => '2023-10-07 02:42:26', 'account_id' => 1],
            ['id' => 13, 'name' => 'Create Miscellaneous', 'guard_name' => 'web', 'created_at' => '2023-10-11 16:53:42', 'updated_at' => '2023-10-11 16:53:42', 'account_id' => 1],
            ['id' => 14, 'name' => 'Edit Miscellaneous', 'guard_name' => 'web', 'created_at' => '2023-10-11 16:53:50', 'updated_at' => '2023-10-11 16:53:50', 'account_id' => 1],
            ['id' => 15, 'name' => 'Delete Miscellaneous', 'guard_name' => 'web', 'created_at' => '2023-10-11 16:53:57', 'updated_at' => '2023-10-11 16:53:57', 'account_id' => 1],
            ['id' => 16, 'name' => 'Create Category', 'guard_name' => 'web', 'created_at' => '2023-10-11 19:18:21', 'updated_at' => '2023-10-11 19:18:21', 'account_id' => 1],
            ['id' => 17, 'name' => 'Edit Category', 'guard_name' => 'web', 'created_at' => '2023-10-11 19:18:53', 'updated_at' => '2023-10-11 19:18:53', 'account_id' => 1],
            ['id' => 18, 'name' => 'Delete Category', 'guard_name' => 'web', 'created_at' => '2023-10-11 19:19:02', 'updated_at' => '2023-10-11 19:19:02', 'account_id' => 1],
            ['id' => 19, 'name' => 'Edit Service', 'guard_name' => 'web', 'created_at' => '2023-11-07 23:05:51', 'updated_at' => '2023-11-07 23:05:51', 'account_id' => 1],
            ['id' => 20, 'name' => 'Create Service', 'guard_name' => 'web', 'created_at' => '2023-11-07 23:22:01', 'updated_at' => '2023-11-07 23:22:01', 'account_id' => 1],
            ['id' => 21, 'name' => 'Delete Service', 'guard_name' => 'web', 'created_at' => '2023-11-07 23:23:12', 'updated_at' => '2023-11-07 23:23:12', 'account_id' => 1]
        ];

        DB::table('permissions')->insert($permissions);
    }
}
