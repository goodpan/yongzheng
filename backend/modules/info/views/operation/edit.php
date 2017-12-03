<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/19
 * Time: 10:27
 */
    $this->title="编辑证件"
?>
    <div class="breadcrumb">
    <span class="layui-breadcrumb" lay-separator="-">
        <a href="">首页</a>
        <a href="">证件列表</a>
        <a href="">编辑证件</a>
    </span>
    </div>
    <blockquote class="layui-elem-quote">
        <h6>操作提示</h6>
        <p>网站系统角色, 由总平台设置管理.</p>
    </blockquote>

    <form class="layui-form" action="/info/operation/add" id="addForm">
        <input type="hidden" name="cred_id" value="<?=$cred['cred_id']?>">
        <div class="layui-form-item">
            <label class="layui-form-label">证件类别<em>*</em></label>
            <div class="layui-input-block">
                <select name="cate_id" lay-verify="required" value="<?=$cred['cate_id']?>">
                    <option value="">请选择证件类别</option>';
                    <?php foreach ($cateList as $k => $cate): ?>
                        <option value="<?php echo $cate['id']; ?>" data-level="<?php echo $cate['level']?>" <?=$cate['id']==$cred['cate_id']?'selected':''?>><?php echo str_repeat('-', 4*$cate['level']).$cate['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">证件名称<em>*</em></label>
            <div class="layui-input-block">
                <input type="text" name="cred_name" lay-verify="required" autocomplete="off" placeholder="请输入证件名称" class="layui-input" value="<?=$cred['cred_name']?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">封面图</label>
            <div class="layui-input-block">
                <button type="button" class="layui-btn" id="test1">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <div class="preview" id="preview">
                    <img src="<?=$cred['cover']?>" alt="" width="100" height="100">
                </div>
                <input type="hidden" name="cover" id="cover" value="<?=$cred['cover']?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否热门</label>
            <div class="layui-input-block">
                <input type="checkbox" name="is_hot" lay-skin="switch" lay-text="是|否" value="<?=$cred['is_hot']?>" checked>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea name="descr" placeholder="请输入内容" class="layui-textarea" value="<?=$cred['descr']?>"><?=$cred['descr']?></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">申请条件</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" name="condition" lay-verify="condition" id="editor_condition" value="<?=$cred['condition']?>"><?=$cred['condition']?></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">申请材料</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" name="material" lay-verify="material" id="editor_material" value="<?=$cred['material']?>"><?=$cred['material']?></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">费用</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" name="cost" lay-verify="cost" id="editor_cost" value="<?=$cred['cost']?>"><?=$cred['cost']?></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">申办地点</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" name="locale" lay-verify="locale" id="editor_locale" value="<?=$cred['locale']?>"><?=$cred['locale']?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="add">确认提交</button>
                <a class="layui-btn" data-type="cancel" href="javascript:window.history.go(-1)">取消</a>
            </div>
        </div>
    </form>

<?php $this->beginBlock('jsblock')?>
    <script>
        //图片上传预览
        function showPreview(imgSrc) {
            var prevElm = document.getElementById('preview');
            prevElm.innerHTML = '';
            var img = document.createElement('img');
            img.src = imgSrc;
            img.width="100";
            img.height = "100";
            prevElm.appendChild(img);
        }
        layui.use(['form', 'layedit', 'laydate','upload'], function(){
            var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,laydate = layui.laydate
                ,upload = layui.upload;
            //创建一个编辑器
            var editIndex1 = layedit.build('editor_condition');
            var editIndex2 = layedit.build('editor_material');
            var editIndex3 = layedit.build('editor_cost');
            var editIndex4 = layedit.build('editor_locale');

            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,url: '/info/operation/upload' //上传接口
                ,field:'UploadForm[credFile]'//这个名称很重要
                ,done: function(res){
                    //上传完毕回调
                    var imgSrc = res&&res.data&&res.data.src;
                    var coverElm = document.getElementById('cover');
                    cover.value = imgSrc;
                    showPreview(imgSrc);
                }
                ,error: function(){
                    //请求异常回调
                }
            });

            form.verify({
                condition: function(value){
                    layedit.sync(editIndex1);
                },
                material:function (value) {
                    layedit.sync(editIndex2);
                },
                cost:function (value) {
                    layedit.sync(editIndex3);
                },
                locale:function (value) {
                    layedit.sync(editIndex4);
                }
            });

            //监听提交
            form.on('submit(add)', function(data){
                $.post('/info/operation/edit',data.field,function (res) {
                    if(res.code == 0){
                        layer.alert(res.msg);
//                        window.location.reload();
                    }else{
                        layer.alert(res.error);
                    }
                })
                return false;
            });
        })
    </script>
<?php $this->endBlock('jsblock') ?>