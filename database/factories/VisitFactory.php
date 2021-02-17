<?php

namespace Database\Factories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip' => $this->faker->city,
            'city' => $this->faker->city,
            'device' => $this->faker->unique()->safeEmail,
            'url' => $this->faker->unique()->safeEmail,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}

