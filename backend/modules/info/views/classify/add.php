<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/5
 * Time: 22:48
 */

$this->title = '新增商品分类';
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
        <a href="/info/classify/list">证件库</a>
        <a href="/info/classify/add">新增证件分类</a>
    </span>
    </div>
    <blockquote class="layui-elem-quote">
        <h6>操作提示</h6>
        <p>网站系统角色, 由总平台设置管理.</p>
    </blockquote>
    <form class="layui-form" action="/info/classify/add">
        <div class="layui-form-item">
            <label class="layui-form-label">上级分类<em>*</em></label>
            <div class="layui-input-block">
                <select name="p_data" lay-verify="required">
                    <option value="">请选择上级分类</option>';
                    <option value="0_0">添加顶级分类</option>';
                    <?php foreach ($cates as $k => $cate): ?>
                        <option value="<?php echo $cate->id."_".$cate->degree; ?>" data-level="<?php echo $cate->degree?>"><?php echo str_repeat('-', 4*$cate->degree).$cate->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分类名<em>*</em></label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
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
                $.post('/info/classify/add',data.field,function (res) {
                    if(res.code>0){
                        layer.alert(res.msg);
                        window.location.href='/info/classify/list';
                    }else{
                        layer.alert(res.error);
                    }
                })
                return false;
            });
        });
    </script>
<?php $this->endBlock('jsblock') ?>