<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
</head>
<body>
<button id="friend">点击分享朋友/好友</button>
<button id="friend_circle">点击分享朋友圈/QQ空间</button>
<button id="get_network_type">获取网络信息</button>
<button id="get_location">获取地理位置信息</button>
</body>
<script>

    $(function () {
        new Promise(function (resolve, reject) {
            $.post('/wechat/getConfig', {}, function (res) {
                res ? resolve(res) : reject('获取配置失败');
            }, 'json');
        }).then(function (res) {
            wx.config(res);
            wx.ready(function () {
                $('#friend').click(function () {
                    wx.updateAppMessageShareData({
                        title: '分享给朋友/QQ', // 分享标题
                        desc: 'test123', // 分享描述
                        link: '{{ env("APP_URL", "https://xbw.loftyzone.cn") }}/wechat/user',
                        imgUrl: '/images/wechat/share/index.jpg', // 分享图标
                        success: function () {
                            alert('分享成功');
                        }
                    });
                });
                $('#friend_circle').click(function () {
                    wx.updateTimelineShareData({
                        title: '分享到朋友圈/QQ空间', // 分享标题
                        link: '{{ env("APP_URL", "https://xbw.loftyzone.cn") }}/wechat/user',
                        imgUrl: '/images/wechat/share/index.jpg', // 分享图标
                        success: function () {
                            alert('分享成功');
                        }
                    });
                });
                $('#get_network_type').click(function () {
                    wx.getNetworkType({
                        success: function (res) {
                            var networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
                            alert(networkType);
                        }
                    });
                });
                $('#get_location').click(function () {
                    wx.getLocation({
                        type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                        success: function (res) {
                            var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                            var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                            var speed = res.speed; // 速度，以米/每秒计
                            var accuracy = res.accuracy; // 位置精度
                            alert('纬度:' + latitude + '-' + '经度:' + longitude + '-' + '速度:' + speed + '-' + '位置精度:' + accuracy)
                        }
                    });
                });
            });
            wx.error(function (res) {
                alert(res);
            });
        }).catch(function (res) {
            alert(res);
        });
    });
</script>
</html>