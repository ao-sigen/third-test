<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\User;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $day = 0;
        $date = now()->subDays($day++); // 1日ずつ遡る

        return [
            'user_id' => User::factory(),
            'date' => fake()->dateTimeBetween('-40 days', 'now')->format('Y-m-d'),
            'weight' => fake()->randomFloat(50, 70, 35),
            'calories' => fake()->numberBetween(1500, 2000),
            'exercise_time' => fake()->numberBetween(0, 120),
            'exercise_content' => fake()->sentence(3),
        ];
    }
}
