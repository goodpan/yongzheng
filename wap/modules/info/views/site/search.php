<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>搜索列表</title>
	<link rel="stylesheet" type="text/css" href="/css/common.css">
	<link rel="stylesheet" href="/css/lib/mescroll.min.css"/>
	<link rel="stylesheet" type="text/css" href="/css/home/list.css">
	<link rel="stylesheet" type="text/css" href="/css/home/search.css">
	<link rel="stylesheet" type="text/css" href="/css/lib/weui.css">
	<link rel="stylesheet" type="text/css" href="/css/lib/jquery_weui.css">
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
	<div class="searchList_wrap" id="app" v-cloak>
		<div class="top_colum">
	        <div class="s_l_top flex">
	            <div class="s_l_back" onclick="window.history.go(-1)">
	                <span class="icon">&#xe610;</span>
	            </div>
	            <div id="search_box" class="s_input flex">
	                <span></span>
	                <h2 style='color:#999'>搜索证件/企业/人才</h2>
	            </div>
	            <!-- <div class="s_l_more flexOne">
	                <span class="icon">&#xe602;</span>
				</div> -->
				<div class="nav-more">
					<span class="h_more icon" id="nav-more" style="color:#fff">&#xe602;</span>
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
				</div>
	        </div>
	        <div class="select_area">
				<div class="select_item flex">
					<a href='/search/goods' class="active">搜证件</a>
					<a href='/search/company'>搜企业</a>
					<a href='/search/personal'>搜个人</a>
				</div>
	            <div class="area_list flex" v-if="nowItem == 'service'">
	                <span :class="{ on: condition === 'default' }" @click="doDefaultSort">默认排序</span> 
	                <span class="arrow_wrap" :class="{ on: condition === 'price' }" @click="doPriceSort">
							费用
	        			<i class="arrow_top" :class="{ 'up':isPriceDesc }"></i>
	        			<i class="arrow_bottom" :class="{ 'down':!isPriceDesc }"></i>
	        		</span>
	        		<span class="s_price position" :class="{ on: condition === 'position' }" @click="switchLocation">		
						所在地
						<i class="position_bottom"></i>
	        		</span>
	                <div class="select_filter flex" @click="toFilter">
	                    <b class="icon">&#xe6c9;</b>
	                    <em>筛选</em>
	                </div>
	            </div>
	            <div class="area_list_other flex" v-else>
	                <span :class="{ on: condition=== 'default' }" @click="doDefaultSort">默认排序</span> 
	                <span class="arrow_wrap position" :class="{ on: condition === 'position' }" @click="switchLocation">
							所在地
	        			<i class="arrow_bottom"></i>
	        		</span>
	                <span class="flex filter">
	                    <b class="icon">&#xe6c9;</b>
	                    <em>筛选</em>
	                </span>
	            </div>
	        </div>
	    </div>
	    <div class="s_l_content">
			<div id="mescroll" class="mescroll">
	   			<div class="mescroll-bounce" v-if="!isEmpty">
				   	<ul id="s-def" class="data-list">
					   <li v-for="item in dataList">
							<a href="" class="flex">
								<div class="list_img">
									<img :src="item.sImageUrl" alt="">
								</div>
								<div class="list_content flexOne">
									<h2 class="singleEllipsis" v-text="item.sName"></h2>
									<em v-text="'¥'+item.fPrice"></em>
									<div class="company_position">
										<i class="icon">&#xe754;</i>
										<span v-text="item.sAddress">福建 厦门</span>
									</div>
								</div>  
							</a>
						</li>
					</ul>
		    	</div>
				  <!-- 筛选为空时 -->
				  <div class="empty_list" v-if="isEmpty">
						<div class="empty_pic">
							<img src="/img/search/list_empty.png" alt="">
						</div>
						<p>啊哦~没有搜到相关服务</p>
				</div>
	    	</div>
	    </div>
	<!-- 筛选框 -->
	<div class="filter_wrap" style="display:block" v-if="isShowFilter">
		<div class="filter_top flex">
			<span class="cancel_btn" @click="cancelFilter">取消</span>
			<h3>筛选</h3>
			<span class="sure_btn" @click="cofirmFilter">确认</span>
		</div>
		<div class="filter_content">
			<div class="f_label" v-for="(type,index) in typeList">
				<div class="f_l_top flex">
					<div class="l_t_name" v-text="type['typeName']">分类</div>
					<div class="l_t_all">展开全部</div>
				</div>
				<div class="f_l_content">
					<span :class="{'all':true,'on':type['isAll']}" @click="changeAll(index)">全部</span> <!--第一个要特殊处理 class all其他span不能有 -->
					<span :class="{'on':tag['seleted']}" v-for="(tag,index2) in type['tags']" @click="seletedTag(index,index2)">{{tag['tagName']}}</span>
					<div class="f_l_more">
						<span>安全椅</span>
						<span>安全椅</span>
						<span>安全椅</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 地址选择 -->
	<div class="area_wrap" v-if="isShowLocation" style="display:block" @click="hideArea">
		<div class="area_select flex">
			<div class="area_provinces">
				<ul>
					<li v-for="(item,index) in citys" @click="changeProv(index,$event)" :class="{ active: index==currentProv }">{{item[index]}}</li>
				</ul>
			</div>
			<div class="area_city" @click="$event.stopPropagation()">
				<ul>
					<li v-for="(c,index) in cityList" @click="changeCity(index,c[index+1],$event)" :class="{ active: index==currentCity }">{{c[index+1]}}</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mask" v-if="isShowFilter" @click="isShowFilter=false"></div>
</div>
<div class="search_wrap">
	<div class="search_header flex">
		<div class="s_close_wrap">
			<span class="s_close"></span>
		</div>
		<div class="search_input flex">
			<span></span>
			<input type="text" placeholder="请输入你要搜索的内容" id="keyWord">
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
				<a href="">奶嘴</a>
				<a href="">玻璃奶瓶</a>
				<a href="">爸爸去哪儿同款安全座椅</a>
				<a href="">即食 辅食</a>
			</div>
		</div>
		<div class="hot_search">
			<div class="hot_header">
				<span>热门搜索</span>
			</div>
			<div class="hot_content">
				<a href="">奶嘴</a>
				<a href="">玻璃奶瓶</a>
				<a href="">爸爸去哪儿同款安全座椅</a>
				<a href="">即食 辅食</a>
			</div>
		</div>
	</div>
	</div>
</body>
<script src="/js/citys.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.1.1/js/jquery-weui.min.js"></script>
<script src="/js/iscroll.js"></script>
<script src="/js/mescroll.min.js"></script>
<script src="/js/colorful.js"></script>
<!-- <script src="/js/dropload.js"></script> -->
<script src="/js/vue.min.js"></script>
<script>
	 var reqData = {
		sName:'',//初始化后端填
		sAddress:'',
		TypeID:'',
		page:0,
		limit:10,
		sortby:'',
		ascdesc:'',
	 };
	var provID = '5';//初始省份ID
	var cityID = '4';//初始城市ID
	var cityList = Citys[provID]['c'];
	var typeList = [
		{
			typeName:'分类1',
			typeID:1,
			isAll:true,
			tags:[
				{
					tagName:'标签11',
					tagId:1,
					seleted:false
				},
				{
					tagName:'标签12',
					tagId:1,
					seleted:false
				},
				{
					tagName:'标签13',
					tagId:1,
					seleted:false
				},
			]
		},
		{
			typeName:'分类2',
			typeID:1,
			isAll:true,
			tags:[
				{
					tagName:'标签21',
					tagId:1,
					seleted:false
				},
				{
					tagName:'标签22',
					tagId:1,
					seleted:false
				},
				{
					tagName:'标签3',
					tagId:1,
					seleted:false
				},
			]
		},
	];
	var dataList = [
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "微网站建设微信公众号定制开发仿手机官网制作企业商城做设计全包",
            "fPrice": 22221,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110410043388100872719679715.jpg",
            "sAddress": "福建 厦门市"
        },
        {
            "sName": "企业标准型建站网站建设网站设计授权防伪建官网深圳网站定制仿站",
            "fPrice": 1112,
            "sImageUrl": "http://myerm.yizhanshi.com/userfile/upload/2017/11-24/15115110050048370900516101580142.jpg",
            "sAddress": "福建 厦门市"
        }
    ];
	new Vue({
		el: '#app',
		data: {
			mescroll: null,
			isLoading:false,
			isEmpty: false, //搜索内容是否为空
			nowItem: 'service', //当前选择项目
			condition: 'default',//当前选择条件
			reqData: reqData, //接口请求数据
			isMore: true, //是否更多
			isPriceDesc: false, //价格排序上下 开关
			isShowFilter:false,
			dataList: dataList,//数据列表
			reqUrl: '',//请求地址
			citys:Citys,//省市列表
			cityList:cityList,//城市列表
			isShowLocation:false,//是否显示地区下拉
			currentProv:provID,//当前省份
			currentCity:cityID,//当前城市
			currentProvText:'全国',//当前省份名
			currentCityText:'',//当前城市名
			seletedTags:[],//已选标签
			typeList:typeList		
		},
		mounted: function() {
			this.dropFunc();
		},
		methods: {
			dropFunc:function(){
				var _self = this;
				_self.mescroll = new MeScroll("mescroll", {
					up: {
						auto:true,
						callback: _self.upCallback, //上拉回调
						toTop:{ //配置回到顶部按钮
							src : "/img/search/mescroll-totop.png", //默认滚动到1000px显示,可配置offset修改
							// offset : 1000
						}
					},
					down:{
						use:false
					}
				});
				//初始化vue后,显示vue模板布局
				document.getElementById("app").style.display="block";
			},
			upCallback:function(){
				this.reqData.page++;
				$('.mescroll-upwarp').show();
				if(!this.isMore){
					this.mescroll.endSuccess();
					$('.mescroll-upwarp').text('暂无数据')
					return;
				}
				this.getData(true);
			},
			//请求数据
			getData: function(scroller) {
				var _self = this;
				$.ajax({
					type: 'GET',
					url: _self.reqUrl,
					data:_self.reqData,
					dataType: 'json',
					success: function(res){
						if(res&&res.arrList&&res.arrList.length > 0){
							_self.isEmpty = false;
							//非滚动，先置空
							scroller||(_self.dataList = []);
							setTimeout(() => {
								_self.dataList = _self.dataList.concat(res.arrList);
								_self.isMore = res.bMoreData;
								_self.mescroll.endSuccess();
							}, 200);
						}else{
							setTimeout(() => {
								scroller||(_self.isEmpty = true);
								scroller||(_self.dataList = [],$('.mescroll-upwarp').hide());
								_self.mescroll.endSuccess();
							}, 200);
						}
					},
					error: function(xhr, type){
						_self.mescroll.endErr();
					}
				});
			},
			//默认排序
			doDefaultSort:function(){
				this.reqData.sAddress = '';
				this.reqData.page = 1;
				this.reqData.sortby = '';
				this.reqData.ascdesc = '';
				this.isMore = true;
				this.getData();
			},
			//价格排序
			doPriceSort:function(){
				this.isPriceDesc = !this.isPriceDesc;
				this.reqData.page = 1;
				this.reqData.sortby = 'fPrice';
				this.isPriceDesc?this.reqData.ascdesc='desc':this.reqData.ascdesc='asc';
				this.isMore = true;
				this.getData();
			},
			//切换地点
			switchLocation:function(){
				this.isShowLocation = !this.isShowLocation;
				this.reqData.page = 1;
				// this.getData();
			},
			//切换省份
			changeProv:function(index,e){
				e.stopPropagation();
				this.currentProv = index;
				this.currentProvText = this.citys[index][index];
				this.cityList = this.citys[index]['c'];
			},
			//切换城市
			changeCity:function(index,city,e){
				e.stopPropagation();
				this.currentCityText = city;
				this.currentCity = index;
				this.reqData.sAddress = this.currentProvText+','+this.currentCityText;
				this.isMore = true;
				this.isShowLocation = false;
				this.getData();
			},
			toFilter:function(){
				this.isShowFilter = true;
			},
			//取消
			cancelFilter:function(){
				this.isShowFilter = false;
			},
			//确认
			cofirmFilter:function(){
				this.isShowFilter = false;
				this.reqData.page = 1;
				var seletedArr = [];
				//获取选中的标签
				for(var item in this.classify){
					if(this.classify[item]['seleted']){
						seletedArr.push(this.classify[item]['TypeID']);
					}
				}
				this.reqData.TypeID = seletedArr.toString();
				this.getData();
			},
			seletedClassify:function(index,TypeID){
				this.reqData.TypeID = TypeID;
				this.classify[index]['seleted'] = !this.classify[index]['seleted'];
			},
			hideArea:function(){
				this.isShowLocation = false;
			},
			//标签选择
			seletedTag:function(index,index2){
				if(this.typeList&&this.typeList[index]&&this.typeList[index]['tags']&&this.typeList[index]['tags'][index2]){
					this.typeList[index]['tags'][index2]['seleted'] = !this.typeList[index]['tags'][index2]['seleted'];
					//切换全选
					var tagList = this.typeList[index]['tags'];
					var isAllSeleted = tagList.some(function(item,index){
						return item['seleted'];
					})
					if(isAllSeleted){
						this.typeList[index]['isAll'] = false;
					}
				}
			},
			//全选
			changeAll:function(index){
				if(this.typeList[index]){
					var isAll = this.typeList[index]['isAll'];
					this.typeList[index]['isAll'] = !isAll;
					if(this.typeList[index]['isAll']){
						this.typeList[index]['tags'].forEach(function(item){
							item['seleted'] = false;
						})
					}
				}
			}
		}
	})
</script>
<script>
        $(function(){
            $('#nav-more').on('click',function(){
                if($("#nav-drop").is(":hidden")){
                     $("#nav-drop").show();    //如果元素为隐藏,则将它显现
                }else{
                    $("#nav-drop").hide();     //如果元素为显现,则将其隐藏
                }
            })
        })
</script>
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
            spanHtml += '<a onclick="toSearch(this)">' + local[i] + '</a>';
        }
        $('.h_s_content').html(spanHtml);
    } else {
        $('.history_search').hide();
    }
    $('.search_btn').on('click', function() {
        //设置缓存
        var value = $.trim($('#keyWord').val());
        if (value == '') { 
            $.toast('请输入搜索内容','text');
            return;
        }
        var sWords = localStorage.getItem('searchWordArr'), //获取缓存值
            searchWordArr = [];
        if (!sWords) { //判断没有的话 新建
            searchWordArr.unshift(value);
            localStorage.setItem("searchWordArr", searchWordArr);
        } else { //有的话 分割字符串 重新组装
            searchWordArr = sWords.split(',');
            var isEqual = searchWordArr.every(function(item, index) {
                return item !== value;
            })
            if (isEqual) {
                searchWordArr.unshift(value);
                localStorage.setItem("searchWordArr", searchWordArr);
            }
        }
        $('.search_wrap').hide();
        $('.searchList_wrap').show();
        location.href = '/search/goods?sName='+value;
    })

    $('.del_icon').on('click', function() {
        $('.select_mask').show();
        $.confirm({
            text: '确认清空全部历史记录？',
            onOK: function () {
                //点击确认
                localStorage.removeItem('searchWordArr');
                $('.history_search').hide();
            }
        });
    })

    $('.select_cancel').on('click', function() {
        $('.selection_bar').hide();
        $('.select_mask').hide();
    })

    //以下为处理IOS返回时 记录之前操作遗留的弹框的问题
    function isIOS() {
        var u = navigator.userAgent;
        return !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    }

    //处理IOS 返回搜索框还在的问题
    function toSearch(elm) {
        var sName = $(elm).text();
        if (isIOS()) {
            $('.search_wrap').hide();
            $('.searchList_wrap').show();
        }
        location.href = '/search/goods?sName='+sName;
    }
</script>
</html>