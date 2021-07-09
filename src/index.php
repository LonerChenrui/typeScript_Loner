<!DOCTYPE html>
<html>
<head>
    <title>登录成功！</title>
    <style type="text/css">
        *{margin:0px;padding: 0px;}
        #headimg{
            width: 180px;
            height: 180px;
            margin:100px auto 10px;
            border-radius: 100%;
        }

        #headimg img{
            width: 180px;
            height: 180px;
            border-radius: 100%;
        }

        h2{
            text-align: center;
        }

        p{
            text-align: center;
            font-size: 38px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

</body>
</html>

<?php
$code = $_GET["code"];
$appid = "填写你的";
$secret = "填写你的";

//获取access_token和openid
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
function post($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $rst = curl_exec($ch);
        curl_close($ch);
        return $rst;
}

//发送请求
$result = post($url);
//返回接口的数据
$arr = json_decode($result,true);
$openid = $arr['openid'];
$token = $arr['access_token'];

//获取用户信息
$getinfourl = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid";
function getinfo($getinfourl) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $getinfourl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $rst = curl_exec($ch);
        curl_close($ch);
        return $rst;
}

//发送请求获取用户信息
$info_result = getinfo($getinfourl);
//返回接口的数据
// echo $info_result;
$info_arr = json_decode($info_result,true);
$nickname = $info_arr['nickname'];
$headimgurl = $info_arr['headimgurl'];
$errcode = $info_arr['errcode'];

if ($errcode == "41001") {
    echo "<p>登录失效，请重新扫码登录<p>";
    echo "<p><a href=\"code.php\">登录</a><p>";
}else{
    echo "<div id=\"headimg\"><img src=\"$headimgurl\"/></div>";
    echo "<h2>$nickname<h2>";
    echo "<p>登录成功<p>";
}
?>