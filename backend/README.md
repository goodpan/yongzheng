# 后台框架说明
## layui框架
### 基本用法
> 引用文件，在assets的AppAsset.php中设置
* css   'css/common.css','css/layui.css',
* js    'layui.js'或者'layui.all.js'
> 初始化
``` bash
<script>
//一般直接写在一个js文件中
layui.use(['layer', 'form'], function(){
  var layer = layui.layer,form = layui.form;
  layer.msg('Hello World');
});
</script> 

```
### 弹框
* 确认框
``` bash
layer.confirm('真的删除行么', function(index){
  obj.del();
  layer.close(index);
});
```
* 消息框
``` bash
layer.msg('Hello World');
```
### 按钮
``` bash
<a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
<a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
<a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>

<div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="demo1">确认提交</button>
      <a class="layui-btn" data-type="cancel" href="/system/rbac/roles">取消</a>
    </div>
</div>
```

### 表格
``` bash
  <div class="breadcrumb">
        <span class="layui-breadcrumb" lay-separator="-">
            <a href="">首页</a>
            <a href="">角色列表</a>
        </span>
    </div>
    <blockquote class="layui-elem-quote">
      <h6>操作提示</h6>
      <p>网站系统角色, 由总平台设置管理.</p>
    </blockquote>
<div class="layui-btn-group roles-table">
  <a class="layui-btn" href="/system/rbac/role_add"><i class="layui-icon">&#xe608;</i>添加角色</a>
  <button class="layui-btn" data-type="delAll"><i class="layui-icon">&#xe640;</i>删除选中</button>
</div>
<table class="layui-table" lay-data="{url:'/system/rbac/roledata', page:true, id:'roles'}" lay-filter="demo">
  <thead>
    <tr>
      <th lay-data="{checkbox:true}"></th>
      <th lay-data="{field:'id', width:100, sort: true}">角色ID</th>
      <th lay-data="{field:'name', width:180}">角色名</th>
      <th lay-data="{field:'description', width:360}">角色描述</th>
      <th lay-data="{field:'create_time', width:360}">创建时间</th>
      <th lay-data="{fixed: 'right', width:200, align:'center', toolbar: '#toolbar'}">操作</th>
    </tr>
  </thead>
</table>
 
<script type="text/html" id="toolbar">
  <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
  <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
<?php $this->beginBlock('jsblock')?>         
<script>
layui.use('table', function(){
  var table = layui.table;
  //监听表格复选框选择
  table.on('checkbox(demo)', function(obj){
    console.log(obj)
  });
  //监听工具条
  table.on('tool(demo)', function(obj){
    var data = obj.data;
    if(obj.event === 'detail'){
      layer.msg('ID：'+ data.id + ' 的查看操作');
    } else if(obj.event === 'del'){
      layer.confirm('真的删除行么', function(index){
        obj.del();
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
      layer.alert('编辑行：<br>'+ JSON.stringify(data))
    }
  });
  
  var $ = layui.$, active = {
    delAll:function(){
        layer.confirm('是否确认删除?', {icon: 3, title:'提示'}, function(index){
            layer.close(index);
        });
    },
    getCheckData: function(){ //获取选中数据
      var checkStatus = table.checkStatus('roles')
      ,data = checkStatus.data;
      layer.alert(JSON.stringify(data));
    }
    ,getCheckLength: function(){ //获取选中数目
      var checkStatus = table.checkStatus('roles')
      ,data = checkStatus.data;
      layer.msg('选中了：'+ data.length + ' 个');
    }
    ,isAll: function(){ //验证是否全选
      var checkStatus = table.checkStatus('roles');
      layer.msg(checkStatus.isAll ? '全选': '未全选')
    }
  };
  
  $('.roles-table .layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });
});
</script>
<?php $this->endBlock('jsblock') ?>
```


## yii2
### 基类

### 配置

### 模块

### 控制器

### model

### view
#### 布局
布局文件根据模块进行分类，每个模块下拥有一套布局。如在layout下：system.php、info.php


## 待优化项目
### 控制台缓存
控制台查询的相关信息可以做缓存，变更较少
