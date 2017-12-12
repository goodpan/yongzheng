
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>提交需求</title>
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" type="text/css" href="/css/lib/LCalendar.css">
    <link rel="stylesheet" type="text/css" href="/css/home/requrement.css">
<style>
    body{
        background:#fff;
    }
</style>
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
    <link rel="stylesheet" href="/css/lib/weui.css">
    <link rel="stylesheet" href="/css/lib/jquery_weui.css">
    <script src="/js/hotcss.js"></script>
</head>
<body>
    <header class="header">
        <i class="back" onclick="window.history.go(-1);"><img src="" alt=""></i>
        <span class="text">提交需求</span>
            <span class="nav">•••</span>
    </header>
    <div class="req-main">
    <div class="req-tt">
    发布需求，平台将自动筛选最复合需求的企业或人
才，解决你的问题。
    </div>
    <form action="" class="req-form" id="req-form">
        <input type="hidden" name="_csrf" value="KtWyjZERXRGuM3o7thLvKdlGkjB3FFN-mJuF6-3tsI3_jO9Sxfjbm7vIEu5rK8l8EutntgOH1zkmtAf7VR19vA==">
        <div class="form-item">
            <input type="text" name="sName" class="inp" placeholder="用一句话概括你的需求,如：开发分销商城">
        </div>
        <div class="form-item">
            <label for="" class="item-label">你需要委托企业还是找个人</label>
            <div class="item-elm">
            <select name="TypeID" id="" class="item-sl">
                <option value="">请选择</option>
                                <option value="personal">个人</option>
                                <option value="company">企业</option>
                                <option value="unlimited">不限</option>
                            </select>
            </div>
        </div>
        <div class="form-item-wrap">
            <div class="form-item-label">
                请详细描述你的需求
            </div>
            <div class="item-elm">
                <textarea name="sContent" id="" cols="30" rows="10" class="desc" placeholder="如：我要办理店铺营业执照"></textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="" class="item-label">你的大致预算</label>
            <div class="item-elm">
                <input type="text" name="sBudget" class="inp" placeholder="请输入金额">
                <span>元</span>
            </div>
        </div>
        <div class="form-item">
            <label for="dDeliverDate" class="item-label">要求完成时间</label>
            <div class="item-elm">
                <input id="dDeliverDate" type="text" readonly class="inp" name="dDeliverDate" placeholder="" data-lcalendar="2000-01-01,2050-01-29" />
                <i class="icon datepiker" id="datepiker">&#xe605;</i>
            </div>
        </div>
                <div class="form-item-wrap">
            <div class="form-item-label">
                联系方式
            </div>
            <div class="item-elm">
                <input id="sPhone" name="sPhone" type="text" class="full-inp" placeholder="请输入手机号">
            </div>
            <div class="form-item code-wrap">
                <input type="text" name="sCode" class="inp-code" placeholder="请输入验证码">
                <span class="btn-send" id="send-code">发送验证码</span>
            </div>
        </div>
                <div class="btn-wrap">
            <button type="submit" class="btn-entry" id="regist">提交</button>
        </div>
    </form>
</div>
<div class="sign-end"></div>
    <!-- <script src="/js/zepto.min.js"></script> -->
    <script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-weui/1.1.1/js/jquery-weui.min.js"></script>
    <script src="/js/LCalendar.js"></script>
<script>
var calendar = new LCalendar();
calendar.init({
    'trigger': '#datepiker',//标签id
    'type': 'date',//date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择
    'minDate':'1900-1-1',//最小日期 注意：该值会覆盖标签内定义的日期范围
    'maxDate':'2050-3-18',//最大日期 注意：该值会覆盖标签内定义的日期范围
    'closeFn': function(oInput){ 
        var dDeliverDate = document.getElementById('dDeliverDate');
        dDeliverDate.value = oInput.value;
    } 
});

function validate(){
    var form = document.getElementById('req-form');
    var sName = form.sName.value;
    var TypeID = form.TypeID.value;
    var sContent = form.sContent.value;
    var sBudget = form.sBudget.value;
    var dDeliverDate = form.dDeliverDate.value;
    var sPhone = form.sPhone.value;
    if(sName==''){
        $.toast("需求概况不能为空", "text");
        return false;
    }
    if(TypeID==''){
        $.toast("请选择委托的类型", "text");
        return false;
    }
    if(sContent==''){
        $.toast("请填写您的需求描述", "text");
        return false;
    }
    if(sBudget==''){
        $.toast("请输入金额", "text");
        return false;
    }
    if(dDeliverDate==''){
        $.toast("请选择日期", "text");
        return false;
    }
    if(sPhone==''){
        $.toast("请输入手机号", "text");
        return false;
    }
    return true;
}

$(function(){
    $('#req-form').on('submit',function(){
        if(!validate()){
            return false;
        }
        $.post('/requirement/formsave',$('#req-form').serialize(),function(res){
            console.log(res);
        })
        return false;
    })
    $('#send-code').on('click',function(){
        var text = $(this).text(),tOut,that=this,sPhone=$('#sPhone').val();
        if(sPhone==''){
            alert('请输入手机号');
            return false;
        }
        if(text=='发送验证码'){
            var time = 15;
            $(that).text(time+'s后重发').css('color','#999');
            tOut = setInterval(function(){
                --time;
                $(that).text(time+'s后重发');
                if(time<=0){
                    $(that).text('发送验证码').css('color','#2d8cf8');
                    clearInterval(tOut);
                }
            },1000)
            $.post('/requirement/smscode',{sMobile:sPhone},function(res){
                if(res){
                    $.toast(res.msg, "text");
                }else{
                    $.toast('发送失败', "text");
                }
            })
        }else{
            return false;
        }
    })
})
</script>    
</body>
</html>
