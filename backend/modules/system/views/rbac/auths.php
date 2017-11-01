<?php
$this->title = '权限列表';
?>
    <div class="breadcrumb">
        <span class="layui-breadcrumb" lay-separator="-">
            <a href="">首页</a>
            <a href="">权限列表</a>
        </span></div>
        <blockquote class="layui-elem-quote">
  <h6>操作提示</h6>
  <p>网站系统角色, 由总平台设置管理.</p>
  </blockquote>
<div class="layui-btn-group">
  <a class="layui-btn" data-type="" href="/system/rbac/auth_add"><i class="layui-icon">&#xe608;</i>添加权限</a>
  <button class="layui-btn" data-type=""><i class="layui-icon">&#xe640;</i>删除选中</button>
</div>
<table class="layui-table" lay-data="{url:'/system/rbac/auth_page', page:true}" lay-filter="demo">
  <thead>
    <tr>
      <th lay-data="{checkbox:true}"></th>
      <th lay-data="{field:'auth_id', width:100, sort: true}">权限ID</th>
      <th lay-data="{field:'auth_name', width:150}">权限名</th>
      <th lay-data="{field:'auth_m', width:150}">模块名称</th>
      <th lay-data="{field:'auth_c', width:150}">控制器名称</th>
      <th lay-data="{field:'auth_a', width:150}">方法名称</th>
      <th lay-data="{field:'auth_pid', width:100}">上级权限的ID，0：代表顶级权限</th>
      <th lay-data="{field:'create_time', width:160}">创建时间</th>
      <th lay-data="{fixed: 'right', width:200, align:'center', toolbar: '#toolbar'}">操作</th>
    </tr>
  </thead>
</table>
 
<script type="text/html" id="toolbar">
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
    if(obj.event === 'del'){
      layer.confirm('真的删除行么', function(index){
        obj.del();
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
      var auth_id = data['auth_id'];
      location.href = '/system/rbac/auth_edit?auth_id='+auth_id;
    }
  });
  
  var $ = layui.$, active = {
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
  
  $('.demoTable .layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });
});
</script>
<?php $this->endBlock('jsblock') ?>