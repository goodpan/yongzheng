<?php
$this->title = '添加权限';
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
        .error{
            color:#ff0000;
        }
    </style>

    <div class="breadcrumb">
    <span class="layui-breadcrumb" lay-separator="-">
        <a href="/console/overview/index">首页</a>
        <a href="/system/rbac/auths">权限管理</a>
        <a href="/system/rbac/auth_add">添加权限</a>
    </span>
    </div>
    <blockquote class="layui-elem-quote">
        <h6>操作提示</h6>
        <p>网站系统角色, 由总平台设置管理.</p>
    </blockquote>
    <form class="layui-form" action="/system/rbac/auth_add">
        <div class="layui-form-item">
            <label class="layui-form-label">上级权限<em>*</em></label>
            <div class="layui-input-block">
                <select name="auth_pid" lay-verify="required">
                    <option value="">请选择上级权限</option>';
                    <option value="0">添加顶级权限</option>';
                    <?php foreach ($parentData as $k => $v): ?>						
                        <option value="<?php echo $v['auth_id']; ?>" data-level="<?php echo $v['level']?>"><?php echo str_repeat('&nbsp;', 4*$v['level']).$v['auth_name']; ?></option>
                    <?php endforeach; ?>	
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">权限名称<em>*</em></label>
            <div class="layui-input-block">
                <input type="text" name="auth_name" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">模块名<em>*</em></label>
            <div class="layui-input-block">
                <input type="text" name="auth_m" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">控制器名<em>*</em></label>
            <div class="layui-input-block">
                <input type="text" name="auth_c" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">方法名<em>*</em></label>
            <div class="layui-input-block">
                <input type="text" name="auth_a" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="auth_add">确认提交</button>
                <a class="layui-btn" data-type="cancel" href="javascript:window.history.go(-1)">取消</a>
            </div>
        </div>
    </form>
    </div>
<?php $this->beginBlock('jsblock')?>
    <script>
        layui.use('form', function(){
            var form = layui.form, $ = layui.$, layer = layui.layer, active = {

            };

            $('.layui-btn').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听提交
            form.on('submit(auth_add)', function(data){
                $.post('/system/rbac/auth_add',data.field,function (res) {
                    if(res.code>0){
                        layer.alert(res.msg);
                        window.location.reload()
                    }else{
                        layer.alert(res.error);
                    }
                })
                return false;
            });
        });
    </script>
<?php $this->endBlock('jsblock') ?>