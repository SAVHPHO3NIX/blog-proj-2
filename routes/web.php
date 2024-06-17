<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PostsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Posts routes
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/like', [PostsController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [PostsController::class, 'unlike'])->name('posts.unlike');
    Route::get('/your-posts', [PostsController::class, 'yourPosts'])->name('posts.yourPosts');

    // Comments routes
    Route::post('/posts/{post}/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/like', [CommentsController::class, 'like'])->name('comments.like');
    Route::delete('/comments/{comment}/unlike', [CommentsController::class, 'unlike'])->name('comments.unlike');

    Route::get('/comments/{comment}/edit', [CommentsController::class, 'edit'])->name('comments.edit');
    Route::patch('/comments/{comment}', [CommentsController::class, 'update'])->name('comments.update');

    Route::get('/comments', [CommentsController::class, 'userComments'])->name('comments.index');

    // Follows routes
    Route::post('/users/{user}/toggle-follow', [FollowsController::class, 'toggle'])->name('toggle.follow');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Following and followers routes
    Route::get('/users/{user}/posts', [PostsController::class, 'userPosts'])->name('user.posts');
    Route::get('/users/{user}/following', [FollowsController::class, 'following'])->name('following');
    Route::get('/users/{user}/followers', [FollowsController::class, 'followers'])->name('followers');

    // User Profile routes
    Route::get('/user-profile', [UserProfileController::class, 'show'])->name('userprofile.show');
    Route::get('/user-profile/edit', [UserProfileController::class, 'edit'])->name('userprofile.edit');
    Route::post('/user-profile/update', [UserProfileController::class, 'update'])->name('userprofile.update');

    // Profiles routes
    Route::get('/profiles', [UserProfileController::class, 'index'])->name('profiles.index');
    Route::post('/profiles/{user}/follow', [UserProfileController::class, 'follow'])->name('follow');
    Route::delete('/profiles/{user}/unfollow', [UserProfileController::class, 'unfollow'])->name('unfollow');
});

require __DIR__.'/auth.php';

