<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function getArticleLists()
    {
        $user = auth('api')->user()->toArray();
        var_dump($user);
    }
}