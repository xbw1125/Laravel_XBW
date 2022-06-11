<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1'], function () {

    Route::any('/canal', 'Canal\CanalController@index');


    Route::any('/rabbit_mq', 'RabbitMQController@index');
    Route::any('/rabbit_mq/consume', 'RabbitMQController@consume');

    /*
     * ElasticSearch
     */
    Route::any('/elasticsearch/create_index', 'ElasticSearch\ElasticSearchController@createIndex');
    Route::any('/elasticsearch/insert_doc', 'ElasticSearch\ElasticSearchController@insertDoc');
    Route::any('/elasticsearch/get_doc', 'ElasticSearch\ElasticSearchController@getDoc');
    Route::any('/elasticsearch/update_doc', 'ElasticSearch\ElasticSearchController@updateDoc');
    Route::any('/elasticsearch/search_doc', 'ElasticSearch\ElasticSearchController@searchDoc');
    Route::any('/elasticsearch/delete_doc', 'ElasticSearch\ElasticSearchController@deleteDoc');
    Route::any('/elasticsearch/delete_index', 'ElasticSearch\ElasticSearchController@deleteIndex');

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
