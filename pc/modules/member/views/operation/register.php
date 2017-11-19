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
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
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
                <form action="" name="">
                    <div class="rlf-group">
                        <input type="text" id="sMobile" name="sMobile" class="ipt ipt-email" placeholder="请输入注册邮箱/手机号">
                        <p id="errorText" class="color-red rlf-tip-wrap" style="visibility: hidden">请输入正确的邮箱或手机号</p>
                    </div>
                    <div class="rlf-group">
                        <input id="verfy" type="text" name="verify" class="ipt ipt-email" placeholder="请输入短信验证码" maxlength="4" >
                        <span class="re-send">重新发送</span>
                        <p id="errverfy" class="color-red rlf-tip-wrap" style="visibility: hidden">请输入正确的短信验证码</p>
                    </div>
                    <div class="rlf-group " >
                        <a href="/image/member/bpwd.png" class="is-pwd"></a>
                        <input type="text" id="pwd" name="sPwd"  class="ipt ipt-email" placeholder="6-16位密码，区分大小写，不能用空格" maxlength="16">
                        <p id="errPwd" class="color-red rlf-tip-wrap" style="visibility: hidden">6-16位密码，区分大小写，不能用空格！</p>
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
<script>

    //验证手机号
    $('#sMobile').focusout(function (e) {
        var email = /^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
        var partten =  /^1[34578]\d{9}$/;
        if(!(email.test(e.target.value)||partten.test(e.target.value))){
            $('#errorText').attr('style','visibility:visible');
        }else{
            $('#errorText').attr('style','visibility:hidden');
        }
    });

    //验证验证码
    $('#verfy').focusout(function (e) {
       if(e.target.value == ''){
           $('#errverfy').attr('style','visibility:visible');
       }else {
           $('#errverfy').attr('style','visibility:hidden');
       }
    });

    //验证密码
    $('#pwd').focusout(function (e) {
        var pwd = e.target.value;

        if(pwd.length >= 6 &&  pwd.length <= 16){
            $('#errPwd').attr('style','visibility:hidden');
        }else {
            $('#errPwd').attr('style','visibility:visible');
        }
    });
    //去空格
    $('#pwd').keyup(function () {
        this.value=this.value.replace(" ", "");
    });


</script>
</body>
</html>
