<?php

namespace App\Http\Controllers\Api\V1\ThirdPartyLogin;

use App\Models\ThirdPartyUser;

class WeChat
{
    public function handel()
    {
        $user = session('wechat.oauth_user.default'); // 拿到微信授权用户资料
        $model = new ThirdPartyUser;
        $data = $model->where('platform', $user['provider'])
            ->where('openid', $user['id'])
            ->first();

        if (empty($data->uid)) {
            return redirect()->to('/bind_account', 301);
        }
    }
}