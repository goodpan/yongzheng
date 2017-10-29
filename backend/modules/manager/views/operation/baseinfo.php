<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;
    $this->title="基本信息";
?>

<?php $this->beginBlock('sitebar')?>
<!-- 左侧导航区域（可配合layui已有的垂直导航） -->
<ul class="layui-nav layui-nav-tree"  lay-filter="test">
    <li class="layui-nav-item layui-this">
        <a class="" href="javascript:;">基本信息</a>
    </li>
</ul>
<?php $this->endBlock('sitebar')?>
    <?php
        $form = ActiveForm::begin([
            'options' => ['class' => 'layui-form custom-form'],
            'fieldConfig' => [
                'template' => '{input}{error}'
            ],
        ]);
    ?>
        <div class="layui-form-item">
            <label class="layui-form-label">管理员账号<em>*</em></label>
            <div class="layui-input-block">
               <?php echo $form->field($model, 'admin_user')->textInput(['class' => 'layui-input','placeholder'=>"请输入管理员账号",'lay-verify'=>"required",'disabled'=>'']); ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">管理员邮箱<em>*</em></label>
            <div class="layui-input-block">
                <?php echo $form->field($model, 'admin_email')->textInput(['class' => 'layui-input','placeholder'=>'请输入管理员邮箱','autocomplete'=>'off', 'lay-verify'=>"required|email"]); ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码<em>*</em></label>
            <div class="layui-input-block">
                <?php echo $form->field($model, 'admin_pass')->passwordInput(['class' => 'layui-input','placeholder'=>'请输入管理员密码','autocomplete'=>'off', 'lay-verify'=>"required"]); ?>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block pull-right">
                <button class="layui-btn" lay-submit lay-filter="*">确认修改</button>
                <button type="reset" class="layui-btn layui-btn-primary" onclick="cancel()">取消</button>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    <?php $this->beginBlock('jsblock')?>
    <script>
        function cancel(){
            location.href = '<?=Url::to('/console/overview/index')?>';
        }
        layui.use(['form', 'layer'], function() {
            var form = layui.form;
            var layer = layui.layer;
            <?php
                if (\Yii::$app->session->hasFlash('info')) {
                    echo 'layer.msg("'.\Yii::$app->session->getFlash('info').'");';
                }
            ?>
        });
    </script>
    <?php $this->endBlock('jsblock') ?>