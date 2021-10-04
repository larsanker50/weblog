<?php

namespace App\Http\Controllers;

// CR :: imports die niet worden gebruikt mag je opruimen
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Images;
use App\Models\Users;
use App\Models\Feedbacks;
use App\Models\Catagories;

class CatagoriesController extends Controller
{
    // CR :: probeer het bij de CRUD van laravel te houden
    public function overview($user_id)
    {
        // CR :: RouteModelBinding toepassen
        $user = Users::where('id', '=', $user_id)->first();
        $catagories = Catagories::all();
        $filtered_posts = [];

        // CR :: op basis van de geselecteerde categorie zou je category->posts() kunnen doen
        // Bijvoorbeeld: $filtered_posts = Category::where('id', $category_id)->load('posts')

        if (request('catagory') == 'all') {
            $filtered_posts = Posts::all();
        } else {
            foreach (Posts::all() as $post) {
                $checked = false;

                foreach ($catagories as $catagory) {
                    foreach ($post->catagories as $post_catagory) {
                        if (request('catagory') == $post_catagory->name) {
                            $checked = true;
                        }
                    }
                }
                if ($checked == true) {
                    $filtered_posts[] = $post;
                }
            }
        }
        // CR :: je kan gelijk $filtered_posts; teruggeven in je return view()
        $posts = $filtered_posts;
        // CR :: onnodig om opnieuw te defieneren
        $catagory_filter = request('catagory');

        // CR :: hier geef je wel heel veel terug met de view. (zelfs ALLE users)
        return view('posts.overview', [
            'user_id' => $user_id,
            'user' => $user,
            'users' => Users::all(),
            'posts' => $posts,
            'images' => Images::all(),
            'catagories' => $catagories,
            'catagory_filter' => $catagory_filter,
            'username' => $user->username
        ]);
    }
}
