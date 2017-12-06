<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Time: 2017年11月17日15:04:38
 */
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>首页</title>
<link rel="stylesheet" href="/css/lib/weui.css">
    <link rel="stylesheet" href="/css/lib/jquery_weui.css">
    <link rel="stylesheet" href="/css/common.css">
<link rel="stylesheet" type="text/css" href="/css/home/detail.css">
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
    <header class="top_btn">
     <a  href="javascript:;" onclick="window.history.go(-1)" class="circ go_back"> <span class="icon">&#xe610;</span> </a>
     <div href="JavaScript:;" class="circ do_more"> 
         <span class="icon" id="nav-more">&#xe602;</span> 
    </div>
    
    </header>
    <ul class="nav-drop" id="nav-drop">
            <li class="drop-item">
                <a href="/">首页</a>
            </li>
            <li class="drop-item">
                <a href="/type/index">分类</a>
            </li>
            <li class="drop-item">
                <a href="/member/index">我的</a>
            </li>
    </ul>
    <div class="banner_swiper">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="" alt="">
                    </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        </div>
    </div>
    <div class="describe">
        <h1 class="multiEllipsis">卫生许可证</h1>
        <p class="multiEllipsis">卫生许可证卫生许可证卫生许可证</p>
        <p class="local"><i class="icon">&#xe754;</i><span class="text">福建 厦门</span></p>
    </div>
    <div class="commodity_details">
        <div class="details_title flex">
            <i class="detail_btn active">申请条件</i> 
            <i class="detail_btn">申请材料</i>
            <i class="detail_btn">费用</i>
            <i class="detail_btn">地点</i>
        </div>
        <!--商品详情-->
        <div class="details_content">
        商品详情商品详情商品详情
        </div>
    <!--售后说明-->
        <div class="details_content" style="display: none;">
            <div class="service_con">
            <p><span style="color: rgb(34, 34, 34); font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);">如果出现少件，或质量问题！ 请及时联系我们，您选择我们，我们会给您负责到底！</span></p><p><span style="color: rgb(34, 34, 34); font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);"><img src="http://backend.shop.myerm.cn/js/global/plugins/ueditor/php/../../../../../userfile/upload/20171115/15107331394054.jpg" title="截图69.jpg"/></span></p>                            </div>
        </div>
    </div>

    <!--商品大图-->
    <div class="swiper_mask">
        <div class="imgShow">
            <div class="swiper-container1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 头部导航 -->
    <div class="fix_title">
        <div class="fix_title_wrap flex">
            <a href="JavaScript:;" onclick="goBack()" class="fix_back"> <span class="icon">&#xe610;</span> </a>
            <div class="fix_label flex">
                <span class="fix_one on">商品</span> 
                <span class="label_btn">详情</span>
            </div>
            <a href="JavaScript:;" class="fix_more"> <span class="icon">&#xe602;</span> </a>
        </div>
    </div>
    <!-- 二维码 -->
    <div class="ewm_wrap">
        <div class="ewm_pic"> 
            <img src="" x-src="http://qr.liantu.com/api.php?text=" alt="">
        </div>
        <p>扫描二维码，查看</p>
    </div>
    <div class="fill-bottom"></div>
    <div class="d-footer">
        <a href="tel:15280217510" class="tel">
             <i class="icon">&#xe684;</i>
             <span class="text">电话咨询</span></a>
        <a href="javascript:;" class="online" id="btn-ask">
             <i class="icon">&#xe60e;</i>
             <span class="text">在线咨询</span>
        </a>
    </div>
    <!-- 回到顶部 -->
    <div class="backTop"></div>
    <div class="mask"></div> <!-- 一阶遮罩 -->
    <div class="g_mask"></div> <!-- 二阶遮罩 -->
    
    <script src='/js/jquery.min.js'></script>
    <script src="/js/swiper.min.js"></script>
    <script>
        function isWeixin(){
            var ua = navigator.userAgent.toLowerCase();
            if(ua.match(/MicroMessenger/i)=='micromessenger'){
                return true;
            }else{
                return false;
            }
        }
        var reScroll = 0;
        $(function(){
            //轮播图
            var mySwiper = new Swiper('.swiper-container', {
                autoplay: 3000,//可选选项，自动滑动
                pagination: '.swiper-pagination',
            })
            //点击查看大图处理
            var mySwiper1 = new Swiper('.swiper-container1', {
                //autoplay: 2000,//可选选项，自动滑动
            })
            mySwiper.params.control = mySwiper1;//需要在Swiper2初始化后，Swiper1控制Swiper2
            mySwiper1.params.control = mySwiper;//需要在Swiper1初始化后，Swiper2控制Swiper1

            $('.swiper_mask').on('click', function () {
                $(this).hide();
                $(this).css('zIndex', '-100')
                mySwiper.startAutoplay();
            });
            $('.swiper-container').on('click', function () {
                $('.swiper_mask').css('zIndex', '200');
                $('.swiper_mask').show();
                mySwiper.stopAutoplay();
            });
            $('.swiper_mask').hide();

            //导航点击事件
        $('.fix_one ').on('click', function () {
            $(window).scrollTop(0);
        })
        $('.label_btn').on('click', function () {
            var com_top = $('.commodity_details').offset().top - 100;
            $(window).scrollTop(com_top);
        })

        //查看二维码
        $('.ewm').on('click', function () {
            var src = $('.ewm_wrap img').attr('x-src');
            $('.ewm_wrap img').attr('src',src);  
            $('.ewm_wrap').show();
            $('.mask').show();
        })
        $('.mask').on('click', function () {
            $('.ewm_wrap').hide();
            $('.mask').hide();
        })

        //底部商品详情切换
        $('.details_title i').on('click', function () {
            var index = $(this).index();
            $(this).addClass('active');
            $(this).siblings('i').removeClass('active');
            $('.details_content').eq(index).show();
            $('.details_content').eq(index).siblings('.details_content').hide();
        })
         //滚动显示导航栏
         $(window).on('scroll', function () {
            var divisTop = $('.supplier').offset().top,
                top = $(this).scrollTop();
            $('#nav-drop').hide();
            if (top > 600) {
                $('.fix_title').show();
                $('.backTop').show();
            } else {
                $('.fix_title').hide();
                $('.backTop').hide();
            }

            if (divisTop < top + 200) {
                $('.fix_one ').removeClass('on').siblings('span').addClass('on');
            } else {
                $('.fix_one ').addClass('on').siblings('span').removeClass('on');
            }

            $('.nav_more_list').hide();
            $('.backTop').on('click',function(){
                // $('body,html').animate({scrollTop:0},200);
                $('body,html').scrollTop(0);
            })
        });

        $('#btn-ask').on('click',function(){
            if(isWeixin()){
                $('.ewm_wrap').show();
                $('.mask').show();
            }else{
                location.href = 'mqqwpa://im/chat?chat_type=wpa&uin=3314634698&version=1&src_type=web&web_src=oicqzone.com';
            }
        })

        $('#nav-more,.fix_more').on('click',function(){
            if($('#nav-drop').is(":hidden")){
                $('#nav-drop').show();
            }else{
                $('#nav-drop').hide();
            }
        })
    })
    </script>
</body>
</html>