<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web', 'account_id' => 1, 'created_at' => '2023-10-05 06:33:25', 'updated_at' => '2023-10-05 06:33:25', 'deleted_at' => null],
            ['id' => 2, 'name' => 'Supervisor', 'guard_name' => 'web', 'account_id' => 1, 'created_at' => '2023-10-05 14:12:49', 'updated_at' => '2023-10-05 14:12:49', 'deleted_at' => null],
            ['id' => 3, 'name' => 'Writer', 'guard_name' => 'web', 'account_id' => 1, 'created_at' => '2023-10-05 14:17:18', 'updated_at' => '2023-10-06 05:02:13', 'deleted_at' => null],
            ['id' => 4, 'name' => 'Create Only', 'guard_name' => 'web', 'account_id' => 1, 'created_at' => '2023-10-11 19:55:02', 'updated_at' => '2023-10-22 17:28:36', 'deleted_at' => null]
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
