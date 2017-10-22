<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '找回密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="keywords" content="雍正网后台管理系统-<?= Html::encode($this->title) ?>">
    <meta name="description" content="雍正网后台管理系统-<?= Html::encode($this->title) ?>">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/css/layui.css" media="all">
    <link rel="stylesheet" href="/css/login.css" media="all">
</head>

<body class="site-home" id="LAY_home" style="background-color: #eee;">
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
<div class="site-box">
    <div class="psw-content" id="password-wrapper">
        <div class="ct-inner" id="recover-index">
            <div class="b-title">
                <h2><span class="icon icon-forgot-1"></span>忘记密码</h2>
                <p class="des-text">请输入您的登录账号，以进行密码重设</p>
            </div>
            <div class="psw-box">
                <?php $form = ActiveForm::begin([
                    'fieldConfig' => [
                        'template' => '{input}{error}',
                    ],
                ]); ?>
                <ul class="form-list">
                    <li>
                        <div class="form-input">
                            <div class="form-unit">
                                <label class="input-tips J-placeholder" style="display: none;">管理员账号</label>
                                <?= $form->field($model, 'admin_user')->textInput(['autofocus' => true,'class'=>'qc-log-input-text lg','data-id'=>'userInput','autocomplete'=>'off','placeholder'=>'管理员账号'])->label('用户名') ?>
                                <!-- <p class="form-input-help J-errorTip J-promptTip" style="text-align: left; color: rgb(225, 80, 74); font-size: 14px;">请输入邮箱</p> -->
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-input">
                            <div class="form-unit">
                                <label class="input-tips J-placeholder" style="display: none;">邮箱地址</label>
<!--                                <input type="text" class="qc-log-input-text lg" data-id="mailInput" autocomplete="off" placeholder="邮箱地址">-->
                                <?= $form->field($model, 'admin_email')->textInput(['class'=>'qc-log-input-text lg','data-id'=>'mailInput','autocomplete'=>'off','placeholder'=>'邮箱地址']) ?>
                                <!-- <p class="form-input-help J-errorTip J-promptTip" style="text-align: left; color: rgb(225, 80, 74); font-size: 14px;">请输入邮箱</p> -->
                            </div>
                        </div>
                    </li>
                 <!--   <li>
                        <div class="form-input fm-security">
                            <div class="form-unit">
                                <label class="input-tips J-placeholder" style="display: none;">验证码</label>
                                <input type="text" class="qc-log-input-text" data-id="vcodeInput" autocomplete="off" placeholder="验证码">
                                <a href="javascript:;" class="security-num" id="vcode-btn" title="点击换一张">
                                    <div class="security"><img class="security-img" src="https://cloud.tencent.com/captcha?t=1508481131029"></div>
                                </a>
                            </div>
                        </div>
                    </li>
                    -->
                </ul>

            </div>
            <div class="op-btn">
                <?= Html::submitButton('找回密码', ['class' => 'qc-log-btn layui-btn','id'=>'nexbtn','name' => 'login-button']) ?>
            </div>
            <div class="op-btn">
                <a href="<?=\yii\helpers\Url::to(['/manager/public/login'])?>">
                <button type="button" class="qc-log-btn layui-btn" id="nextbtn"><span>返回登录</span></button></a>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="ct-inner" id="recover-mail-sended" style="display:none">
            <div class="activate-info">
                <h2><span class="icon icon-mail"></span><span class="text">已发送密码重设邮件</span></h2>
                <p>已发送至您的注册邮箱：<span data-val="account"></span> 请查看邮件并根据提示进行操作。</p>
                <div class="op-btn">
                    <button type="button" class="qc-log-btn" id="open-mail-site" style="display:none">前往邮箱</button>
                </div>
            </div>
        </div>
        <div class="ct-inner" id="recover-successed" style="display:none">
            <div class="activate-info">
                <h2><span class="icon icon-success"></span><span class="text">密码修改成功</span></h2>
                <p>您现在可以用新密码登录您的雍正网后台了。</p>
                <div class="op-btn">
                    <a href="/login" id="recover-login-btn"><button type="button" class="qc-log-btn" href="/login">登录账号</button></a>
                    <p>
                        <a href="/" class="link">返回首页</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="layui-footer footer footer-index" style="margin-top:90px">
    <div class="layui-main">
        <p>&copy; 2017 <a href="/">yongzheng.com</a> All Rights Reserved 雍正网 版权所有</p>
        <p>
            <a href="" target="_blank">案例</a>
            <a href="mailto:admin@yongzheng.com">邮箱</a>
        </p>
    </div>
</div>
<script src="/layui.js"></script>
<script>
    var isSendEmailSuccess = '<?=Yii::$app->session->hasFlash('sendEmailSuccess')?>';
    if(!!isSendEmailSuccess){
        document.getElementById('recover-mail-sended').style.display = 'block';
        document.getElementById('recover-index').style.display = 'none';
    }
</script>
</body>

</html>