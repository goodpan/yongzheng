<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加信息管理员表单</title>
    <link href="/css/layui.css" rel="stylesheet">
    <style>
        .custom-form {
            padding: 20px 20px 20px 0;
        }
        .pull-right{
            float:right;
        }
        .help-block-error {
            color: #ff0000;
        }
        .layui-form-label em{
            color: #ff0000;
        }
    </style>
</head>

<body>
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
               <?php echo $form->field($model, 'admin_user')->textInput(['class' => 'layui-input','placeholder'=>"请输入管理员账号",'lay-verify'=>"required"]); ?>
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
            <label class="layui-form-label">重复密码<em>*</em></label>
            <div class="layui-input-block">
                <?php echo $form->field($model, 'repass')->passwordInput(['class' => 'layui-input','placeholder'=>'请输入管理员密码','autocomplete'=>'off', 'lay-verify'=>"required"]); ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属角色<em>*</em></label>
            <div class="layui-input-block">
            <select name="">
                <option value=""></option>
                <option value="0">北京</option>
                <option value="1">上海</option>
                <option value="2">广州</option>
                <option value="3">深圳</option>
                <option value="4">杭州</option>
            </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block pull-right">
                <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    <script src="/layui.js"></script>
    <script>
        layui.use(['form', 'layer'], function() {
            var form = layui.form;
            var layer = layui.layer;
            <?php
                if (\Yii::$app->session->hasFlash('info')) {
                    echo 'layer.msg("'.\Yii::$app->session->getFlash('info').'");parent.location.reload();';
                }
            ?>
        });
    </script>
</body>

</html>