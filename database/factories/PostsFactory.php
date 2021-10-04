<?php

namespace Database\Factories;

use App\Models\Posts;
use App\Models\Users;
use App\Models\Feedbacks;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => Users::factory(),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraphs(3, true),
            'premium' => $this->faker->boolean
        ];
    }

}
