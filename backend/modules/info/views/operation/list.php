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
        <div class="layui-btn-group">
            <a class="layui-btn" data-type="" href="/info/operation/add"><i class="layui-icon">&#xe608;</i>添加证件</a>
            <button class="layui-btn" data-type=""><i class="layui-icon">&#xe640;</i>删除选中</button>
        </div>
        <table class="layui-table" lay-data="{url:'/info/operation/list', page:true, id:'cred_list'}" lay-filter="cred_list">
            <thead>
                <tr>
                <th lay-data="{checkbox:true}"></th>
                <th lay-data="{field:'cred_id', width:100, sort: true}">证件ID</th>
                <th lay-data="{field:'cred_name', width:180}">证件名称</th>
                <th lay-data="{field:'name', width:360}">证件类型</th>
                <th lay-data="{field:'descr', width:360}">证件描述</th>
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
