<?php
    $this->title="证件分类列表"
?>
<div class="breadcrumb">
    <span class="layui-breadcrumb" lay-separator="-">
        <a href="">首页</a>
        <a href="">证件分类列表</a>
    </span>
</div>
<blockquote class="layui-elem-quote">
    <h6>所有证件操作提示</h6>
    <p>网站系统角色, 由总平台设置管理.</p>
</blockquote>
<div class="layui-btn-group">
    <a class="layui-btn" data-type="" href="/info/classify/add"><i class="layui-icon">&#xe608;</i>新增分类</a>
  <button class="layui-btn" data-type=""><i class="layui-icon">&#xe640;</i>删除选中</button>
</div>
<table class="layui-table" lay-data="{url:'/info/classify/list', page:true, id:'cate'}" lay-filter="cate">
    <thead>
        <tr>
        <th lay-data="{checkbox:true}"></th>
        <th lay-data="{field:'id', width:100, sort: true}">分类ID</th>
        <th lay-data="{field:'pid', width:100, sort: true}">上级ID</th>
        <th lay-data="{field:'name', width:180}">角色名</th>
        <th lay-data="{field:'create_time', width:360}">创建时间</th>
        <th lay-data="{field:'degree', width:360}">分类等级</th>
        <th lay-data="{fixed: 'right', width:200, align:'center', toolbar: '#toolbar'}">操作</th>
        </tr>
    </thead>
</table>
<?php $this->beginBlock('cssblock')?>
    <link src="">
<?php $this->endBlock('cssblock') ?>
<?php $this->beginBlock('jsblock')?>
<script type="text/html" id="toolbar">
  <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
  <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
<script>
layui.use('table', function(){
  var table = layui.table;
    //监听工具条
    table.on('tool(tools)', function(obj){
    var data = obj.data;
    if(obj.event === 'detail'){
      layer.msg('ID：'+ data.id + ' 的查看操作');
    } else if(obj.event === 'del'){
      layer.confirm('真的删除行么', function(index){
          $.get('/info/classify/del',{id:data.id},function (res) {
              if(res.code>0){
                  obj.del();
                  layer.alert(res.msg);
              }else{
                  layer.alert(res.error);
              }
          },'json')
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
      layer.alert('编辑行：<br>'+ JSON.stringify(data))
    }
  });
})
</script>
<?php $this->endBlock('jsblock') ?>

