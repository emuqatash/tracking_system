<?php

namespace Database\Factories;

use App\Models\DrivingLicense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DrivingLicenseFactory extends Factory
{
    protected $model = DrivingLicense::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'dl_number' => $this->faker->word(),
            'expiry_date' => Carbon::now(),
            'remind_before' => $this->faker->randomNumber(),
            'remarks' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
