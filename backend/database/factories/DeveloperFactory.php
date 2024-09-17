<?php

namespace Database\Factories;

use App\Models\Developer;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DeveloperFactory extends Factory
{
    protected $model = Developer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'sex' => $this->faker->word(),
            'dt_birth' => Carbon::now(),
            'hobby' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'level_id' => Level::factory(),
        ];
    }
}
