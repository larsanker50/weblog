<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Images;
use App\Models\Posts;
use App\Models\Feedbacks;
use App\Models\Catagories;

class UsersController extends Controller
{

    protected $current_user = '';

    public function login() {

        $users_DB = Users::all();

        return view('posts.login');
    }

    public function create() {
        $users_DB = Users::all();

        return view('posts\user_create');
    }

    public function store() {
        Users::create(request()->validate([
            'email' => 'required|unique:Users|email',
            'username' => 'required|unique:Users|min:2',
            'password' => 'required|min:2'
        ]));
        
        return redirect('/');
    }

    public function edit() {
        
    }

    public function update() {
        
    }

    public function destroy() {
        
    }

    public function validateUser() {

        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Users::where('username', '=', request('username'))->first();
        
        if ($user === null) {
            return view('posts/login');
        } else {
            return view('posts.overview', [
                'user_id' => $user->id,
                'users' => Users::all(),
                'posts' => Posts::all(),
                'images' => Images::all(),
                'user' => $user,
                'catagories' => Catagories::all(),
                'catagory_filter' => 'all',
                'username' => $user->username]);
        }
    }

    public function subscription($user_id) {

        $user = Users::where('id', '=', $user_id)->first();

        if ($user->subscribed) {
            $subscribed = TRUE;
        } else {
            $subscribed = FALSE;
        }
        
        return view('posts.subscription', [
            'user_id' => $user_id,
            'username' => $user->username,
            'subscription' => $subscribed
        ]);
    }

    public function subscribe($user_id) {
        
        $user = Users::where('id', '=', $user_id)->first();

        if ($user->subscribed) {
            $user->subscribed = FALSE;
            $user->update();
        } else {
            $user->subscribed = TRUE;
            $user->update();
        }

        return redirect()->route('posts.overview', ['user_id' => $user_id]);


    }

    

}



