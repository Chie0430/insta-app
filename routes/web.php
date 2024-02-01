<?php

// Regular users controller
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;

// Admin users controller
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

# Note: We need to protect our routes. Meaning, user can only access the routes if they are registered and login.
# To protect the route, we need to add the 'middleware' auth class.
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', [HomeController::class, 'index'])->name('index'); // homepage
    Route::get('/people', [HomeController::class, 'search'])->name('search'); // homepage

    # This route is going to open the create.blade.php post page
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create'); // post page

    # This route is use to store post details into the post table
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

    # This route is use to open the show.blade.php (Show post page)
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');

    # This route is use to open the edit.blade.php
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit'); // edit page

    # This route is going to implement the acutal update of the datas
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('post.update');

    # Delete post and open the home.blade.php
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

    ### Comment ###
    # This route is use to store comment details into the commments table
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');

    # Delete comment and open the back page
    Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

    ### Profile ###
    # This route is use to open the show.blade.php (with the user profile id)
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');

    ### Likes ###
    Route::post('/like/{post_id}/store', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{post_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

    ### Follow/Unfollow ###
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');

    ### Admin Routes ###
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'],function(){
        # Admin Users Dashboard
        Route::get('/users', [UsersController::class, 'index'])->name('users'); // admin.users
        # Deactivate User
        Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate'); // admin.users.deactivate
        # Activate User
        Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate'); // admin.users.activate


        # Admin Posts Dashboard
        Route::get('/posts', [PostsController::class, 'index'])->name('posts'); // admin.posts
        # Hide Post
        Route::delete('/posts/{id}/hide', [PostsController::class, 'hide'])->name('posts.hide'); // admin.posts.hide
        # Unhide Post
        Route::patch('/posts/{id}/unhide', [PostsController::class, 'unhide'])->name('posts.unhide'); // admin.posts.unhide

        # Admin Categories Dashboard
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories'); // admin.categories
        # Add Category
        Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store'); // admin.categories.store
        # Edit Category
        Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('categories.update'); // admin.categories.update
        # Delete Category
        Route::delete('/categories/{id}/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy'); // admin.categories.destroy
    });
});