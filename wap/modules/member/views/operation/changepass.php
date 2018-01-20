<?php
$this->title = "密码修改";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/changepass.css">
<?php $this->endBlock('cssblock')?>
    <form class="form-body" id="reg-form">
        <!--		如果有登录-->
        <?php if($user_id){?>
            <div class="form-main" id="cps-form">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <div class="form-item">
                        <i class="inp-icon pass"></i>
                        <input type="password" name="last_sPassWord" class="inp" placeholder="请输入原密码">
                        <span class="icon eye">&#xe8de;</span>
                    </div>
                    <div class="form-item">
                        <i class="inp-icon pass"></i>
                        <input type="password" name="sPassWord" class="inp"  placeholder="请输入密码">
                        <span class="icon eye">&#xe8de;</span>
                    </div>
                    <div class="form-item">
                        <i class="inp-icon pass"></i>
                        <input type="password" name="sRePassWord" class="inp"  placeholder="请再次输入密码">
                        <span class="icon eye">&#xe8de;</span>
                    </div>
                </div>

            <div class="btn-wrap">
                <div class="btn-entry" id="submit">提交</div>
            </div>
        <?php }?>
    </form>

<?php $this->beginBlock('jsblock')?>
    <script>
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
        $(function() {
            $('#submit').on('click',function(){
                var form = $('#reg-form')[0];
                var lastpassVal = form.last_sPassWord.value;
                var passVal = form.sPassWord.value;
                var rePassVal = form.sRePassWord.value;

                if(lastpassVal==''){
                    $.toast("旧密码不能为空", "text");
                    return false;
                }
                if(passVal==''){
                    $.toast("密码不能为空", "text");
                    return false;
                }
                if(lastpassVal.length<6 || passVal.length<6 || rePassVal.length<6){
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
                var url = '<?=\Yii::$app->request->hostInfo?>'+"/member/operation/changepass";
                $.post(url,{lastpassVal:lastpassVal,passVal:passVal,rePassVal:rePassVal},function(res){
                    if(res&&res.status>0){
                        $.toast("修改成功", function() {
                            location.href = '<?=\Yii::$app->request->hostInfo?>/member/space/index';
                        });
                    }else{
                        $.toast(res.msg,'text');
                    }
                },'json')
            })
        })
    </script>
<?php $this->endBlock('jsblock')?>