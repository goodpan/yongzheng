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
      layer.msg('ID：'+ data.role_id + ' 的查看操作');
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