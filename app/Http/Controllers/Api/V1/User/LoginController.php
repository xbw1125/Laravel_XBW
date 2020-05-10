<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|max:18'
        ]);

        if (!$token = auth('api')->attempt(request(['name', 'password']))) {
            return $this->failed('登录失败，账号或密码不正确！', 401);
        }
        return $this->success($this->respondWithToken($token));
    }

    public function me()
    {
        return $this->success(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();

        return $this->message('退出成功！');
    }

    public function refresh()
    {
        try {
            $token = auth('api')->refresh();
        } catch (\Exception $exception) {
            // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
            throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage());
        }
        return $this->success($this->respondWithToken($token));
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }
}