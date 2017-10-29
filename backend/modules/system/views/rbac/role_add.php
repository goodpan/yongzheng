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
<?php $this->beginBlock('sitebar')?>
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class="layui-nav layui-nav-tree" lay-filter="test">
      <li class="layui-nav-item">
        <a class="" href="javascript:;">设置</a>
        <dl class="layui-nav-child">
          <dd><a href="javascript:;">网站设置</a></dd>
          <dd><a href="javascript:;">友情链接</a></dd>
          <dd><a href="javascript:;">短信设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item <?=$this->context->id == 'operation'?'layui-nav-itemed':''?>">
        <a href="javascript:;">管理员设置</a>
        <dl class="layui-nav-child">
          <dd class="<?=$this->context->action->id == 'managers'?'layui-this':''?>"><a href="/manager/operation/managers">管理员列表</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item <?=$this->context->id == 'rbac'?'layui-nav-itemed':''?>">
        <a href="javascript:;">权限管理</a>
        <dl class="layui-nav-child">
          <dd class="<?=$this->context->action->id == 'role_add'?'layui-this':''?>"><a href="/system/rbac/roles">角色管理</a></dd>
          <dd class="<?=$this->context->action->id == 'auths'?'layui-this':''?>"><a href="/system/rbac/auths">权限列表</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item">
        <a href="javascript:;">数据</a>
        <dl class="layui-nav-child">
          <dd><a href="javascript:;">清除缓存</a></dd>
          <dd><a href="javascript:;">数据备份</a></dd>
        </dl>
      </li>
    </ul>
<?php $this->endBlock('sitebar')?>
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
        <label class="layui-form-label">内容管理</label>
        <input type="checkbox" name="like1[write]" title="全部" lay-skin="primary">
    </div>
    <div class="layui-input-block input-group">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
    </div>
</div>
<div class="layui-form-item" pane="">
    <div class="label-title">
        <label class="layui-form-label">内容管理</label>
        <input type="checkbox" name="like1[write]" title="全部" lay-skin="primary">
    </div>
    <div class="layui-input-block input-group">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
      <input type="checkbox" name="like1[write]" title="广告列表" lay-skin="primary">
      <input type="checkbox" name="like1[read]" title="广告位管理" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章列表(文章管理)" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="文章分类" lay-skin="primary">
      <input type="checkbox" name="like1[game]" title="专题列表" lay-skin="primary">
    </div>
</div>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
</fieldset>
<div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="demo1">确认提交</button>
      <a class="layui-btn" data-type="cancel" href="/system/rbac/roles">取消</a>
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