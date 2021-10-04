<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Images;
use App\Models\Users;
use App\Models\Feedbacks;
use App\Models\Catagories;

class PostsController extends Controller
{
    public function index()
    {

        return view('posts/index');
    }

    // CR :: Routemodelbinding maakt je leven hier een stuk makkelijker, als je dat goed toepast heb je al die requests naar de DB niet nodig
    public function view($user_id, $post_id)
    {

        $post = Posts::where('id', '=', $post_id)->first();
        $user = Users::where('id', '=', $user_id)->first();
        $image = Images::where('id', '=', $post->image_id)->first();


        return view('posts/view', [
            'post' => $post,
            'feedbacks' => Feedbacks::all(),
            'user' => $user,
            'user_id' => $user_id,
            'image' => $image,
            'users' => Users::all()
        ]);
    }

    // CR :: route model binding
    public function overview($user_id)
    {

        $user = Users::where('id', '=', $user_id)->first();

        // CR :: deze if statement is niet nodig
        if (request('catagory') == 'all' || request('catagory') == null) {
            $posts = Posts::all();
        } else {
            $posts = Posts::all();
        }

        // CR :: hier geef je wel heel veel terug met de view. (zelfs ALLE users)
        return view('posts.overview', [
            'user_id' => $user_id,
            'user' => $user,
            'users' => Users::all(),
            'posts' => $posts,
            'images' => Images::all(),
            'catagories' => Catagories::all(),
            'catagory_filter' => 'all',
            'username' => $user->username
        ]);
    }

    // CR :: route model binding, $user->posts->load('images'), $user->posts->load('categories')
    public function personal_overview($user_id)
    {

        $posts = Posts::where('user_id', '=', $user_id)->get();

        $user = Users::where('id', '=', $user_id)->first();

        return view('posts.personal_overview', [
            'user_id' => $user_id,
            'user' => $user,
            'images' => Images::all(),
            'catagories' => Catagories::all(),
            'posts' => $posts
        ]);
    }


    public function create($user_id)
    {

        return view('posts/post_create', [
            'user_id' => $user_id,
            'catagories' => Catagories::all()
        ]);
    }


    public function store($user_id)
    {
        // CR :: validatie mag middels Requests(https://laravel.com/docs/8.x/validation#form-request-validation)
        request()->validate([
            'title' => 'required',
            'catagories' => 'required',
            'post' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:1048576'
        ]);

        if (request('premium') === "true") {
            $premium = true;
        } else {
            $premium = false;
        }


        if (request('image')) {

            $newImageName = time() . '-' . request('title') . '.' . request('image')->extension();
            request('image')->move(public_path('images'), $newImageName);


            $image = new Images();
            $image->name = $newImageName;
            $image->path = 'images/' . $newImageName;
            $image->save();
        }

        foreach (request('catagories') as $catagory) {
            // CR :: Catagories::firstOrCreate()
            if (Catagories::where('name', '=', $catagory)->count() <= 0 && $catagory) {
                $DBcatagory = new Catagories();
                $DBcatagory->name = $catagory;
                $DBcatagory->save();
            }
        }

        // CR :: dit zou wel mooier kunnen denk ik
        foreach (Catagories::all() as $DBcatagory) {
            foreach (request('catagories') as $request_catagory) {
                if ($DBcatagory->name == $request_catagory) {
                    $post_catagories[] = $DBcatagory->id;
                }
            }
        }

        // CR :: je hebt toch al het user_id, waarom nog een keer ophalen?
        $users_DB = Users::where('id', $user_id)->first();
        $user_id = $users_DB->id;

        // CR :: Posts::create()
        $post = new Posts();
        $post->user_id = $user_id;
        $post->title = request('title');
        $post->body = request('post');
        if (request('image')) {
            $post->image_id = $image->id;
        } else {
            $post->image_id = NULL;
        }
        $post->premium = $premium;
        $post->save();

        $post->catagories()->sync($post_catagories);

        return redirect()->route('posts.overview', ['user_id' => $user_id]);
    }


    public function edit($user_id, $post_id)
    {

        $post = Posts::where('id', '=', $post_id)->first();

        if ($post->premium) {
            $premium_value = TRUE;
        } else {
            $premium_value = FALSE;
        }

        return view('posts/edit', [
            'post' => $post,
            'user_id' => $user_id,
            'catagories' => Catagories::all(),
            'premium_value' => $premium_value
        ]);
    }


    public function update($user_id, $post_id)
    {
        // CR :: RouteModelBinding!
        $post = Posts::where('id', '=', $post_id)->first();
        $user = Users::where('id', '=', $user_id)->first();
        $image = Images::where('id', '=', $post->image_id)->first();

        // CR :: validatie mag middels Requests(https://laravel.com/docs/8.x/validation#form-request-validation)
        request()->validate([
            'title' => 'required',
            'catagories' => 'required',
            'post' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:1048576'
        ]);


        if (request('premium') === "on") {
            $premium = true;
        } else {
            $premium = false;
        }


        if (request('image')) {

            $newImageName = time() . '-' . request('title') . '.' . request('image')->extension();
            request('image')->move(public_path('images'), $newImageName);

            if ($image === NULL) {
                $image = new Images();
            }

            $image->name = $newImageName;
            $image->path = 'images/' . $newImageName;
            $image->save();
        }

        $post->user_id = $user_id;
        $post->title = request('title');
        $post->body = request('post');

        if (request('image')) {
            $post->image_id = $image->id;
        } else if (!$post->image_id) {
            $post->image_id = NULL;
        }


        $post->premium = $premium;
        $post->update();

        $image = Images::where('id', '=', $post->image_id)->first();

        foreach (Catagories::all() as $DBcatagory) {
            foreach (request('catagories') as $request_catagory) {
                if ($DBcatagory->name == $request_catagory) {
                    $post_catagories[] = $DBcatagory->id;
                }
            }
        }

        $post->catagories()->sync($post_catagories);

        return view('posts/view', [
            'post' => Posts::where('id', '=', $post_id)->first(),
            'feedbacks' => Feedbacks::all(),
            'users' => Users::all(),
            'user' => $user,
            'user_id' => $user_id,
            'image' => $image
        ]);
    }


    public function destroy($user_id, $post_id)
    {

        $post = Posts::where('id', '=', $post_id)->first();
        $image = Images::where('id', '=', $post->image_id)->first();

        if ($image) {
            $image->delete();
        }

        $post->delete();

        return redirect()->route('posts.overview', ['user_id' => $user_id]);
    }

    public function premium($user_id)
    {

        $user = Users::where('id', '=', $user_id)->first();

        if ($user->premium) {
            $premium = TRUE;
        } else {
            $premium = FALSE;
        }

        return view('posts/premium', [
            'user_id' => $user_id,
            'premium' => $premium,
            'username' => $user->username
        ]);
    }

    public function edit_premium($user_id)
    {

        $user = Users::where('id', '=', $user_id)->first();

        if ($user->premium) {
            $user->premium = FALSE;
            $user->update();
        } else {
            $user->premium = TRUE;
            $user->update();
        }

        return redirect()->route('posts.overview', ['user_id' => $user_id]);
    }
}
