<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2017/11/2
 * Time: 21:11
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
    <a href="" target="_self" class="sig-img">雍正网</a>
</div>
<div class="main">

    <div class="container">
        <div class="login-wrap">
            <div class="fgtpaw-wrap">
                <span class="form-h1"><b>忘记密码</b></span>
            </div>
            <div class="link-info">
                <span>通过注册邮箱或手机号重设密码</span>
                <a class="right-back" href="/member/operation/login"> 返回立即登录</a>
            </div>
            <div class="signin">
                <form action="">
                    <div class="rlf-group">
                        <input type="text" class="ipt ipt-email" placeholder="请输入登录手机号/邮箱">
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
                        <input type="button" value="提交" hidefocus="true" class="btn-red btn-full xa-login">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="footer">

</div>

</body>
</html>
