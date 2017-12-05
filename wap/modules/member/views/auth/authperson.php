<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Date: 2017/11/14
 * Time: 下午 15:00
 */
$this->title = "IT人才认证";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/lib/ydui.css">
    <link rel="stylesheet" type="text/css" href="/css/member/auth.css">
    <style>
        body{
            background:#fff;
        }
        .form-label{
            background:#f2f3f4;
        }
    </style>
<?php $this->endBlock('cssblock')?>
<div class="auth-main">
    <form class="form-base" id="form-auth">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
        <input type="hidden" name="ApplyTypeID" value="">
        <div class="step-wrap step1 current-form">
            <div class="form-label">2.请填写个人信息</div>
            <div class="form-auth">
                <div class="form-auth-item">
                    <label for="" class="item-label">真实姓名</label>
                    <div class="item-elm">
                    <input type="text" name="sRealName" class="item-inp" placeholder="请输入您的真实姓名"></div>
                </div>
                <div class="form-auth-item">
                    <label for="" class="item-label">职能</label>
                    <div class="item-elm">
                        <select name="FunctionID" id="" class="item-sl">
                        <option value="">请选择</option>
                        
                    </select></div>
                </div>
                <div class="form-auth-item">
                    <label for="" class="item-label">擅长领域</label>
                    <div class="item-elm">
                        <select name="TypeID" id="" class="item-sl">
                        <option value="">请选择</option>
                        
                    </select></div>
                </div>
                <div class="form-auth-item">
                    <label for="" class="item-label">擅长技能</label>
                    <div class="item-elm">
                        <select name="SkillID" id="" class="item-sl">
                        <option value="">请选择</option>
                      
                    </select></div>
                </div>
                <div class="form-auth-item">
                    <label for="" class="item-label">所在地</label>
                    <div class="item-elm">
                    <input type="text" readonly id="J_Address" class="c_area flexOne" name="sAdress" placeholder="请选择">
                    </div>
                </div>
                <div class="form-auth-item">
                    <label for="" class="item-label">工作经验</label>
                    <div class="item-elm">
                        <select name="sWorkYear" id="" class="item-sl">
                        <option value="">请选择</option>
                        
                    </select>
                </div>
                </div>
                <div class="btn-wrap">
                    <button type="button" class="btn-entry" id="next">下一步</button>
                </div>
            </div>
        </div>
        <div class="step-wrap step2">
            <div class="form-label">3.请上传身份证</div>
            <div class="layer-con">
                <div class="form-layer">
                    <div class="form-card-tt">身份证正面</div>
                    <div class="card-upload upload1">
                        <input type="hidden" name="sCardFront">
                        <input type="file" id="frontend">
                    </div>
                </div>
                <div class="form-layer">
                    <div class="form-card-tt">身份证背面</div>
                    <div class="card-upload upload2">
                        <input type="hidden" name="sCardBackend">
                        <input type="file" name="sCardBackend" id="backend">
                    </div>
                </div>
            </div>
            <div class="btn-wrap1">
                <button type="button" class="btn-entry" id="complete">完成</button>
            </div>
        </div>
    </form>
</div>

<?php $this->beginBlock('jsblock')?>
<script src="/js/ydui.citys.js"></script>
<script src="/js/ydui.js"></script>
<script src="/js/lrz.all.bundle.js"></script>
<script>
    var pId = '22';
    //基础资料验证
    function validate1(){
        var form = document.getElementById('form-auth');
        if(form.sRealName.value==''){
            alert('请输入真实姓名')
            return false;
        }
        if(form.FunctionID.value==''){
            alert('请选择职能')
            return false;
        }
        if(form.TypeID.value==''){
            alert('请选择擅长领域')
            return false;
        }
        if(form.SkillID.value==''){
            alert('请选择擅长技能')
            return false;
        }
        if(form.sAdress.value==''){
            alert('请选择所在地')
            return false;
        }
        if(form.sWorkYear.value==''){
            alert('请选择工作经验')
            return false;
        }
        return true;
    }

    //图片验证
    function validate2(){
        var fileVal1 = $('#frontend').val();
        var fileVal2 = $('#backend').val();
        if(fileVal1==''){
            alert('请上传身份证正面照');
            return false;
        }
        if(fileVal2==''){
            alert('请上传身份证背面照');
            return false;
        }
        return true;
    }

    //省市联动
    function linkage(){
        //省市联动
        var $target = $('#J_Address');
        $target.citySelect();
        $target.on('click', function (event) {
            event.stopPropagation();
            //个性化 处理
            reScroll = $(window).scrollTop();
            $('html,body').addClass('forbidScroll');
            $target.citySelect('open');
        });
        $target.on('done.ydui.cityselect', function (ret) {
            $(this).val(ret.provance + ' ' + ret.city);
            var ProductID = pId;
            var sProvince = ret.provance;
            var sAdress = '';
            if (sProvince == "北京" || sProvince == "上海" || sProvince == "天津" || sProvince == "重庆") {
                    sAdress = sProvince;
                } else {
                    sAdress = ret.city;
                }
        });
    }
    $(function(){
        linkage();
        $('#next').on('click',function(){
            //验证
            if(!validate1()){
                return false;
            }
            $('.step1').removeClass('current-form');
            $('.step2').addClass('current-form');
        })

        $('#complete').on('click',function(){
            if(!validate2()){
                return false;
            }
            $.post('',$('#form-auth').serialize(),function(res){
                if(res&&res.status>0){
                    $.alert({
                        title: '温馨提示',
                        text: '提交成功，我们将在24小时内审核',
                        onOK: function () {
                            location.href = '/member/index';
                        }
                    });
                }else{
                    $.toast(res.msg, "text");
                }
            },'json')
            return false;
        })

        //上传证件
        $('.card-upload').find('input[type="file"]').on('change',function(){
            var that = this;
            lrz(this.files[0])
            .then(function (rst) {
                // 处理成功会执行
                $(that).parent().css('background-image','url('+rst.base64+')');
                $(that).siblings('input[type="hidden"]').val(rst.base64);
            })
            .catch(function (err) {
                // 处理失败会执行
            })
            .always(function () {
                // 不管是成功失败，都会执行
            });
        })
    })
</script>
<?php $this->endBlock('jsblock')?>