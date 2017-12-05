<?php
/**
 * Created by PhpStorm.
 * User: oyyz <oyyz@3elephant.com>
 * Date: 2017/11/10 0010
 * Time: 上午 11:57
 */
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="/css/lib/weui.css">
    <link rel="stylesheet" href="/css/lib/jquery_weui.css">
    <link rel="stylesheet" href="/css/common.css">
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
    <header class="header">
        <i class="back" onclick="window.history.go(-1);"><img src="" alt=""></i>
        <span class="text"><?= Html::encode($this->title) ?></span>
        <div class="nav-more">
            <span class="h_more icon" id="nav-more">&#xe602;</span>
            <ul class="nav-drop" id="nav-drop">
                <li class="drop-item">
                    <a href="">首页</a>
                </li>
                <li class="drop-item">
                    <a href="/type/index">分类</a>
                </li>
                <li class="drop-item">
                    <a href="/member/space/index">我的</a>
                </li>
            </ul>
        </div>
        <?php if(isset($this->blocks['navblock']))
            echo $this->blocks['navblock'];
        ?>
    </header>
    <?=$content?>
    <?php $this->endBody() ?>
    <script src="/js/fastclick.js"></script>
    <!-- <script src="/js/zepto.min.js"></script> -->
    <script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-weui/1.1.1/js/jquery-weui.min.js"></script>
    <?php if(isset($this->blocks['jsblock']))
        echo $this->blocks['jsblock'];
    ?>
    <script>
        $(function(){
            $('#nav-more').on('click',function(){
                if($("#nav-drop").is(":hidden")){
                     $("#nav-drop").show();    //如果元素为隐藏,则将它显现
                }else{
                    $("#nav-drop").hide();     //如果元素为显现,则将其隐藏
                }
            })
            $('.backTop').on('click',function(){
                $('body,html').animate({scrollTop:0},1000);
            })
        })
    </script>
</body>
</html>
<?php $this->endPage() ?>
