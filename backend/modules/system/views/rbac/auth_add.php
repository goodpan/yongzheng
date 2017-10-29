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
                    <?php
                        if(!$auths){
                            echo '<option value="0">顶级权限</option>';
                        }
                        foreach ($auths as $auth){
                            echo '<option value="'.$auth['auth_id'].'">'.$auth['auth_name'].'</option>';
                        }
                    ?>
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
                <input type="text" name="auth_a" lay-verify="" autocomplete="off" placeholder="请输入标题" class="layui-input">
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
                    console.log(res)
                    if(res){
                        layer.alert(JSON.stringify(res.msg));
                    }else{
                        layer.alert('服务器错误');
                    }
                })
                return false;
            });
        });
    </script>
<?php $this->endBlock('jsblock') ?>