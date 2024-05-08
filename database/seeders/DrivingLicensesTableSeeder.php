<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrivingLicensesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('driving_licenses')->insert([
            [
                'id' => 1,
                'name' => 'Emad Muqatash',
                'license_number' => '45890350',
                'expiry_date' => '2028-12-28',
                'license_country_id' => 180,
                'license_name' => 'US Driving License',
                'attachments' => '[]',
                'attachment_titles' => '',
                'default' => 1,
                'created_at' => '2023-10-02 03:27:37',
                'updated_at' => '2023-11-11 03:31:42',
                'country' => 'United States',
                'user_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Christina Samara',
                'license_number' => '45986170',
                'expiry_date' => '2028-12-04',
                'license_country_id' => 180,
                'license_name' => null,
                'attachments' => '[]',
                'attachment_titles' => '',
                'default' => 1,
                'created_at' => '2023-11-11 03:30:19',
                'updated_at' => '2023-11-11 03:30:19',
                'country' => 'United States',
                'user_id' => 1,
            ]
        ]);
    }
}
