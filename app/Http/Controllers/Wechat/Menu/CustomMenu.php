<?php

namespace App\Http\Controllers\WeChat\Menu;

use EasyWeChat\Factory;

class CustomMenu
{
    public static function createMenu()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        $buttons = [
            [
                "type" => "click",
                "name" => "一级菜单",
                "key" => "V1001_TODAY_MUSIC"
            ],
            [
                "name" => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url" => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url" => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
            [
                "name" => "菜单1",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索1",
                        "url" => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频1",
                        "url" => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们1",
                        "key" => "V1001_GOOD"
                    ],
                    [
                        "type" => "click",
                        "name" => "第五个子菜单哈",
                        "key" => "V1001_GOOD"
                    ],
                    [
                        "type" => "click",
                        "name" => "第五个子菜单哈哈",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $app->menu->create($buttons);
    }
}