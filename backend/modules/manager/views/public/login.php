<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>雍正网后台管理系统-登录</title>
    <meta name="keywords" content="雍正网后台管理系统-登录">
    <meta name="description" content="雍正网后台管理系统-登录">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/css/layui.css" media="all">
    <link rel="stylesheet" href="/css/login.css" media="all">
</head>
<body class="site-home" id="LAY_home" style="background-image: linear-gradient(180deg,#0e81a5 0%,#1a1454  100%);">
<div class="layui-header header header-index">
    <div class="layui-main">
        <a class="logo" href="/">
            <span style="color:#fff;font-size:24px">雍正网</span>
            <!-- <img src="//res.layui.com/images/layui/logo.png" alt="layui"> -->
        </a>
        <ul class="layui-nav" pc>
            <li class="layui-nav-item" pc>首页</li>
        </ul>
    </div>
</div>
<div class="site-banner" >
    <div class="site-banner-bg">
    <div class="baner-wrap">
            <div banner-container class="banner-container" >
                <div data-group class="center animating-enter-up">
                    <div data-base-layer>
                        <div class="banner-row" data-parallel="">
                            <div class="layer right-image hover-image  no-transition" data-zindex="50" style="transform: translateZ(50px);">
                                <img src="https://img.alicdn.com/tfs/TB1X6tlrgMPMeJjy1XbXXcwxVXa-1600-880.png" alt="">
                            </div>
                            <div class="layer right-image hover-image  no-transition" data-zindex="100" style="transform: translateZ(100px);">
                                <img src="https://img.alicdn.com/tfs/TB1FiVBmvBNTKJjy0FdXXcPpVXa-1600-880.png" alt="">
                            </div>
                            <div class="layer right-image hover-image  no-transition" data-zindex="150" style="transform: translateZ(150px);">
                                <img src="https://img.alicdn.com/tfs/TB1rpm4mWagSKJjy0FaXXb0dpXa-1600-880.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-banner-main">
        <div class="login-inner">
            <div class="site-zfj">
                <div class="site-info">
                </div>
            </div>
            <div class="lg-content">
                <div class="qc-pt-login-content" id="loginBox">
                    <div class="qc-pt-login-content J-commonLoginContent ">
                        <!--login start-->
                        <div class="login-tab">
                            <?php $form = ActiveForm::begin([
                                'fieldConfig' => [
                                    'template' => '{input}{error}',
                                ],
                            ]); ?>
                            <h1 class="login-tab-title J-txtLoginTitle">管理中心</h1>
                            <!--邮箱手机登录　start-->
                            <div class="login-box J-loginContentBox J-qcloginBox" style="">
                                <div class="login-form">
                                    <div class="tc-msg error" style="display:none"> <span class="msg-icon"></span>
                                        <div class="tip-info J-loginTip"></div>
                                    </div>
                                    <ul class="form-list">
                                        <li>
                                            <div class="form-input">
                                                <div class="form-unit tip-unit"> <label class="input-tips" style="display: none;">管理员账号</label>
                                                    <?= $form->field($model, 'admin_user')->textInput(['autofocus' => true,'class'=>'qc-log-input-text lg J-username','placeholder'=>'管理员账号'])->label('管理员账号') ?>
                                                    <ul class="tip-list J-mailSuggest" style="display:none;"> </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-input">
                                                <div class="form-unit"> <label class="input-tips" style="display: none;">密码</label>
                                                    <?= $form->field($model, 'admin_pass')->passwordInput(['class'=>'qc-log-input-text lg J-password','placeholder'=>'密码']) ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li style="display:none" class="J-vcodeArea">
                                            <div class="form-input fm-security">
                                                <div class="form-unit"> <label class="input-tips" style="display: none;">验证码</label> <input type="text" class="qc-log-input-text J-vcodeInput" placeholder="验证码" style="width:124px">
                                                    <a href="javascript:;" class="security-num J-changeVCode">
                                                        <img class="security-img J-vcodeImg"> </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="op-btn">
                                    <?= Html::submitButton('登录', ['class' => 'qc-log-btn layui-btn', 'name' => 'login-button']) ?>
                                    <?php echo $form->field($model, 'rememberMe')->checkbox([
                                        'id' => 'remember-me',
                                        'template' => '<div class="remember">{input}<label for="remember-me">记住我</label></div>',
                                    ]); ?>
                                    <div class="psw-info">
                                        <a href="<?=\yii\helpers\Url::to(['/manager/public/seekpassword'])?>" class="forgot-psw J-link" hotrep="login.pc.forgotPwd">忘记密码？</a>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="layui-footer footer footer-index">
    <div class="layui-main">
        <p>&copy; 2017 <a href="/">yongzheng.com</a> All Rights Reserved 雍正网 版权所有</p>
        <p>
            <a href="" target="_blank">案例</a>
            <a href="mailto:admin@yongzheng.com">邮箱</a>
        </p>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script>
    $(function(){
        var banner = $(".banner-row");
        var inWidth = $(window).innerWidth();
        var inHeight = $(window).innerHeight();
        banner.on("mousemove", function(e) {
            var ax = -( inWidth/ 2 - e.pageX) / 80;
            var ay = -( inHeight/ 2 - e.pageY) / 80;
            $(this).attr("style", "transform: rotateY(" + ax + "deg) rotateX(" + ay + "deg);-webkit-transform: rotateY(" + ax + "deg) rotateX(" + ay + "deg);-moz-transform: rotateY(" + ax + "deg) rotateX(" + ay + "deg)");
        });
    })
    
</script>
</body>
</html>