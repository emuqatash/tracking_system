<?php

namespace Database\Factories;

use App\Models\Miscellaneous;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MiscellaneousFactory extends Factory
{
    protected $model = Miscellaneous::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
