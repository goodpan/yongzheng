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
            <button type="submit" class="btn-entry" id="regist">注册</button>
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
            var sMobile = $('#reg-form').find('input[name="sMobile"]').val();
            var that = $(this);
            $.post('/member/registcode',{sMobile:sMobile},function(res){
                console.log(111)
            })
        })
        $('#reg-form').on('submit',function(){
            var phoneVal = this.sMobile.value;
            var codeVal = this.sCode.value;
            var passVal = this.sPassWord.value;
            var rePassVal = this.sRePassWord.value;
            if(phoneVal==''){
                alert('手机号不能为空');
                return false;
            }
            if(codeVal==''){
                alert('验证码不能为空');
                return false;
            }
            if(passVal==''){
                alert('密码不能为空');
                return false;
            }
            if(rePassVal==''){
                alert('请再次输入密码');
                return false;
            }
            if(passVal!==rePassVal){
                alert('两次密码不一致');
                return false;
            }
            $.post('/member/registpost',$(this).serialize(),function(res){
                console.log(res)
            })
            return false;
        })
    })
</script>
<?php $this->endBlock('jsblock')?>

