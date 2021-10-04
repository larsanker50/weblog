<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\CatagoriesController;

//index
route::redirect('/', '/posts');

//posts
route::get('/posts', [ PostsController::class,
'index'])->name('posts.index');

route::get('/posts/{user_id}/view/{post_id}', [ PostsController::class,
'view'])->name('posts.view');

route::get('/posts/{user_id}/overview', [ PostsController::class,
'overview'])->name('posts.overview');

route::get('/posts/{user_id}/create', [ PostsController::class,
'create'])->name('posts.create');

route::post('/posts/{user_id}/create', [ PostsController::class,
'store'])->name('posts.store');

route::get('/posts/{user_id}/personal_overview', [ PostsController::class,
'personal_overview'])->name('posts.personal_overview');

route::get('/posts/{user_id}/edit/{post_id}', [ Postscontroller::class,
'edit'])->name('posts.edit');

route::post('/posts/{user_id}/update/{post_id}', [ Postscontroller::class,
'update'])->name('posts.update');

route::delete('/posts/{user_id}/delete/{post_id}', [ Postscontroller::class,
'destroy'])->name('posts.destroy');

route::get('/posts/{user_id}/premium', [ PostsController::class,
'premium'])->name('posts.premium');

route::post('/posts/{user_id}/premium', [ PostsController::class,
'edit_premium'])->name('posts.edit_premium');

//users
route::post('/posts/overview', [ UsersController::class,
'validateUser'])->name('users.validateUser');

route::get('/users/login', [ UsersController::class,
'login'])->name('users.login');

route::get('/users/create', [ UsersController::class,
'create'])->name('users.create');

route::post('/users/create', [ UsersController::class,
'store'])->name('users.store');

route::get('/users/{user_id}/subscription', [ UsersController::class,
'subscription'])->name('users.subscription');

route::post('/users/{user_id}/subscribe', [ UsersController::class,
'subscribe'])->name('users.subscribe');

//feedbacks
route::post('/posts/{user_id}/view/{post_id}', [ FeedbacksController::class,
'store'])->name('feedbacks.store');

route::delete('/posts/{user_id}/view/{post_id}/{feedback_id}', [ FeedbacksController::class,
'destroy'])->name('feedbacks.destroy');

//catagories
route::post('/catagories/{user_id}/overview', [ CatagoriesController::class,
'overview'])->name('/catagories/overview');



//catagorie overvieuw page

//create catagories
//post catagories
//edit catagories
//save catagories


//create post
//post post
//edit post
//save edit post

//post subscibe email

//edit user info