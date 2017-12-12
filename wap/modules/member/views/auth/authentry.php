<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Time: 2017年11月16日09:17:51
 */
$this->title = "开发者认证";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/auth.css">
    <style>
        body{
            background:#fff;
        }
        .form-label{
            background:#f2f3f4;
        }
    </style>
<?php $this->endBlock('cssblock')?>
<div class="entry-wrap">
    <a href="javascript:;" class="next" id="toNext">申请认证</a>
</div>
<!-- 记录是否存在 $bExist 1 存在 0 不存在-->
<? $bExist?>
<?php $this->beginBlock('jsblock')?>
<script>
    var isExist = '1';
    $(function(){
        $('#toNext').on('click',function(){
            if(isExist==0){
                $.toast('你已提交过申请，不可再次提交','text');
            }else{
                location.href = '/member/auth/authchoose';
            }
        })
    })
    
    
</script>
<?php $this->endBlock('jsblock')?>