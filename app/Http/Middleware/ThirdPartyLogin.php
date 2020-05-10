<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\ThirdPartyLogin\WeChat;

class ThirdPartyLogin extends Controller
{

    public function handle($request, Closure $next)
    {
        $thirdPartyLoginType = $request->get('third_party_login_type');
        if (class_exists($thirdPartyLoginType)) {
            $object = new $thirdPartyLoginType();
            $object->handle();
        } else {
            return $this->failed('login_type error', 404);
        }
        return $next($request);
    }
}