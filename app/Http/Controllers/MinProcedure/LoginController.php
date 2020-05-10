<?php

namespace App\Http\Controllers\MinProcedure;

use EasyWeChat\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        $app = Factory::miniProgram(config('wechat.official_account.default'));

        if (empty($request->get('code'))) {
            return $this->message('code is null', 400);
        }
        $session = $app->auth->session($request->get('code'));
        Log::info('记录小程序登录session：' . $session);
        return $this->success($session);
    }
}
