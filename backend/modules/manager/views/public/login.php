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
<body class="site-home">
<div class="index-main" id="index-main">
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
<div class="site-banner-bg" id="particles-js">   </div>
<div class="site-banner">
    <div class="site-banner-main">
        <div class="login-inner">
            <div class="site-zfj">
                <div class="site-info">
                    后台管理系统
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
                                        'template' => '<div class="remember">{input}<label for="remember-me" style="color:#333">记住我</label></div>',
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
</div>
<script src="/js/particles.min.js"></script>
<script>
particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 100,
      "density": {
        "enable": true,
        "value_area": 1800
      }
    },
    "color": {
      "value": "#e3e3e3"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.1,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 15,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 200,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 3,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});


</script>
</body>
</html>