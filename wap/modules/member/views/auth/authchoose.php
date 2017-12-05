<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Time: 2017年11月16日09:17:51
 */
$this->title = "开发者认证";
?>
<?php $this->beginBlock('cssblock')?>
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
<div class="form-label">1.请选择你要申请的开发者类型</div>
<div class="choose-layer">
    <a href="/member/auth/authperson" class="choose-item">
        <div class="pic">
            <img src="/img/auth/choose1.png" alt="">
        </div>
        <div class="text">
            <p>我是个人...</p>
            <p>我想在平台上接包挣钱</p>
        </div>
    </a>
    <a href="/member/auth/authcomp" class="choose-item">
        <div class="pic">
            <img src="/img/auth/choose2.png" alt="">
        </div>
        <div class="text">
            <p>我是企业，我想在平台上</p>
            <p>开店、接单</p>
        </div>
    </a>
</div>
