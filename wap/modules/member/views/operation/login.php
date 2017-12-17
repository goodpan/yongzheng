<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Date: 2017/11/14 
 * Time: 下午 15:00
 */
$this->title = "登录";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/login.css">
<?php $this->endBlock('cssblock')?>
<div class="entry-main">
    <div class="tt-wrap">
        <h2 class="tt-con">IT空间</h2>
        <div class="tt-m">靠谱的技术众包平台</div>
    </div>
    <form class="form-body" id="login-form">
        <div class="form-main">
            <div class="form-item">
                <i class="inp-icon mobile"></i>
                <input type="text" name="sMobile" class="inp" placeholder="输入手机号码">
            </div>
            <div class="form-item">
                <i class="inp-icon pass"></i>
                <input type="password" name="sPassWord" class="inp" placeholder="请输入密码" id="pass">
                <span class="icon eye" id="eye">&#xe8de;</span>
            </div>
        </div>
        <div class="bt">
            <a href="/member/operation/register" class="btn-reg">新用户注册</a>
            <a href="/member/operation/forgetpwd" class="btn-fogot">忘记密码？</a>
        </div>
        <div class="btn-wrap">
            <button type="submit" class="btn-entry" id="login">登录</button>
        </div>
    </form>
</div>

<?php $this->beginBlock('jsblock')?>
<script>
    $(function(){
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

        $('#login-form').on('submit',function(){
            var phoneVal = this.sMobile.value;
            var passVal = this.sPassWord.value;
            if(phoneVal==''){
                $.toast('手机号不能为空', "text");
                return false;
            }
            if(passVal==''){
                $.toast('密码不能为空', "text");
                return false;
            }
            var url = '<?=\Yii::$app->request->hostInfo?>'+"/member/operation/loginpost";

            $.post(url,$(this).serialize(),function(data){
               if(data.status){
                   $.toast(data.msg, "text");
                   location.href = '<?=\Yii::$app->request->hostInfo?>/member/space/index';
               }else {
                   $.toast(data.msg, "text");
               }
            },'json');
            return false;
        })
    })
</script>
<?php $this->endBlock('jsblock')?>

