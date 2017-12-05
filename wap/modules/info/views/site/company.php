<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Time: 2017年11月17日15:04:38
 */
/* @var \myerm\yizhanshi\common\models\Shop $detail */
$this->title = '企业详情';
?>
<?php $this->beginBlock('cssblock')?>
<link rel="stylesheet" type="text/css" href="/css/home/detail_info.css">
<?php $this->endBlock('cssblock')?>
<div class="banner comp-banner">
    <div class="comp-header">
        <div class="inner-wrap">
            <div class="avatar">
                <img src="" alt="">
            </div>
            <div class="info">
                <p class="title">厦门xxx发展有限公司</p>
                <div class="local"><i class="icon">&#xe754;</i><span class="addr">福建 厦门</span></div>
            </div>
        </div>
    </div>
</div>
<div class="tab-container">
    <ul class="tab-wrap">
        <li class="tab-item current">
            <i class="tab-icon icon">&#xe791;</i> <span class="text">首页</span>
        </li>
        <li class="tab-item">
            <i class="tab-icon icon">&#xe60f;</i> <span class="text">全部服务</span>
        </li>
        <li class="tab-item">
            <i class="tab-icon icon">&#xe60b;</i> <span class="text">作品展示</span>
        </li>
    </ul>
    <div class="tab-body">
        <div class="tab-con current-tab">

            <div class="layer">
                <h3 class="tab-tt">擅长领域</h3>
                <div class="layer-chunk">
                        <a href="" class="chunk-item">
                        擅长领域
                        </a>
                </div>
            </div>
            <div class="layer">
                <h3 class="tab-tt">擅长技能</h3>
                <div class="layer-chunk">
                        <a href="" class="chunk-item">
                        擅长技能
                        </a>
                </div>
            </div>
            <div class="layer">
                <h3 class="tab-tt">公司简介</h3>
                <div class="brief-con">公司简介</div>
            </div>
            <div class="layer">
                <h3 class="tab-tt">荣誉资质</h3>
                <div class="layer-con">
                        <img src="" alt="">
                </div>
            </div>
            <div class="layer">
                <h3 class="tab-tt">营业执照</h3>
                <div class="layer-con">
                    <img src="" alt="">
                </div>
            </div>
        </div>
        <div class="tab-con">
            <div class="tab-list">
                <a class="item">
                    <div class="pic">
                        <img src="" alt="">
                    </div>
                    <div class="title"></div>
                    <div class="price">￥</div>
                </a>
            </div>
            <div class="det-empty" style="display:none">
                <div class="pic">
                    <img src="/img/detail/empty_ser.png" alt="">
                </div>
                <div class="text">
                    暂无服务
                </div>
            </div>
        </div>
        <div class="tab-con">
            <div class="pro-list">
				<div class="det-empty">
                        <div class="pic">
                            <img src="/img/detail/empty_ser.png" alt="">
                        </div>
                        <div class="text">
                            暂未上传作品
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer-shop">
    <a href="tel:15280217510" class="item tel"> <i class="icon">&#xe684;</i>&nbsp;
        <span class="text">电话咨询</span> </a>
    <div class="item online">
        <i class="icon">&#xe60e;</i>&nbsp;
        <span class="text">在线咨询</span>
    </div>
</footer>
<?php $this->beginBlock('jsblock')?>
<script>
    $(function () {
        $('.tab-item').on('click', function () {
            var index = $('.tab-item').index(this);
            $(this).addClass('current').siblings().removeClass('current');
            $('.tab-con').eq(index).addClass('current-tab').siblings().removeClass('current-tab');
        })
    })
</script>
<?php $this->endBlock('jsblock')?>