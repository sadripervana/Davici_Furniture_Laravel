<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\GuestBlogController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BlogCommentsController;
use App\Http\Controllers\PostCommentsController;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::post('/posts/{id}/rate', [PostController::class, 'rate'])->name('posts.rate');

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/posts/{id}/likes', [PostController::class, 'likes'])->name('likes.web');

Route::get('blog/{blog:slug}', [BlogController::class, 'show']);
Route::get('blog', [BlogController::class, 'index'])->name('blog');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);
Route::post('blog/{blog:slug}/comments', [BlogCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('/guest/blog/create', [GuestBlogController::class, 'create'])->name('guest.blog.create');
Route::post('/guest/blog', [GuestBlogController::class, 'store'])->name('guest.blog.store')->middleware('auth');

Route::get('/likes', [LikesController::class, 'index'])->name('likes')->middleware('auth');
Route::delete('/likes/{like}', [LikesController::class, 'destroy'])->name('likes.destroy')->middleware('auth');

Route::get('/cart', [AddToCartController::class, 'index'])->name('cart')->middleware('auth');
Route::delete('/carts/{cart}', [AddToCartController::class, 'destroy'])->name('carts.destroy')->middleware('auth');
Route::post('/addcart', [AddToCartController::class, 'store'])->name('add.to.cart')->middleware('auth');

// routes/web.php
Route::get('/get-random', [VariableController::class, 'getRandom'])->name('get.random');

// Admin Section
Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
    Route::resource('admin/blog', AdminBlogController::class)->except('show');
});
