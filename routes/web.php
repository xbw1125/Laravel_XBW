<?php

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

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('articles', 'ArticleController');
    Route::resource('comments', 'CommentsController');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::any('/admin_index', 'AdminController@index')->name('admin_index');
Route::get('article/{id}', 'ArticleController@show');
Route::post('comment', 'CommentController@store');

Route::prefix('web')->group(function () {

    Route::view('/share', 'wechat.WxShare', ['title' => '微信分享']);
    Route::view('/bind_account', 'bind.bind_account', ['title' => '绑定账号']);
});