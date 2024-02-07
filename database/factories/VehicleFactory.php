<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'make_model' => $this->faker->word(),
            'year' => $this->faker->randomNumber(),
            'mileage_at_purchase' => $this->faker->randomNumber(),
            'plate_no' => $this->faker->word(),
            'vin' => $this->faker->word(),
            'registration_date' => $this->faker->word(),
            'remind_before' => $this->faker->word(),
            'color' => $this->faker->word(),
            'vehicle_owner' => $this->faker->word(),
            'owner_email' => $this->faker->unique()->safeEmail(),
            'remarks' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
