<?php

namespace Database\Factories;

use App\Models\Part;
use App\Models\Service;
use App\Models\Shop;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'current_mileage' => $this->faker->randomNumber(),
            'part_warranty_period' => $this->faker->randomFloat(),
            'labor_warranty_period' => $this->faker->randomFloat(),
            'repair_date' => Carbon::now(),
            'part_cost' => $this->faker->randomFloat(),
            'labor_cost' => $this->faker->randomFloat(),
            'total_cost' => $this->faker->randomFloat(),
            'file' => $this->faker->words(),
            'file_original_filename' => $this->faker->words(),
            'image' => $this->faker->word(),
            'image_original_filename' => $this->faker->word(),
            'followup_mileage' => $this->faker->randomNumber(),
            'followup_date' => Carbon::now(),
            'remarks' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'part_warranty' => $this->faker->randomNumber(),
            'labor_warranty' => $this->faker->randomNumber(),
            'vehicle_id' => Vehicle::factory(),
            'part_id' => Part::factory(),
            'shop_id' => Shop::factory(),
        ];
    }
}
