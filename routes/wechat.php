<?php

Route::any('/server', 'WeChatServerController@index');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/user', function () {
        $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
        dd($user);
    });
});
