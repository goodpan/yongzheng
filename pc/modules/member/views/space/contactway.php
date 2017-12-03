<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
    <div class="left-nav">
        <div class="yz-grzl">
            <ul >
                <a href="/member/space/index" target="right"><li>基本资料</li></a>
                <a href="/member/space/contactway" target="right"><li>联系方式</li></a>
                <a href="/member/space/changepwd" target="right"><li>修改密码</li></a>
                <a href="/member/space/manageinfo" target="right"><li>账户管理</li></a>
            </ul>
        </div>
    </div>
    <div class="right-show">
        <div class="right-contain">
            <h1 class="xhx"><b>联系方式</b></h1>
            <div class="user_lxfs">
                <div class="lxfs_contain">
                    <form id="submit-form">
                        <?php $uid = 1;?>
                        <?php if(!empty($uid)){
                            ?>
                        <label>绑定手机</label>&nbsp;<b>:</b>&nbsp;<input type="text" id="phone" name="phone" placeholder="认证手机" value="<?=$data['user_phone']?>"> <a>立即绑定</a><br>
                        <label>绑定邮箱</label>&nbsp;<b>:</b>&nbsp;<input type="text" id="email" value="<?=$data['user_email']?>" name="email" placeholder="请输入邮箱"> <a>立即绑定</a><br>
                        <label>固定电话</label>&nbsp;<b>:</b>&nbsp;<input type="text" id="quaho" name="quhao" placeholder="区号" style="width: 50px;">- <input type="text" id="phone2" name="phone2" placeholder="电话" value="<?=$data['immobilize_phone']?>" style="width: 150px;"/><br>
                        <label>QQ</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="" id="qq" name="qq" value="<?=$data['qq']?>" placeholder="请输入常用qq号"> <br>
                        <label>所在地</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<b style="color: red"> * </b>
                        <select >
                            <option id="provience" value="福建">福建</option>
                            <option id="provience" selected="selected" value="河南">河南</option>
                            <option id="provience" value="广东">广东</option>
                        </select>
                        <select >
                            <option id="city" value="厦门">厦门</option>
                            <option id="city" value="福州" selected="selected">福州</option>
                            <option id="city" value="泉州">泉州</option>
                        </select>
                        <select >
                            <option id="area" value="思明">思明</option>
                            <option id="area" value="湖里" selected="selected">湖里</option>
                            <option id="area" value="集美">集美</option>
                        </select>
                        <br>
                        <label>详细地址</label>&nbsp;<b>:</b>&nbsp;<b style="color: red"> * </b><input type="" id="detailaddress" name="detailaddress" placeholder="请输入详细地址" value="<?=$data['detailaddress']?>">
                        <p>填写详细地址，可以让用户快速通过地理位置找到你。正确示例：湖北省武汉市xxxxxx</p><br>
                        <?php }else{?>
                            <label>绑定手机</label>&nbsp;<b>:</b>&nbsp;<input type="text" id="phone" name="phone" placeholder="认证手机"> <a>立即绑定</a><br>
                            <label>绑定邮箱</label>&nbsp;<b>:</b>&nbsp;<input type="text" id="email" name="email" placeholder="请输入邮箱"> <a>立即绑定</a><br>
                            <label>固定电话</label>&nbsp;<b>:</b>&nbsp;<input type="text" id="quaho" name="quhao" placeholder="区号" style="width: 50px;">- <input type="text" id="phone2" name="phone2" placeholder="电话" style="width: 150px;"/><br>
                            <label>QQ</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="" id="qq" name="qq" placeholder="请输入常用qq号"> <br>
                            <label>所在地</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<b style="color: red"> * </b>
                            <select >
                                <option id="provience" value="福建">福建</option>
                                <option id="provience" selected="selected" value="河南">河南</option>
                                <option id="provience" value="广东">广东</option>
                            </select>
                            <select >
                                <option id="city" value="厦门">厦门</option>
                                <option id="city" value="福州" selected="selected">福州</option>
                                <option id="city" value="泉州">泉州</option>
                            </select>
                            <select >
                                <option id="area" value="思明">思明</option>
                                <option id="area" value="湖里" selected="selected">湖里</option>
                                <option id="area" value="集美">集美</option>
                            </select>
                            <br>
                            <label>详细地址</label>&nbsp;<b>:</b>&nbsp;<b style="color: red"> * </b><input type="" id="detailaddress" name="detailaddress" placeholder="请输入详细地址">
                            <p>填写详细地址，可以让用户快速通过地理位置找到你。正确示例：湖北省武汉市xxxxxx</p><br>
                        <?php }?>
                        <!--百度地图容器-->
                        <div style="width:697px;height:200px;border:#ccc solid 1px;" id="dituContent"></div><br>
                        <button id="submit-button">保存</button>
                    </form>
                </div>
            
            </div>
        </div>
        
    </div>
<script type="text/javascript">
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
            addMarker();//向地图中添加marker
        }

        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
            var point = new BMap.Point(118.159012,24.49003);//定义一个中心点坐标
            map.centerAndZoom(point,13);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        //地图控件添加函数：
        function addMapControl(){
            //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
            map.addControl(ctrl_nav);
            //向地图中添加缩略图控件
            var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
            map.addControl(ctrl_ove);
            //向地图中添加比例尺控件
            var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
            map.addControl(ctrl_sca);
        }

        //标注点数组
        var markerArr = [{title:"我的标记",content:"我的备注",point:"118.173816|24.512126",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
        ];
        //创建marker
        function addMarker(){
            for(var i=0;i<markerArr.length;i++){
                var json = markerArr[i];
                var p0 = json.point.split("|")[0];
                var p1 = json.point.split("|")[1];
                var point = new BMap.Point(p0,p1);
                var iconImg = createIcon(json.icon);
                var marker = new BMap.Marker(point,{icon:iconImg});
                var iw = createInfoWindow(i);
                var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
                marker.setLabel(label);
                map.addOverlay(marker);
                label.setStyle({
                    borderColor:"#808080",
                    color:"#333",
                    cursor:"pointer"
                });

                (function(){
                    var index = i;
                    var _iw = createInfoWindow(i);
                    var _marker = marker;
                    _marker.addEventListener("click",function(){
                        this.openInfoWindow(_iw);
                    });
                    _iw.addEventListener("open",function(){
                        _marker.getLabel().hide();
                    })
                    _iw.addEventListener("close",function(){
                        _marker.getLabel().show();
                    })
                    label.addEventListener("click",function(){
                        _marker.openInfoWindow(_iw);
                    })
                    if(!!json.isOpen){
                        label.hide();
                        _marker.openInfoWindow(_iw);
                    }
                })()
            }
        }
        //创建InfoWindow
        function createInfoWindow(i){
            var json = markerArr[i];
            var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
            return iw;
        }
        //创建一个Icon
        function createIcon(json){
            var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
            return icon;
        }

        initMap();//创建和初始化地图
</script>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
$("#submit-button").click(function () {
        var phone = $("#phone").val();
        var email = $("#email").val();
        var quaho = $("#quaho").val();
        var phone2 = $("#phone2").val();
        var profile = $("#profile").val();
        var qq = $("#qq").val();
        var provience = $("#provience").val();
        var city = $("#city").val();
        var area = $("#area").val();
        var detailaddress = $("#detailaddress").val();

        if (phone == '') {
           alert('电话不能为空');
           return false;
        }
        if (email == '') {
           alert('邮箱不能为空');
           return false;
        }
        if (provience == ''|| city == ''|| area == '') {
           alert('所在地不能为空');
           return false;
        }
       
        if (detailaddress == '') {
           alert('详细地址不能为空');
           return false;
        }

        $.ajax({
            url: 'contactway',
            type: 'post',
            dataType:'json',
            data: $('#submit-form').serialize(),
            success: function (result) {
                alert(resut.msg);
                window.location.reload();
            }
        });
        return false;
    })
</script>