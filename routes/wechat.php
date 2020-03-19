<?php

Route::any('/server', 'WeChatServerController@index');

Route::post('/create_menu', 'Menu\CustomMenuController@createMenu');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {

    Route::any('/user', 'User\UserInfoController@getUserInfo');
});
