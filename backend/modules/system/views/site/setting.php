<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/21
 * Time: 17:28
 */

?>

<?php $this->beginBlock('sitebar')?>
<!-- 左侧导航区域（可配合layui已有的垂直导航） -->
<ul class="layui-nav layui-nav-tree"  lay-filter="test">
    <li class="layui-nav-item layui-nav-itemed">
        <a class="" href="javascript:;">设置</a>
        <dl class="layui-nav-child">
            <dd><a href="javascript:;">网站设置</a></dd>
            <dd><a href="javascript:;">友情链接</a></dd>
            <dd><a href="javascript:;">短信设置</a></dd>
            <dd><a href="javascript:;">清除缓存</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item">
        <a href="javascript:;">管理员设置</a>
        <dl class="layui-nav-child">
            <dd><a href="/manager/operation/managers">管理员列表</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item">
        <a href="javascript:;">权限管理</a>
        <dl class="layui-nav-child">
            <dd><a href="javascript:;">列表一</a></dd>
            <dd><a href="javascript:;">列表二</a></dd>
            <dd><a href="">超链接</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item">
        <a href="javascript:;">数据</a>
        <dl class="layui-nav-child">
            <dd><a href="javascript:;">列表一</a></dd>
            <dd><a href="javascript:;">列表二</a></dd>
            <dd><a href="">超链接</a></dd>
        </dl>
    </li>
</ul>
<?php $this->endBlock('sitebar')?>
