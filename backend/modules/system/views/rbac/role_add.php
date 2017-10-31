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
</style>

<div class="breadcrumb">
    <span class="layui-breadcrumb" lay-separator="-">
        <a href="/console/overview/index">首页</a>
        <a href="/system/rbac/roles">角色管理</a>
        <a href="/system/rbac/role_add">添加角色</a>
    </span>
</div>

<div class="form-wrap"></div>
<form class="layui-form" action="">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>角色信息</legend>
</fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">角色名称</label>
    <div class="layui-input-block">
      <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">角色描述</label>
    <div class="layui-input-block">
      <textarea placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div>
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>权限分配</legend>
</fieldset>
<div class="layui-form-item" pane="">
    <div class="label-title">
        <label class="layui-form-label"></label>
        <!-- <input type="checkbox" name="like1[write]" title="全部" lay-skin="primary"> -->
    </div>
    <div class="layui-input-block input-group">
    <?php foreach ($auth_list as $k => $v): ?>
      <span style="color:#e3e3e3;"><?php echo str_repeat('_', $v['level'] * 4); ?></span>
       <input lay-skin="primary" level="<?=$v['level']?>" type="checkbox" name="auth_id[]" value="<?=$v['auth_id']?>" title="<?=$v['auth_name']?>"><br>
    <?php endforeach; ?>
    </div>
</div>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
</fieldset>
<div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="demo1">确认提交</button>
      <a class="layui-btn" data-type="cancel" href="javascript:window.history.go(-1)">取消</a>
    </div>
</div>
</form>
</div>
<?php $this->beginBlock('jsblock')?>  
<script>
layui.use('form', function(){
  var $ = layui.$, active = {
    
  };
  
  $('.layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });
});
</script>
<?php $this->endBlock('jsblock') ?>