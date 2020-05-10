<?php

Route::any('/server', 'WeChatServerController@index');

Route::post('/create_menu', 'Menu\CustomMenuController@createMenu');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {

    Route::any('/wechat_user', 'User\UserInfoController@getUserInfo');

    Route::post('/getConfig', 'Share\ShareController@jsConfigInit');

    //第三方登录检查是否绑定账号
    Route::middleware('third_party_login')->group(function () {

        Route::redirect('/user', '/api/v1/user', 301);
    });
});
