<?php
    $this->title="证件列表"
?>
<div class="breadcrumb">
    <span class="layui-breadcrumb" lay-separator="-">
        <a href="">首页</a>
        <a href="">证件列表</a>
    </span>
</div>
<div class="layui-tab">
  <ul class="layui-tab-title">
    <li class="layui-this">所有证件</li>
    <li>等待审核</li>
    <li>审核通过</li>
    <li>审核失败</li>
  </ul>
  <div class="layui-tab-content">
        <blockquote class="layui-elem-quote">
            <h6>所有证件操作提示</h6>
            <p>网站系统角色, 由总平台设置管理.</p>
        </blockquote>
    <div class="layui-tab-item layui-show">
        <table class="layui-table" lay-data="{url:'/system/rbac/roledata', page:true, id:'roles'}" lay-filter="demo">
            <thead>
                <tr>
                <th lay-data="{checkbox:true}"></th>
                <th lay-data="{field:'id', width:100, sort: true}">ID</th>
                <th lay-data="{field:'name', width:180}">分类名称</th>
                <th lay-data="{field:'description', width:360}">类型</th>
                <th lay-data="{field:'create_time', width:360}">创建时间</th>
                <th lay-data="{fixed: 'right', width:200, align:'center', toolbar: '#toolbar'}">操作</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="layui-tab-item">
        等待审核
    </div>
    <div class="layui-tab-item">审核通过</div>
    <div class="layui-tab-item">审核失败</div>
  </div>
</div>
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
})
</script>
<?php $this->endBlock('jsblock') ?>
