<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2017/10/26
 * Time: 0:28
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
<div id="head" class="sig-head">
    <a href="/" target="_self" class="sig-img">雍正网</a>
</div>
<div class="main">

    <div class="container">
        <div class="login-wrap">
            <div class="wel-hd">
                <h1 class="form-h1 fl">欢迎注册</h1>
                <span class="ipadHide">
                    <a href="/member/operation/login" class="on-register fr">直接登录</a>
                    <span class="no-account fr">已有账号？</span>
                 </span>
            </div>

            <div class="loginWrap"></div>

            <div class="signin">
                <form action="">
                    <div class="rlf-group">
                        <input type="text" class="ipt ipt-email" placeholder="请输入注册邮箱/手机号">
                        <p class="color-red rlf-tip-wrap">请输入正确的邮箱或手机号</p>
                    </div>
                    <div class="rlf-group " >
                        <input type="text"  class="ipt ipt-email" placeholder="请输入短信验证码" maxlength="4">
                        <span class="re-send">重新发送</span>
                        <p class="color-red rlf-tip-wrap">请输入正确的短信验证码</p>
                    </div>
                    <div class="rlf-group " >
                        <a href="/image/member/bpwd.png" class="is-pwd"></a>
                        <input type="text"  class="ipt ipt-email" placeholder="6-16位密码，区分大小写，不能用空格" maxlength="16">
                        <p class="color-red rlf-tip-wrap">6-16位密码，区分大小写，不能用空格！</p>
                    </div>
                    <div class="rlf-group">
                        <input type="button" value="注册" hidefocus="true" class="btn-red btn-full xa-login">
                    </div>
                </form>
                <div class="rl-model-footer">
                    <div class="clearfix login-sns-wrap">
                        <span class="fl " style="color:#666">其他方式登录</span>
                        <a href="#" class="pop-sns-weibo fr mr60"><i class="icon-weibo"></i></a>
                        <a href="#"  class="pop-sns-weixin fr mr60"><i class="icon-weixin"></i></a>
                        <a href="#"  class="pop-sns-qq fr mr60"><i class="icon-qq"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="footer">

</div>

</body>
</html>
