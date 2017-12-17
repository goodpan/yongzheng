<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use wap\assets\AppAsset;
use common\widgets\Alert;

$curModel = Yii::$app->controller->module->id;
$curController = Yii::$app->controller->id;
$curAction =  Yii::$app->controller->action->id;
$rute = '/'.$curModel.'/'.$curController.'/'.$curAction;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->head() ?>
    <? if(isset($this->blocks['classify_title'])) {?>
        <?= $this->blocks['classify_title']?>
    <?}else{?>
        <title>雍正网</title>
    <?}?>
    <link rel="stylesheet" href="/css/lib/weui.css">
    <link rel="stylesheet" href="/css/lib/jquery_weui.css">
    <?php if(isset($this->blocks['cssblock']))
        echo $this->blocks['cssblock'];
    ?>
    <style>
        /*iconfont*/
        @font-face {
            font-family: 'iconfont';
            src: url('iconfont.eot');
            src: url('iconfont.eot?#iefix') format('embedded-opentype'), url('/font/iconfont.woff') format('woff'), url('/font/iconfont.ttf') format('truetype'), url('/font/iconfont.svg#iconfont') format('svg');
        }
        .icon {
            font-family: "iconfont" !important;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
	<script src="/js/hotcss.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
    <?= $content ?>
</div>
<?php if($curModel=='info'||$rute=='/member/space/index'){?>
<footer>
    <div class="bottom_fixed flex">
        <a href="/" <?=$rute=='/info/site/index'?'class="on"':''?>>
            <span class="icon">&#xe61d;</span>
            <p>首页</p>
        </a>
        <a href="/info/site/postyourwant" <?=$rute=='/info/site/postyourwant'?'class="on"':''?>>
            <span class="icon">&#xe609;</span>
            <p>发需求</p>
        </a>
        <a href="/info/site/classify" <?=$rute=='/info/site/classify'?'class="on"':''?>>
            <span class="icon">&#xe651;</span>
            <p>分类</p>
        </a>
        <a href="/member/space/index" <?=$rute=='/member/space/index'?'class="on"':''?>>
            <span class="icon">&#xe636;</span>
            <p>我的</p>
        </a>
    </div>
</footer>
<div class="backTop"></div>
<?}?>
<?php $this->endBody() ?>
    <script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-weui/1.1.1/js/jquery-weui.min.js"></script>
    <?php if(isset($this->blocks['jsblock']))
        echo $this->blocks['jsblock'];
    ?>
   <script>
        $('.backTop').on('click',function(){
            $('body,html').animate({scrollTop:0},200);
        })
    </script>
</body>
</html>
<?php $this->endPage() ?>
