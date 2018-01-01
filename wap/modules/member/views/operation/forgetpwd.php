<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Date: 2017/11/14 
 * Time: 下午 15:00
 */
$this->title = "找回密码";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/regist.css">
<?php $this->endBlock('cssblock')?>
<div class="entry-main">
    <div class="tt-wrap">
        <h2 class="tt-con">IT空间</h2>
        <div class="tt-m">靠谱的技术众包平台</div>
    </div>
    <form class="form-body" id="reg-form" >
        <div class="form-main">
            <div class="form-item">
                <i class="inp-icon mobile"></i>
                <input type="text" name="sMobile" class="inp" placeholder="输入手机号码">
            </div>
            <div class="form-item">
                <i class="inp-icon code"></i>
                <input type="text" name="sCode" class="inp" placeholder="请输入验证码">
                <span class="send" id="send">发送验证码</span>
            </div>
            <div class="form-item">
                <i class="inp-icon pass"></i>
                <input type="password" name="sPassWord" class="inp" placeholder="请输入密码">
                <span class="icon eye">&#xe8de;</span>
            </div>
            <div class="form-item">
                <i class="inp-icon pass"></i>
                <input type="password" name="sRePassWord" class="inp" placeholder="请再次输入密码">
                <span class="icon eye">&#xe8de;</span>
            </div>
        </div>
        <div class="btn-wrap">
            <button type="submit" class="btn-entry" id="regist">确认</button>
        </div>
    </form>
</div>

<?php $this->beginBlock('jsblock')?>
<script>
    $(function(){
        //查看密码
        $('.eye').on('click',function(){
            var inp = $(this).siblings('.inp');
            var type =  inp.attr('type');
            if(type=="text"){
                inp.attr('type','password');
                $(this).removeClass('eye-open');
            }else{
                inp.attr('type','text');
                $(this).addClass('eye-open');
            }
        });
        //发送验证码
        $('#send').on('click',function(){
            var text = $(this).text(),
                tOut, that = this,
                sMobile = $('#reg-form').find('input[name="sMobile"]').val();

            if(sMobile == ''){
                $.toast("请输入手机号", "text");
                return false;
            }
            if(!/^1\d{10}$/.test(sMobile)){
                $.toast("手机号有误", "text");
                return false;
            }
            if(text == '发送验证码'){
                var time = 30;
                $(that).text(time + 's后重发').css('color', '#999');
                tOut = setInterval(function () {
                    --time;
                    $(that).text(time + 's后重发');
                    if(time <= 0){
                        $(that).text('发送验证码').css('color','#2d8cf8');
                        clearInterval(tOut);
                    }
                },1000);
                var url = '<?=\Yii::$app->request->hostInfo?>'+"/member/operation/sendstcode";
                var _csrf = '<?= Yii::$app->request->getCsrfToken()?>';
                var sType = 'RetrievePwd';
                $.post(url,{sMobile:sMobile,sType:sType,_csrf:_csrf},function (data) {
                    if(data&&data.status>0){
                        $.toast(data.msg, "text");
                    }else{
                        $.toast(data.msg, "text");
                    }
                },'json');
            }else {
                return false;
            }
        });
        //提交
        $('#reg-form').on('submit',function(){
            var phoneVal = this.sMobile.value;
            var codeVal = this.sCode.value;
            var passVal = this.sPassWord.value;
            var rePassVal = this.sRePassWord.value;
            if(phoneVal==''){
                $.toast("手机号不能为空", "text");
                return false;
            }
            if(!/^1\d{10}$/.test(phoneVal)){
                $.toast("手机号有误", "text");
                return false;
            }
            if(codeVal==''){
                $.toast("验证码不能为空", "text");
                return false;
            }
            if(passVal==''){
                $.toast("密码不能为空", "text");
                return false;
            }
            if(rePassVal==''){
                $.toast("请再次输入密码", "text");
                return false;
            }
            if(passVal!==rePassVal){
                $.toast("两次密码不一致", "text");
                return false;
            }

            var url = '<?=\Yii::$app->request->hostInfo?>'+"/member/operation/forgetpost";
            $.post(url,$(this).serialize(),function(res){
                if(res.status){
                    $.toast(res.msg, "text");
                    setTimeout(function () {
                        location.href = '<?=\Yii::$app->request->hostInfo?>/member/operation/login';
                    },500);

                }else {
                    $.toast(res.msg, "text");
                }
            },'json');
            return false;
        })
    })
</script>
<?php $this->endBlock('jsblock')?>

