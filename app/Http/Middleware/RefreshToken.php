<?php

namespace App\Http\Middleware;

use Closure;
use App\Api\Helpers\Api\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        // 检查此次请求中是否带有 token，如果没有则抛出异常。
        $this->checkForToken($request);
        try {
            // 检测用户的登录状态，如果正常则通过
            if (!$this->auth->parseToken()->authenticate()) {
                throw new TokenExpiredException('jwt-auth', '身份已过期，请重新登录');
            }
        } catch (TokenExpiredException $e) {
            try {
                $token = $this->auth->refresh();
                // 使用一次性登录以保证此次请求的成功
                Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
            } catch (\Exception $exception) {
                return $this->failed('身份已过期，请重新登录');
            }
            // 在响应头中返回新的 token
            return $this->setAuthenticationHeader($next($request), $token);
        } catch (TokenInvalidException $e) {
            return $this->failed('令牌无效');
        } catch (JWTException $e) {
            return $this->failed('令牌不存在');
        } catch (\Exception $e) {
            return $this->failed('未登录');
        }
        return $next($request);
    }
}