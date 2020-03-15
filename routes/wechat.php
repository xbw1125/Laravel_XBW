<?php

Route::any('/server', 'WeChatServerController@index');

Route::group(['middleware' => ['web', 'wechat_oauth']], function () {

    Route::any('/user', 'User\UserInfoController@getUserInfo');
});
