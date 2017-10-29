<?php
/**
 * Created by PhpStorm.
 * User: chenwenzhen
 * Date: 2017/10/22
 * Time: 15:40
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商家入驻申请</title>
    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <link rel="stylesheet" type="text/css" href="/css/business.css">
</head>
<body>
<div class="header">
    <div class="header-top clearfix">
        <ul class="header-top-left">
            <li>
                <div class="item">
                    <a href="#" style="text-align: center">首页</a>
                </div>
            </li>
            <li>
                <div class="item">
                    <span>地区></span>
                </div>
            </li>
        </ul>
        <div class="header-top-right ">
            <ul>
                <li class="item">
                    <a href="#">登陆/个人中心</a>
                </li>
                <li class="item">
                    <a href="#">退出</a>
                </li>
                <li class="item">
                    <a href="#">商家入驻</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="container-main">
        <div class="container-main-top">
            <h1 class="business-title">
                <!--                <span class="title-text-1">商家入驻申请</span>-->
                <span class="title-text-2">审核中-重新提交可修改信息</span>
            </h1>
        </div>
        <div class="container-main-foot">
            <form id="business" method="post" action="#">
                <div class="item-1">
                    <span>企业名称</span>
                    <input class="input-text" placeholder="请输入企业名称">
                </div>
                <div class="item-1">
                    <span>企业营业执照扫描件</span>
                    <img src="#">
                    <input class="input-file" type="file" name="idcardpicfile" id="ID_img_input">
                </div>
                <div class="item-1">
                    <span>确认书扫描件</span>
                    <img src="#">
                    <input class="input-file" type="file" name="idcardpicfile" id="ID_img_input">
                </div>
                <div class="item-1">
                    <span>姓名</span>
                    <input class="input-text" placeholder="请输入真实姓名">
                </div>
                <div class="item-1">
                    <span>身份证号</span>
                    <input class="input-text" placeholder="请输入身份证号">
                </div>
                <div class="item-1">
                    <span>身份证正面照</span>
                    <img src="#">
                    <input class="input-file" type="file" name="idcardpicfile" id="ID_img_input">
                </div>
                <div class="item-1">
                    <span>联系电话</span>
                    <input class="input-text" placeholder="请输入联系电话">
                </div>
                <div class="item-1">
                    <span>邮箱</span>
                    <input class="input-text" placeholder="请输入邮箱">
                </div>
            </form>
            <div class="item-button">
                <button class="submit-button">提交审核</button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $('#articleImgBtn').change(function () {
        run(this, function (data) {
            uploadImage(data);
        });
    });

    function run(input_file, get_data) {
        /*input_file：文件按钮对象*/
        /*get_data: 转换成功后执行的方法*/
        if (typeof (FileReader) === 'undefined') {
            alert("抱歉，你的浏览器不支持 FileReader，不能将图片转换为Base64，请使用现代浏览器操作！");
        } else {
            try {
                /*图片转Base64 核心代码*/
                var file = input_file.files[0];
                //这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件
                if (!/image\/\w+/.test(file.type)) {
                    alert("请确保文件为图像类型");
                    return false;
                }
                var reader = new FileReader();
                reader.onload = function () {
                    get_data(this.result);
                }
                reader.readAsDataURL(file);
            } catch (e) {
                alert('图片转Base64出错啦！' + e.toString())
            }
        }
    }

    function uploadImage(img) {
        //判断是否有选择上传文件
        var imgPath = $("#articleImgBtn").val();
        if (imgPath == "") {
            alert("请选择上传图片！");
            return;
        }
        //判断上传文件的后缀名
        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        if (strExtension != 'jpg' && strExtension != 'gif'
            && strExtension != 'png' && strExtension != 'bmp') {
            alert("请选择图片文件");
            return;
        }
        $.ajax({
            type: "POST",
            url: ’上传图片接口‘,
        data: {
            token: token, file
        :
            img.substr(img.indexOf(',') + 1)
        }
    ,    //视情况将base64的前面字符串data:image/png;base64,删除
        cache: false,
            success
    :
        function (data) {
            alert("上传成功");
            $("#articleImg").attr('src', JSON.parse(data).imageUrl);
        }

    ,
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("上传失败，请检查网络后重试");
        }
    })
        ;
    }
</script>
</html>

