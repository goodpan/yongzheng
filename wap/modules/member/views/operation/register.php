<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Date: 2017/11/14 
 * Time: 下午 15:00
 */
$this->title = "注册";

?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/regist.css">
<?php $this->endBlock('cssblock')?>
<div class="entry-main">
    <div class="tt-wrap">
        <h2 class="tt-con">IT空间</h2>
        <div class="tt-m">靠谱的技术众包平台</div>
    </div>
    <form class="form-body" id="reg-form">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
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
            <div class="btn-entry" id="regist">注册</div>
        </div>
        <div class="form-intr">
        点击注册表示阅读并同意<a href="/member/operation/protocol" class="link">《IT空间注册协议》</a>
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
                var url = '<?=\Yii::$app->request->hostInfo?>'+"/member/operation/registcode";
                var _csrf = '<?= Yii::$app->request->getCsrfToken()?>';
                $.post(url,{sMobile:sMobile,_csrf:_csrf},function (data) {
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

        $('#regist').on('click',function(){
            var form = $('#reg-form')[0];
            var phoneVal = form.sMobile.value;
            var codeVal = form.sCode.value;
            var passVal = form.sPassWord.value;
            var rePassVal = form.sRePassWord.value;
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
            if(passVal.length<6){
                $.toast('密码至少6位', "text");
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
            var url = '<?=\Yii::$app->request->hostInfo?>'+"/member/operation/registpost";

            $.post(url,$(form).serialize(),function(data){
                if(data.status){
                    $.toast(data.msg, "text");
                    location.href = '<?=\Yii::$app->request->hostInfo?>/member/operation/login';
                }else {
                    $.toast(data.msg, "text");
                }

            },'json');

        });
    })
</script>
<?php $this->endBlock('jsblock')?>

