<?php
/**
 * Created by PhpStorm.
 * User: chenwenzhen
 * Date: 2017/10/22
 * Time: 15:40
 */
?>
<link rel="stylesheet" type="text/css" href="/css/business.css">
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<div class="container">
    <div class="container-main">
        <div class="container-main-top">
            <h1 class="business-title">
                <? $status = 1;?>
                <? if ((isset($result))) { ?>
                    <? if ($result->status == 0) { ?>
                        <span class="title-text-2">审核中-重新提交可修改信息</span>
                    <? } elseif ($result->status == 1) {?>
                        <span class="title-text-2">抱歉，审核未通过，请重新提交</span>
                    <? } elseif ($result->status == 2) {
                        $status = '0'; ?>
                        <span class="title-text-2">您的信息正在被审核，请稍等</span>
                    <? } elseif ($result->status == 3) {
                        $status = '0'; ?>
                        <span class="title-text-2">恭喜您，您的信息审核通过</span>
                    <? }
                } else { ?>
                    <span class="title-text-1">商家入驻申请</span>
                <? } ?>
            </h1>
        </div>
        <div class="container-main-foot">
            <form id="submit-form">
                <div class="item-1">
                    <span>企业名称</span>
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> id="comp-name" name="comp-name" class="input-text"
                         value="<? echo isset($result) ? $result->comp_name : ''; ?>" placeholder="请输入企业名称">
                </div>
                <div id="comp-img" class="item-1">
                    <span>企业营业执照扫描件</span>
                    <img src="<? echo isset($result) ? $result->comp_img : '#'; ?>">
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> class="input-file" type="file">
                    <input id="comp-img-hidden" value="<? echo isset($result) ? $result->comp_img : '#'; ?>"
                           type="hidden" name="comp-img">
                </div>
                <div id="comp-comf-img" class="item-1">
                    <span>确认书扫描件</span>
                    <img src="<? echo isset($result) ? $result->comp_comf_img : '#'; ?>">
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> class="input-file" type="file" name="comp-comf-img">
                    <input id="comp-comf-img-hidden" value="<? echo isset($result) ? $result->comp_comf_img : '#'; ?>"
                           type="hidden" name="comp-comf-img">
                </div>
                <div class="item-1">
                    <span>姓名</span>
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> id="user-name" value="<? echo isset($result) ? $result->info_name : ''; ?>" type="text"
                         name="user-name" class="input-text"
                         placeholder="请输入真实姓名">
                </div>
                <div class="item-1">
                    <span>身份证号</span>
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> id="info-num" value="<? echo isset($result) ? $result->info_num : ''; ?>" name="info-num"
                         type="text" class="input-text" placeholder="请输入身份证号">
                </div>
                <div id="info-img" class="item-1">
                    <span>身份证正面照</span>
                    <img src="<? echo isset($result) ? $result->info_img : '#'; ?>">
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> class="input-file" type="file" name="info-img">
                    <input id="info-img-hidden" value="<? echo isset($result) ? $result->info_img : '#'; ?>"
                           type="hidden" name="info-img">
                </div>
                <div class="item-1">
                    <span>联系电话</span>
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> id="tel" class="input-text" value="<? echo isset($result) ? $result->tel : ''; ?>" name="tel"
                         placeholder="请输入联系电话">
                </div>
                <div class="item-1">
                    <span>邮箱</span>
                    <input <? if (!$status) {
                        echo 'disabled="disabled"';
                    } ?> id="email" class="input-text" value="<? echo isset($result) ? $result->email : ''; ?>"
                         name="email" placeholder="请输入邮箱">
                </div>
                <? if ($status) { ?>
                    <div class="item-button">
                        <button class="submit-button">提交审核</button>
                    </div>
                <? } ?>
            </form>

        </div>
    </div>
</div>
<script>
    //企业营业执照扫描件上传
    $("#comp-img > input").change(function (e) {
        var img = $('#comp-img > img');
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);//base64
        reader.onload = function () {
            $.post('imagesave', {image: this.result}, function (result) {
                console.log(result);
                img.attr('src', result.url);
                $("#comp-img-hidden").attr('value', result.url);
                alert(result.msg);
            }, 'json');
        }
    });
    //企业确认书扫描件上传
    $("#comp-comf-img > input").change(function (e) {
        var img = $('#comp-comf-img > img');
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);//base64
        reader.onload = function () {
            $.post('imagesave', {image: this.result}, function (result) {
                console.log(result);
                img.attr('src', result.url);
                $("#comp-comf-img-hidden").attr('value', result.url);
                alert(result.msg);
            }, 'json');
        }
    });
    //身份证正面照上传
    $("#info-img > input").change(function (e) {
        var img = $('#info-img > img');
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);//base64
        reader.onload = function () {
            $.post('imagesave', {image: this.result}, function (result) {
                console.log(result);
                img.attr('src', result.url);
                $("#info-img-hidden").attr('value', result.url);
                alert(result.msg);
            }, 'json');
        }
    });
    // 验证手机号
    function isPhoneNo(phone) {
        var pattern = /^1[34578]\d{9}$/;
        return pattern.test(phone);
    }
    ;
    // 验证身份证
    function isCardNo(card) {
        var pattern = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
        return pattern.test(card);
    }
    ;
    //验证邮箱
    function isEmail(email) {
        var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        return pattern.test(email);
    }
    ;
    $(".submit-button").click(function () {
        var comp_name = $("#comp-name").val();
        var input_file1 = $("#input-file1").val();
        var input_file2 = $("#input-file2").val();
        var user_name = $("#user-name").val();
        var info_num = $("#info-num").val();
        var input_file3 = $("#input-file3").val();
        var tel = $("#tel").val();
        var email = $("#email").val();
//        if (comp_name == '') {
//            alert('企业名称不能为空');
//            return false;
//        }
//        if (input_file1 == '') {
//            alert('企业营业执照不能为空');
//            return false;
//        }
//        if (input_file2 == '') {
//            alert('确认书扫描件不能为空');
//            return false;
//        }
//        if (user_name == '') {
//            alert('姓名不能为空');
//            return false;
//        }
//        if (!isCardNo(info_num)) {
//            alert('身份证号码不能为空');
//            return false;
//        }
//        if (input_file3 == '') {
//            alert('身份证照片不能为空');
//            return false;
//        }
//        if (!isPhoneNo(tel)) {
//            alert('手机号码格式不正确');
//            return false;
//        }
//        if (!isEmail(email)) {
//            alert('邮箱格式不正确');
//            return false;
//        }
        $.ajax({
            url: 'businessinfosave',
            type: 'post',
            data: $('#submit-form').serialize(),
            success: function (result) {
                alert('提交成功');
                window.location.reload();
            }
        });
        return false;
    })
</script>
