<?php
$this->title = '添加角色';
?>
<style>
.label-title{
    float:left;
    width:200px;
}
.input-group{
    float:left;
    margin-left:0;
    width:80%;
}
.input-group .layui-form-checkbox{
    width:200px;
}
.input-group .layui-form-checkbox span{
    width:85%;
    padding:0;
}
.form-wrap .layui-form{
  padding-right:30px;
}
.sub-input-block{
  padding-left:50px;
}
.p-node{
    padding-left: 30px;
    margin-top: 10px;
}
.c-node{

}
</style>

<div class="breadcrumb">
    <span class="layui-breadcrumb" lay-separator="-">
        <a href="/console/overview/index">首页</a>
        <a href="/system/rbac/roles">角色管理</a>
        <a href="/system/rbac/role_add">添加角色</a>
    </span>
</div>

<div class="form-wrap"></div>
<form class="layui-form" action="" id="roleForm">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>角色信息</legend>
</fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">角色名称<em>*</em></label>
    <div class="layui-input-block">
      <input type="text" name="role_name" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">角色描述</label>
    <div class="layui-input-block">
      <textarea name="role_desc" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div>
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>权限分配<em style="color:#ff0000">*</em></legend>
</fieldset>
<?=$auth_list?>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
</fieldset>
<div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="role_add">确认提交</button>
      <a class="layui-btn" data-type="cancel" href="javascript:window.history.go(-1)">取消</a>
    </div>
</div>
</form>
</div>
<?php $this->beginBlock('jsblock')?>  
<script>
    $(function () {
        $('.p-node').on('click',function (e) {
            e.stopPropagation();
        })
    })
layui.use('form', function(){
  var $ = layui.$,form=layui.form,active = {
    
  };
//  form.on('checkbox(checkall)', function(data){
//    var isChecked = data.elem.checked;
//    var cbSubList = $(this).closest('.layui-form-item').find('.layui-input-block').find('input[type="checkbox"]');
//    var cbWrap =  $(this).closest('.layui-form-item').find('.layui-input-block').find('.layui-form-checkbox');
//    cbSubList.prop('checked',isChecked);
//    isChecked?cbWrap.addClass('layui-form-checked'):cbWrap.removeClass('layui-form-checked');
//  });
  form.on('checkbox(check)', function(data){
        console.log('aaa')
  });
  $('.layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });

  //监听提交
  form.on('submit(role_add)', function(data){
        var reqData = $('#roleForm').serialize();
         $.post('/system/rbac/role_add',reqData,function (res) {
             if(res.code>0){
                 layer.alert(res.msg);
                 window.location.reload();
             }else{
                 layer.alert(res.error);
             }
         })
        return false;
    });
});
</script>
<?php $this->endBlock('jsblock') ?>