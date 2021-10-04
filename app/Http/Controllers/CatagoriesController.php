<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Images;
use App\Models\Users;
use App\Models\Feedbacks;
use App\Models\Catagories;

class CatagoriesController extends Controller
{
    public function overview($user_id) {

        $user = Users::where('id', '=', $user_id)->first();
        $catagories = Catagories::all();
        $filtered_posts = [];

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

        $posts = $filtered_posts;

        $catagory_filter = request('catagory');

        return view('posts.overview', [
            'user_id' => $user_id,
            'user' => $user,
            'users' => Users::all(),
            'posts' => $posts,
            'images' => Images::all(),
            'catagories' => $catagories,
            'catagory_filter' => $catagory_filter,
            'username' => $user->username]);
    }
}
