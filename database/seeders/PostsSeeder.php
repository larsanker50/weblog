<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\Catagories;
use App\Models\Feedbacks;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedbacks = Feedbacks::All();

        Posts::factory(10)->create()->each(function ($post) {
            $catagories = Catagories::factory(2)->create();
            $post->catagories()->saveMany($catagories);
        });
    }
}
