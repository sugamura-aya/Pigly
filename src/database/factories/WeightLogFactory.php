<?php

namespace Database\Factories;

use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 99), // 40.0〜99kg
            'calories' => $this->faker->numberBetween(1500, 3500),
            'exercise_time' => sprintf('%02d:%02d:00', rand(0, 2), rand(0, 59)),
            'exercise_content' => $this->faker->randomElement(['ランニング', '筋トレ', 'ヨガ', 'サイクリング']),
        ];
    }
}
