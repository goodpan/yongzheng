
<?php $this->beginBlock('cssblock')?>
<link rel="stylesheet" type="text/css" href="/css/home/index.css">
<link rel="stylesheet" type="text/css" href="/css/home/search.css">
<?php $this->endBlock('cssblock')?>
	<header>
		<h1>以最快的速度，办好你的证件</h1>
		<div id="search_box" class="search_box flex">
			<i></i>
			<p>搜索你要办理的证件</p>
		</div>
	</header>
	<nav class="nav flex">
		<div class="menu_link">
			<a href="/info/site/search" class="menu_box">
				<img src="/img/home/service.png">
				<span>找证件</span>
			</a>
		</div>
		<div class="menu_link">
			<a href="/info/site/searchcomp" class="menu_box">
				<img src="/img/home/company.png">
				<span>找企业</span>
			</a>
		</div>
		<div class="menu_link">
			<a href="/info/site/searchperson" class="menu_box">
				<img src="/img/home/person.png">
				<span>找个人</span>
			</a>
		</div>
        <div class="menu_link">
			<a href="/info/site/postyourwant" class="menu_box">
				<img src="/img/home/demand.png">
				<span>发布需求</span>
			</a>
		</div>
	</nav>
	<section class="finding">
		<div class="layer-header">
			<h2 class="layer-tt"><span class="text">热门办证</span></h2>
			<p class="tt-m">近7天搜索最多的证件</p>
		</div>
		<ul class="flex">
			<?php foreach ($data as $item){?>
				<?php if($item['is_hot'] == 1){?>
					<li class="finding_item">
						<a href="/info/site/cred?id=<?=$item['cred_id']?>">
							<img src="<?=$item['cover']?>">
							<p><?=$item['cred_name']?></p>
						</a>
					</li>
				<?php }?>
			<?php }?>
		</ul>
	</section>
	<section class="recom_company">
		<div class="layer-header">
			<h2 class="layer-tt"><span class="text">推荐代办企业</span></h2>
			<p class="tt-m">好评率最好的企业</p>
		</div>
		<ul>
			<?php foreach ($business as $item){ ?>
				<?php if($item['is_hot'] == 1 && $item['type'] == 1){?>
					<li>
						<a href="/info/site/company?id=<?=$item['id']?>" class="company_link flex">
							<div class="company_pic">
								<img src="<?=$item['comp_img']?>">
							</div>
							<div class="company_info">
								<h3 class="singleEllipsis"><?=$item['comp_name']?></h3>
								<p><?=$item['desc']?></p>
								<div class="company_position">
									<i class="icon">&#xe754;</i>
									<span><?=$item['address']?></span>
								</div>
							</div>
						</a>
					</li>
				<?php }?>
			<?php }?>
		</ul>
		<div class="look_more">
			<a href="/info/site/searchcomp">查看更多</a>
		</div>
	</section>
	<section class="recom_personnel">
		<div class="layer-header">
			<h2 class="layer-tt"><span class="text">推荐代办个人</span></h2>
			<p class="tt-m">综合服务质量最高的个人代办</p>
		</div>
		<ul>
			<?php foreach ($business as $item){ ?>
				<?php if($item['is_hot'] == 1 && $item['type'] == 2){?>
					<li>
						<a href="/info/site/company?id=<?=$item['id']?>" class="company_link flex">
							<div class="company_pic">
								<img src="<?=$item['info_img']?>">
							</div>
							<div class="company_info">
								<h3 class="singleEllipsis"><?=$item['info_name']?></h3>
								<p><?=$item['desc']?></p>
								<div class="company_position">
									<i class="icon">&#xe754;</i>
									<span><?=$item['address']?></span>
								</div>
							</div>
						</a>
					</li>
				<?php }?>
			<?php }?>
		</ul>
		<div class="look_more">
			<a href="/info/site/searchperson">查看更多</a>
		</div>
	</section>
	<div class="search_wrap">
        <div class="search_header flex">
            <div class="s_close_wrap">
                <span class="s_close"></span>
            </div>
            <div class="search_input flex">
                <span></span>
                <input type="text" placeholder="请输入你要办理的证件" id="keyWord">
            </div>
            <div class="search_btn">搜索</div>
        </div>
        <div class="search_content">
            <div class="history_search">
                <div class="h_s_header flex">
                    <span class="h_s_name">历史搜索</span>
                    <div class="del_icon">
                        <span class="h_s_icon"></span>
                    </div>
                </div>
				<div class="h_s_content">
					<a href="">违章处理</a>
					<a href="">健康证办理</a>
					<a href="">特殊行业经营许可证</a>
					<a href="">暂住证</a>
				</div>
            </div>
            <div class="hot_search">
                <div class="hot_header">
                    <span>热门搜索</span>
                </div>
                <div class="hot_content">
					<a href="">违章处理</a>
					<a href="">健康证办理</a>
					<a href="">特殊行业经营许可证</a>
					<a href="">暂住证</a>
                </div>
            </div>
        </div>
    </div>
	<div class="fill-bottom"></div>
<?php $this->beginBlock('jsblock')?>
<script>
    $(function(){
        $('#search_box').on('click',function(){
            $('.search_wrap').show();
        })
        $('.s_close_wrap').on('click', function() {
            $('.search_wrap').hide();
        })
		$(window).on('scroll', function () {
            var top = $(this).scrollTop();
            if (top > 600) {
                $('.backTop').show();
            } else {
                $('.backTop').hide();
            }
        })
    })
   
    var local = localStorage.getItem('searchWordArr'),
        spanHtml = '';
    if (local) {
        local = local.split(',');
        for (var i = 0; i < local.length; i++) { //取缓存里面的值  循环成span标签插入
            if (i > 4) { //只显示5个
                break;
            }
            spanHtml += '<a href=" " onclick="toSearch()">' + local[i] + '</a>';
        }
        $('.h_s_content').html(spanHtml);
    } else {
        $('.history_search').hide();
    }
    $('.search_btn').on('click', function() {
        //设置缓存
        var value = $.trim($('#keyWord').val());

        if (value !== '') {
            var sWords = localStorage.getItem('searchWordArr'), //获取缓存值
                searchWordArr = [];
            if (!sWords) { //判断没有的话 新建
                searchWordArr.unshift(value);
                localStorage.setItem("searchWordArr", searchWordArr);
            } else { //有的话 分割字符串 重新组装
                searchWordArr = sWords.split(',');
                var isEqual = searchWordArr.every(function(item, index) {
                    return item !== value;
                });
                if (isEqual) {
                    searchWordArr.unshift(value);
                    localStorage.setItem("searchWordArr", searchWordArr);
                }
            }
        } else {
			$.toast('请输入搜索内容','text');
			return;
        }

        $('.search_wrap').hide();
        $('.searchList_wrap').show();
        setTimeout(function(args) {
            location.href = "/info/site/search?sName="+ value; //跳转模拟
        }, 500);
    });

    $('.del_icon').on('click', function() {
        $('.select_mask').show();
        shoperm.selection('确认清空历史记录吗');
    })

    $('.select_cancel').on('click', function() {
        $('.selection_bar').hide();
        $('.select_mask').hide();
    })

    $('.select_sure').on('click', function() {
        $('.selection_bar').hide();
        $('.select_mask').hide();
        $('.history_search').hide();

        localStorage.removeItem('searchWordArr');
    })

    //以下为处理IOS返回时 记录之前操作遗留的弹框的问题
    function isIOS() {
        var u = navigator.userAgent;
        return !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    }

    //处理IOS 返回搜索框还在的问题
    function toSearch() {
        if (isIOS()) {
            $('.search_wrap').hide();
            $('.searchList_wrap').show();
        }
    }
</script>
<?php $this->endBlock('jsblock')?>