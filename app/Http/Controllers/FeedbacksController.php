<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Images;
use App\Models\Users;
use App\Models\Feedbacks;

class FeedbacksController extends Controller
{
    public function store($user_id, $post_id) {
        
        request()->validate([
            'body' => 'required'
        ]);
        
        Feedbacks::create([
            'post_id' => $post_id,
            'user_id' => $user_id,
            'body' => request('body')
        ]);

        $post = Posts::where('id', '=', $post_id)->first();
        $user = Users::where('id', '=', $user_id)->first();
        $image = Images::where('id', '=', $post->image_id)->first();

        return view('posts/view', [
            'post' => $post,
            'feedbacks' => Feedbacks::all(),
            'user' => $user,
            'user_id' => $user_id,
            'users' => Users::all(),
            'image' => $image
        ]);
    }


    public function destroy($user_id, $post_id, $feedback_id) {

        $feedback = Feedbacks::where('id', '=', $feedback_id)->first();

        $feedback->delete();

        $post = Posts::where('id', '=', $post_id)->first();

        return redirect()->route('posts.view', [
            'post_id' => $post_id,
            'feedbacks' => Feedbacks::all(),
            'user_id' => $user_id 
        ]);

    }


}
