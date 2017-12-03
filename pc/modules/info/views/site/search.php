<?php
/**
 * 搜索页面
 * Created by PhpStorm.
 * User: chenwenzhen
 * Date: 2017/10/19
 * Time: 11:55
 */
?>
<link rel="stylesheet" type="text/css" href="/css/search.css">
<div class="container-main">
    <div class="container-main-top">
        <a href="<?echo Yii::$app->getHomeUrl();?>">
            <img class="container-logo" src="/image/logo.jpg">
        </a>
        <div class="container-main-search">
            <form method="post" action="#">
                <div class="search-box">
                    <input class="search-input" name="search-key" type="text" placeholder="要办理什么证件，搜索什么证件">
                </div>
            </form>
            <button class="search-button">
                搜索
            </button>
        </div>
    </div>
    <div class="container-main-foot">
        <div class="container-content">
            <div class="container-content-nav">
                <div class="nav-content">雍正为您找到相关结果约<?echo $countItem;?>个</div>
            </div>
            <ul class="list-box">
                <? foreach ($credentialsList as $item) { ?>
                    <li>
                        <a href="#">
                            <div class="item-inner">
                                <img class="item-img" src="<?echo $item->cover;?>">
                                <div class="item-content">
                                    <div class="item-title">
                                        <?echo $item->cred_name?>
                                    </div>
                                    <div class="item-nav">
                                        <?echo $item->descr?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                <? } ?>
            </ul>
            <div class="content-foot">
                <div class="page">
                    <span>上一页</span>
                    <span>1</span>
                    <span>2</span>
                    <span>3</span>
                    <span>4</span>
                    <span>5</span>
                    <span>下一页</span>
                </div>
            </div>
        </div>
        <div class="container-adv">
            <img class="item-adv" src="/image/adv.jpg">
            <img class="item-adv" src="/image/adv.jpg">
        </div>
    </div>
</div>
<script type="text/javascript" src="<?echo Yii::$app->getHomeUrl()?>js/pagnation/jqPaginator.js"></script>
