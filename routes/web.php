<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //文章編輯頁面控制器
    Route::get('/edit', \App\Http\Controllers\EditController::class)->name("edit"); 
    //留言控制器
    Route::resource('comment',\App\Http\Controllers\CommentController::class);
    //子留言控制器
    Route::resource('soncomment',\App\Http\Controllers\SonCommentController::class);
    //按讚控制器
    Route::resource('like',\App\Http\Controllers\LikeController::class);
    //追蹤控制器
    Route::resource('follow',\App\Http\Controllers\FollowController::class);
    //從追蹤中的文章的控制器
    Route::get("followblog",\App\Http\Controllers\FollowBlogController::class)->name("followblog");
});

//文章資源控制器
//登錄在controller中設定
Route::resource('blog',\App\Http\Controllers\Blogcontroller::class);

//個人頭像頁面
Route::resource('avatar', \App\Http\Controllers\AvatarController::class);

//個人詳情頁面
Route::get("newown/{id}/fromContent",[\App\Http\Controllers\NewOwnController::class,"fromContent"])->name("newown.fromContent");
Route::get("newown/{id}/fromComment",[\App\Http\Controllers\NewOwnController::class,"fromComment"])->name("newown.fromComment");
Route::get("newown/{id}/fromSonComment",[\App\Http\Controllers\NewOwnController::class,"fromSonComment"])->name("newown.fromSonComment");
Route::get("newown/{id}/fromFollow",[\App\Http\Controllers\NewOwnController::class,"fromFollow"])->name("newown.fromFollow");

//測試用路由
Route::get("test",\App\Http\Controllers\TestController::class);

