<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2017/10/22
 * Time: 15:45
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
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="head" class="sig-head">
    <a href="/" target="_self" class="sig-img">雍正网</a>
</div>
<div class="main">

    <div class="container">
        <div class="login-wrap">
            <div class="wel-hd">
                <h1 class="form-h1 fl">欢迎登录</h1>
                <span class="ipadHide">
                    <a href="/member/operation/register" class="on-register fr">立即注册</a>
                    <span class="no-account fr">没有账号？</span>
                 </span>
            </div>

            <div class="loginWrap"></div>

            <div class="signin">
                <form action="">
                    <div class="rlf-group">
                        <input type="text" id="sMobile" class="ipt ipt-email" placeholder="请输入登录邮箱/手机号">
                        <p id="errorText" class="color-red rlf-tip-wrap " style="visibility: hidden">请输入正确的邮箱或手机号</p>
                    </div>
                    <div class="rlf-group">
                        <input type="text" id="pwd" class="ipt ipt-email" placeholder="请输入6-16位密码，区分大小写，不能使用空格！">
                        <p id="errPwd" class="color-red rlf-tip-wrap">请输入6-16位密码，区分大小写，不能使用空格！</p>
                    </div>
                    <div class="rlf-group rlf-bottom">
                        <label for="auto-signin" class="rlf-autoin l" hidefocus="true">
                            <input type="checkbox" checked="checked" class="auto-cbx" id="auto-signin">7天内自动登录
                            <a href="/member/operation/forgetpwd" class="rlf-forget fr" target="_blank" hidefocus="true">忘记密码 </a>
                        </label>
                    </div>
                    <div class="rlf-group">
                        <input type="button" value="登录" hidefocus="true" class="btn-red btn-full xa-login">
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
<script>

    $('#sMobile').focusout(function (e) {
        var email = /^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
        var partten =  /^1[34578]\d{9}$/;
        console.log(partten.test(e.target.value));
        if(!(email.test(e.target.value)||partten.test(e.target.value))){
           $('#errorText').attr('style','visibility:visible');
        }else{
            $('#errorText').attr('style','visibility:hidden');
        }
    });
    $('#pwd').focusout()

</script>
</body>
</html>
