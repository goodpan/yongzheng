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
        <div class="ct-inner" id="recover-pass">
            <div class="b-title">
                <h2><span class="icon icon-forgot-2"></span>设置新密码</h2>
                <p class="des-text">请设置您的新密码</p>
            </div>
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => '{input}{error}',
                ],
            ]); ?>
            <div class="psw-box">

                <ul class="form-list">
                  <!--  <li id="smsCodeField">
                        <div class="form-input fm-verify">
                            <div class="form-unit">
                                <label class="input-tips J-placeholder" style="display: none;">手机验证码</label>
                                <input type="text" class="qc-log-input-text" autocomplete="off" placeholder="手机验证码" data-id="smsCodeInput">
                                <button type="button" class="qc-log-btn disabled xl" id="sendSmsCode">35 秒</button>
                            </div>
                        </div>
                    </li>-->
                    <li>
                        <?php echo $form->field($model, 'admin_user')->hiddenInput(); ?>
                        <div class="form-input">
                            <div class="form-unit">
                                <label class="input-tips J-placeholder" style="display: none;">新密码</label>
                                <?= $form->field($model, 'admin_pass')->passwordInput(['class'=>'qc-log-input-text lg J-password','placeholder'=>'新密码','data-id'=>'pwdInput', 'autocomplete'=>'new-password']) ?>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-input">
                            <div class="form-unit">
                                <label class="input-tips J-placeholder" style="display: none;">确认新密码</label>
                                <?= $form->field($model, 'repass')->passwordInput(['class'=>'qc-log-input-text lg','placeholder'=>'确认新密码','data-id'=>'pwdConfirmInput', 'autocomplete'=>'new-password']) ?>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
            <div class="op-btn">
                <?= Html::submitButton('提交', ['class' => 'qc-log-btn layui-btn','id'=>'nexbtn','name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="ct-inner" id="recover-successed" style="display:none">
            <div class="activate-info">
                <h2><span class="icon icon-success"></span><span class="text">密码修改成功</span></h2>
                <p>您现在可以用新密码登录您的雍正网后台了。</p>
                <div class="op-btn">
                    <a href="/manager/public/login" id="recover-login-btn"><button type="button" class="qc-log-btn">登录账号</button></a>
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
    var isChangePassSuccess = '<?=Yii::$app->session->hasFlash('changePassSuccess')?>';
    if(!!isChangePassSuccess){
        document.getElementById('recover-successed').style.display = 'block';
        document.getElementById('recover-pass').style.display = 'none';
    }
</script>
</body>

</html>