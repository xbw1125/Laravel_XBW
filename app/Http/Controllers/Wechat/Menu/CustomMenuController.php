<?php

namespace App\Http\Controllers\WeChat\Menu;

use EasyWeChat\Factory;

class CustomMenuController
{
    public static function createMenu()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        $buttons = [
            [
                "name" => "click类型",
                "sub_button" => [
                    [
                        "type" => "click",
                        "name" => "查看你的信息",
                        "key" => "getUserInfo"
                    ],
                ],
            ],
            [
                "name" => "view类型",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "查看你的信息",
                        "url" => env('APP_URL', 'https://xbw.loftyzone.cn') . "wechat/user"
                    ],
                    [
                        "type" => "view",
                        "name" => "爱奇艺视频",
                        "url" => "https://www.iqiyi.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "分享",
                        "url" => env('APP_URL', 'https://xbw.loftyzone.cn') . "/web/share"
                    ],
                ],
            ],
            [
                "name" => "其他类型",
                "sub_button" => [
                    [
                        "type" => "scancode_waitmsg",
                        "name" => "扫码带提示",
                        "key" => "scanCodeWithTipsTest",
                        "sub_button" => []
                    ],
                    [
                        "type" => "scancode_push",
                        "name" => "扫码推事件",
                        "key" => "scanCodeWithPushTest",
                        "sub_button" => []
                    ],
                    [
                        "type" => "pic_sysphoto",
                        "name" => "系统拍照发图",
                        "key" => "systemPhotoTest",
                        "sub_button" => []
                    ],
                    [
                        "type" => "pic_photo_or_album",
                        "name" => "拍照或者相册发图",
                        "key" => "systemPhotoOrAlbumTest",
                        "sub_button" => []
                    ],
                    [
                        "type" => "pic_weixin",
                        "name" => "微信相册发图",
                        "key" => "weChatAlbumTest",
                        "sub_button" => []
                    ],
                ],
            ],
        ];
        $app->menu->create($buttons);
        return $app->server->serve();
    }
}