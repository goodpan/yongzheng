<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title="修改密码";
?>
<?php $this->beginBlock('sitebar')?>
<style>
.form-wrapper{
    width:100%;
    height:100%;
}
.with-sidebar{
    float:left;
    width:50%;
}
.form-sidebar{
    border-left:1px solid #e3e3e3;
    float:left;
    width:40%;
    height:100%;
    padding:30px;
}
.form-sidebar p{
    line-height:2;
    color:#666;
}
.tip-title{
    font-size:18px;
    font-weight:700;
    color:#666;
    margin-bottom:20px;
}
</style>
<!-- 左侧导航区域（可配合layui已有的垂直导航） -->
<ul class="layui-nav layui-nav-tree"  lay-filter="test">
    <li class="layui-nav-item layui-this">
        <a class="" href="javascript:;">修改密码</a>
    </li>
</ul>
<?php $this->endBlock('sitebar')?>
    <!-- main container -->
                <div class="form-wrapper">
                    <!-- left column -->
                    <div class="with-sidebar">
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
                <?php echo $form->field($model, 'admin_user')->textInput(['class' => 'layui-input', 'disabled' => true]);?>
                </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码<em>*</em></label>
                    <div class="layui-input-block">
                <?php echo $form->field($model, 'admin_pass')->passwordInput(['class' => 'layui-input','placeholder'=>"请输入密码",'lay-verify'=>"required"]);?>
                </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">确认密码<em>*</em></label>
                    <div class="layui-input-block">
                <?php echo $form->field($model, 'repass')->passwordInput(['class' => 'layui-input','placeholder'=>"请再次输入密码",'lay-verify'=>"required"]);?>
                </div>
                </div>
                <div class="layui-form-item">
                <div class="layui-input-block pull-right">
                    <?php echo Html::submitButton('修改', ['class' => 'layui-btn','lay-submit'=>'', 'lay-filter'=>"*"]);?>
                    <?php echo Html::resetButton('取消', ['class' => 'layui-btn layui-btn-primary']);?>
                </div>
            </div>
                <?php ActiveForm::end();?>
                        </div>
                    <!-- side right column -->
                    <div class="form-sidebar pull-left">
                        <h6 class="tip-title">重要提示：</h6>
                        <p>请在左侧填写管理员相关信息，包括管理员账号，电子邮箱，以及密码,</p>
                        <p>管理员可以管理后台功能模块。</p>
                        <p>请谨慎修改!</p>
                    </div>
                </div>
    <!-- end main container -->

    <?php $this->beginBlock('jsblock')?>
    <script>
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

