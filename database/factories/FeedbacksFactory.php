<?php

namespace Database\Factories;

use App\Models\Feedbacks;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbacksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedbacks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'body' => $this->faker->sentence,
        ];
    }
}
