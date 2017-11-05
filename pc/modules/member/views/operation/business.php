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
                <span class="title-text-1">商家入驻申请</span>
                <!--                <span class="title-text-2">审核中-重新提交可修改信息</span>-->
            </h1>
        </div>
        <div class="container-main-foot">
            <form id="submit-form">
                <div class="item-1">
                    <span>企业名称</span>
                    <input id="comp-name" name="comp-name" class="input-text" placeholder="请输入企业名称">
                </div>
                <div class="item-1">
                    <span>企业营业执照扫描件</span>
                    <img id="test-img" src="#">
                    <input id="input-file1" class="input-file" type="file" name="idcardpicfile">
                </div>
                <div class="item-1">
                    <span>确认书扫描件</span>
                    <img src="#">
                    <input id="input-file2" class="input-file" type="file" name="idcardpicfile">
                </div>
                <div class="item-1">
                    <span>姓名</span>
                    <input id="user-name" value="" type="text" name="user-name" class="input-text"
                           placeholder="请输入真实姓名">
                </div>
                <div class="item-1">
                    <span>身份证号</span>
                    <input id="info-num" value="" type="text" class="input-text" placeholder="请输入身份证号">
                </div>
                <div class="item-1">
                    <span>身份证正面照</span>
                    <img src="#">
                    <input id="input-file3" class="input-file" type="file" name="file3">
                </div>
                <div class="item-1">
                    <span>联系电话</span>
                    <input id="tel" class="input-text" placeholder="请输入联系电话">
                </div>
                <div class="item-1">
                    <span>邮箱</span>
                    <input id="email" class="input-text" placeholder="请输入邮箱">
                </div>
                <div class="item-button">
                    <button class="submit-button">提交审核</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    //图片上传
    $("#input-file1").change(function (e) {
        $.ajax({
            ul: 'imagesave',
            type: 'post',
            data: {
                'file': e.
            }
        }, function (result) {
            console.log(result)
        })
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
        if (comp_name == '') {
            alert('企业名称不能为空');
            return false;
        }
        if (input_file1 == '') {
            alert('企业营业执照不能为空');
            return false;
        }
        if (input_file2 == '') {
            alert('确认书扫描件不能为空');
            return false;
        }
        if (user_name == '') {
            alert('姓名不能为空');
            return false;
        }
        if (!isCardNo(info_num)) {
            alert('身份证号码不能为空');
            return false;
        }
        if (input_file3 == '') {
            alert('身份证照片不能为空');
            return false;
        }
        if (!isPhoneNo(tel)) {
            alert('手机号码格式不正确');
            return false;
        }
        if (!isEmail(email)) {
            alert('邮箱格式不正确');
            return false;
        }
        $.ajax({
            url: 'businessinfosave',
            type: 'post',
            data: $('#submit-form').serialize()
        }, function (result) {
            console.log(result)
        });
        return false;
    })
</script>
