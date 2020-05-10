<?php

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1'], function () {

    Route::any('/user', 'User\UserController@getUserInfo');

    Route::post('/login', 'User\LoginController@login');
    Route::post('/refresh', 'User\LoginController@refresh');
    Route::post('/register', 'User\RegisterController@register');

    Route::middleware('jwt_refresh')->group(function () {

        Route::any('/me', 'User\LoginController@me');
        Route::any('/logout', 'User\LoginController@logout');

        Route::post('/home/article', 'Home\HomeController@getArticleLists');

        /**
         * 通知
         */
        Route::any('/notification/send', 'Notification\NotificationController@sendNotification');
        Route::any('/notification/readNotification', 'Notification\NotificationController@readNotification');
        Route::any('/notification/getReadNotificationLists', 'Notification\NotificationController@getReadNotificationLists');
        Route::any('/notification/getUnReadNotificationLists', 'Notification\NotificationController@getUnReadNotificationLists');
        Route::any('/notification/getUnReadNotificationCount', 'Notification\NotificationController@getUnReadNotificationCount');
    });

});
