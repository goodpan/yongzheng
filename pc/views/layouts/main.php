<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use pc\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?=Html::cssFile('@web/css/common.css')?>
    <?=Html::cssFile('@web/css/style.css')?>
    <?=Html::cssFile('@web/css/grzx.css')?>

    <title><?= Html::encode('雍正网') ?></title>
  <script src="./js/jquery-1.11.1.min.js"></script>
<script src="./js/unslider.min.js"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
   
<!-- 最顶部的导航 -->
    <div class="yz-nav-top">
        <div class="yz-grid">
            <span class="left-top fl">
                <a href="/">首页</a>
                <a href="member/space/index">地区></a>
            </span>
            <span class="right-top fr">
                <a href="">登录</a>
                <a href="">注册</a>
                <a href="/member/space/index">个人中心</a>
                <a href="">退出</a>
            </span>
        </div>
    </div>

    <div class="container">
    
        <?= $content ?>
    </div>
</div>

<div class="footer">
    <div class="yz-footer-s ">
       <div class="yz-footer-link ">
            <ul>
                <li><a>关于我们</a></li>
                <li><a>联系方式</a></li>
                <li><a>雍正动态</a></li>
                <li><a>公司资质</a></li>
                <li><a>雍正招聘</a></li>
                <li><a>与雍正网合作</a></li>
                <li><a>用户体验提升计划</a></li>
                <li><a>热门服务</a></li>
                <li><a>友情链接</a></li>
                <li><a>安全中心</a></li>
                <li><a>雍正网移动版</a></li>
            </ul>
       </div>   
    </div>
    <div class="yz-footer-x">
         <div class="yz-footer-exlink">
                    <ul class="footer-list">
                        <li><a>友情链接</a></li>
                        <li><a>开办公司</a></li>
                        <li><a>国际商标注册</a></li>
                        <li><a>法律咨询</a></li>
                        <li><a>需求市场</a></li>
                        <li><a>A5创业网</a></li>
                        <li><a>拉勾网</a></li>
                        <li><a>证件代办</a></li>
                        <li><a>公司加盟</a></li>
                        <li><a>雍正头条</a></li>
                    </ul>
        </div>  
    </div>
    <p>Copyright 2005- 2017 zbj.com 版权所有 渝ICP备10202274-4号 渝B2-20080005 渝公网安备 50019002500154号 </p>
    <p>厦门市雍正网</p>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
