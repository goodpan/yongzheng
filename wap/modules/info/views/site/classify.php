<?php $this->beginBlock('cssblock') ?>
    <link rel="stylesheet" href="/css/home/classify.css?">
<?php $this->endBlock('cssblock') ?>
<?php $this->beginBlock('classify_title') ?>
<?php $this->endBlock('classify_title') ?>
    <div class="category_wrap">
    <div class="header">
        <div class="top_search flex">
            <span class="mirror"></span> <span class="word">搜索你要的证件</span>
        </div>
    </div>
    <div class="cat-viewport">
        <div class="cat-nav" id="cat-nav">
            <ul>
                <!--初始化第一个加cur-->
                <!-- 一级分类-->
                <? foreach ($dataClassifyList as $firstClassifyName => $item) { ?>
                    <? if ($checkFirstKey == $firstClassifyName) { ?>
                        <li class="cur"><?= $firstClassifyName; ?></li>
                    <? } else { ?>
                        <li class=""><?= $firstClassifyName; ?></li>
                    <? } ?>
                    </a>
                <? } ?>
                <li>热门分类</li>
                </a>
            </ul>
        </div>
        <div class="cat-con" id="cat-con">
            <!--初始化第一个加item-cur-->
            <? foreach ($dataClassifyList as $firstClassifyName => $secondClassifyList) { ?>
            <? if ($checkFirstKey == $firstClassifyName) { ?>
            <div class="con-item item-cur">
                <? } else { ?>
                <div class="con-item">
                    <? } ?>
                    <h2 class="item-title">
                        <a class="t-text"
                           href="/info/site/search?sName=<?php echo $firstClassifyName ?>">
                            全部<?= $firstClassifyName ?>类 </a>
                    </h2>
                    <!--二级分类-->
                    <?
                    array_pop($secondClassifyList);//移除二级分类数组最后一个元素  最后一个一级分类ID
                    foreach ($secondClassifyList as $secondClassifyName => $thirdClassfyList) {
                        ?>
                        <div class="item-list">
                            <a href="/info/site/search?sName=<?php echo $secondClassifyName ?>">
                                <h3 class="list-title">
                                    <span class="l-title-text"><?echo $secondClassifyName ?></span>
                                </h3>
                            </a>
                            <ul class="pro-group">
                                <!--三级分类-->
                                <?
                                array_pop($thirdClassfyList);
                                foreach ($thirdClassfyList as $value) { ?>
                                    <a href="/info/site/search?sName=<?php echo $value->name; ?>">
                                        <li class="pro-item">
                                            <div class="img-box">
                                                <img
                                                    src="/img/classify/tmp.jpg"
                                                    alt="<?= $value->name ?>">
                                            </div>
                                            <div class="img-tt"><?= $value->name ?></div>
                                        </li>
                                    </a>
                                <? } ?>
                            </ul>
                        </div>
                    <? } ?>
                </div>
                <? } ?>
                <div class="con-item ">
                    <h2 class="item-title">
                        <a href="javascript:;"> 全部热门分类 </a>
                    </h2>
                    <!--二级分类-->
                    <div class="item-list">
                        <!--                        <a href="http://m.shop.myerm.cn/shop0/product/list?catid=87">-->
                        <h3 class="list-title">
                            <span class="l-title-text">本月热搜</span>
                        </h3>
                        <!--                        </a>-->
                        <ul class="pro-group">
                            <!--三级分类-->
                            <?php foreach ($hotClassifyList as $value) { ?>
                                <a href="http://m.shop.myerm.cn/shop0/product/list?catid=<?php echo $value->id;?>">
                                    <li class="pro-item">
                                        <div class="img-box">
                                            <img
                                                src="http://backend.shop.myerm.cn/userfile/upload/2017-10-09/15075427350032044600726987415318.jpg"
                                                alt="纸尿裤">
                                        </div>
                                        <div class="img-tt"><?php echo $value->name;?></div>
                                    </li>
                                </a>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search_wrap" style="display: none;">
        <div class="search_header flex">
            <div class="s_close_wrap">
                <span class="s_close"></span>
            </div>
            <div class="search_input flex">
                <span></span>
                <input type="text" placeholder="搜索你要的证件" id="keyWord">
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
                </div>
            </div>
            <div class="hot_search" style="display: none">
                <div class="hot_header">
                    <span>热门搜索</span>
                </div>
                <div class="hot_content">
                    <span
                        onclick="location.href='http://m.shop.myerm.cn/shop0/product/list?keyword=%E5%AE%89%E5%85%A8%E5%BA%A7'">安全座</span>
                    <span
                        onclick="location.href='http://m.shop.myerm.cn/shop0/product/list?keyword=%E5%A5%B6%E7%93%B6'">奶瓶</span>
                    <span
                        onclick="location.href='http://m.shop.myerm.cn/shop0/product/list?keyword=%E5%A5%B6%E7%B2%89'">奶粉</span>
                    <span
                        onclick="location.href='http://m.shop.myerm.cn/shop0/product/list?keyword=%E8%BE%85%E9%A3%9F'">辅食</span>
                    <span
                        onclick="location.href='http://m.shop.myerm.cn/shop0/product/list?keyword=%E7%BA%B8%E5%B0%BF%E8%A3%A4'">纸尿裤</span>
                    <span
                        onclick="location.href='http://m.shop.myerm.cn/shop0/product/list?keyword=%E8%BE%85%E9%A3%9F%E6%9C%BA'">辅食机</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mask"></div>


    <!-- 选择框 -->
    <div class="selection_bar">
        <div class="select_name"></div>
        <div class="select_chose flex">
            <span class="select_cancel flexOne">取消</span>
            <span class="select_sure flexOne">确认</span>
        </div>
    </div>
    <!-- 提示框 -->
    <div id="massage"></div>
    <!-- 加载图 -->
    <div class="weui-loading-toast" style="display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
        </div>
    </div>

    <?php $this->beginBlock('jsblock') ?>
    <script>
        $(function () {
            //TAB切换
            $('#cat-nav ul li').on('click', function () {
                var index = $('#cat-nav ul li').index(this);
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.con-item').eq(index).addClass('item-cur').siblings().removeClass('item-cur');
            })

            //搜索栏效果
            $('.top_search').on('click', function () {
                $('.search_wrap').show();
                $('.category_wrap').hide();
                $('footer').hide();
            })

            $('.s_close_wrap').on('click', function () {
                $('.search_wrap').hide();
                $('.category_wrap').show();
                $('footer').show();
            })

            var local = localStorage.getItem('searchWordArr'),
                spanHtml = '';
            if (local) {
                local = local.split(',');
                for (var i = 0; i < local.length; i++) { //取缓存里面的值  循环成span标签插入
                    if (i > 4) { //只显示5个
                        break;
                    }
                    spanHtml += '<span onclick="toSearch(\'' + local[i] + '\')">' + local[i] + '</span>';
                }
                $('.h_s_content').html(spanHtml);
            } else {
                $('.history_search').hide();
            }

            //点击搜索 
            $('.search_btn').on('click', function () {

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
                        var isEqual = searchWordArr.every(function (item, index) {
                            return item !== value;
                        })

                        if (isEqual) {
                            searchWordArr.unshift(value);
                            localStorage.setItem("searchWordArr", searchWordArr);
                        }
                    }
                } else {
                    value = $('#keyWord').attr('placeholder');
                }

                $('#keyWord').val('');
                $('.search_wrap').hide();
                //value 输入的值
                location.href = "http://m.shop.myerm.cn/shop0/product/list?keyword=" + encodeURI(value); //模拟
            })

            //删除历史激励
            $('.del_icon').on('click', function () {
                $('.mask').show();
                shoperm.selection('确认清空历史记录吗');
            })

            $('.select_cancel').on('click', function () {
                $('.selection_bar').hide();
                $('.mask').hide();
            })

            $('.select_sure').on('click', function () {
                $('.selection_bar').hide();
                $('.mask').hide();
                $('.history_search').hide();

                localStorage.removeItem('searchWordArr');
            })

        })
        //搜索历史加链接
        function toSearch(keyword) {
            var url = 'http://m.shop.myerm.cn/shop0/product/list';
            location.href = url + '?keyword=' + keyword;
        }
    </script>
<?php $this->endBlock('jsblock') ?>