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
                <div id="comp-img" class="item-1">
                    <span>企业营业执照扫描件</span>
                    <img src="#">
                    <input class="input-file" type="file" name="comp-img">
                </div>
                <div id="comp-comf-img" class="item-1">
                    <span>确认书扫描件</span>
                    <img src="#">
                    <input class="input-file" type="file" name="comp-comf-img">
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
                <div id="info-img" class="item-1">
                    <span>身份证正面照</span>
                    <img src="#">
                    <input class="input-file" type="file" name="info-img">
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
    //企业营业执照扫描件上传
    $("#comp-img > input").change(function (e) {
//        var formData = new FormData();
//        formData.append("file", e.target.files[0]);
        var img = $('#comp-img > img');
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);//base64
//        reader.readAsBinaryString(this.files[0]);//base64
        reader.onload = function () {
            $.ajax({
                url: "imagesave",
                type: "post",
                data: this.result,
                processData: false, // 不要对data参数进行序列化处理，默认为true
                contentType: false, // 不要设置Content-Type请求头，因为文件数据是以 multipart/form-data 来编码
                success: function (res) {
                    // 请求成功
                },
                error: function (res) {
                    // 请求失败
                    console.log(res);
                }
            });
        }
    });
    //确认书扫描件上传
    $("#comp-comf-img > input").change(function (e) {
        var formData = new FormData();
        formData.append("file", e.target.files[0]);
        var img = $('#comp-comf-img > img');
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);//base64
        reader.onload = function () {
            img[0].src = this.result;
        }
        $.ajax({
            url: "imagesave",
            type: "POST",
            data: formData,
            processData: false, // 不要对data参数进行序列化处理，默认为true
            contentType: false, // 不要设置Content-Type请求头，因为文件数据是以 multipart/form-data 来编码
            success: function (res) {
                // 请求成功
            },
            error: function (res) {
                // 请求失败
                console.log(res);
            }
        });
    });
    //身份证正面照上传
    $("#info-img > input").change(function (e) {
        var formData = new FormData();
        formData.append("file", e.target.files[0]);
        var img = $('#info-img > img');
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);//base64
        reader.onload = function () {
            img[0].src = this.result;
        }
        $.ajax({
            url: "imagesave",
            type: "POST",
            data: formData,
            processData: false, // 不要对data参数进行序列化处理，默认为true
            contentType: false, // 不要设置Content-Type请求头，因为文件数据是以 multipart/form-data 来编码
            success: function (res) {
                // 请求成功
            },
            error: function (res) {
                // 请求失败
                console.log(res);
            }
        });
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
            data: $('#submit-form').serialize()
        }, function (result) {
            console.log(result)
        });
        return false;
    })
</script>
