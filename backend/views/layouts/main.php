<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">雍正网后台管理系统</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">

            <li class="layui-nav-item <?=$this->context->module->id == 'console'?'layui-this':''?>"><a href="/console/overview/index">控制台</a></li>
            <li class="layui-nav-item <?=$this->context->module->id == 'system'||$this->context->module->id == 'manager'?'layui-this':''?>"><a href="/system/site/index">系统</a></li>
            <li class="layui-nav-item <?=$this->context->module->id == 'info'?'layui-this':''?>"><a href="/info/operation/list">证件库</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    admin
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="<?=Url::to('/manager/operation/baseinfo')?>">基本资料</a></dd>
                    <dd><a href="<?=Url::to('/manager/operation/changepass')?>">修改密码</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="<?=Url::to(['/manager/public/logout'])?>">退出</a></li>

        </ul>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <?php if(isset($this->blocks['sitebar']))
                echo $this->blocks['sitebar'];
            ?>
        </div>
    </div>
    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="width:100%;height:100%;padding: 15px;"><?=$content?></div>
    </div>

 </div>

<div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
</div>

<?php $this->endBody() ?>
<?php if(isset($this->blocks['jsblock']))
    echo $this->blocks['jsblock'];
?>

<script>

layui.use(['element'], function() {

})

</script>
</body>

</html>

<?php $this->endPage() ?>
