<?php

/* @var $this yii\web\View */

$this->title = '雍正网后台管理中心';

?>
<div class="layui-col-md">
    <div class="layui-row grid-demo">
        <div class="layui-col-md4">
            管理中心
        </div>
        <div class="layui-col-md8">
            版本信息
        </div>
        <div class="layui-col-md12">
            <h3>系统信息</h3>
            <table class="layui-table">
                <tr>
                    <td>服务器操作系统：</td>
                    <td><?= PHP_OS?></td>
                    <td>系统版本号:</td>
                    <td><?= php_uname('r') ?></td>
                    <td>服务器IP:</td>
                    <td><?=GetHostByName($_SERVER['SERVER_NAME'])?></td>
                </tr>
                <tr>
                    <td>服务器语言：</td>
                    <td><?= $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?></td>
                    <td>服务器域名:</td>
                    <td><?= $_SERVER["HTTP_HOST"] ?></td>
                    <td>服务器Web端口:</td>
                    <td><?=$_SERVER['SERVER_PORT']?></td>
                </tr>
                <tr>
                    <td>PHP版本：</td>
                    <td><?=  PHP_VERSION ?></td>
                    <td>PHP安装路径:</td>
                    <td><?= DEFAULT_INCLUDE_PATH ?></td>
                    <td>PHP运行方式:</td>
                    <td><?=php_sapi_name() ?></td>
                </tr>
                <tr>
                    <td>MYSQL版本：</td>
                    <td><?php Yii::$app->db->open(); echo \Yii::$app->db->pdo->getAttribute(\PDO::ATTR_SERVER_VERSION);?></td>
                    <td>Apache版本:</td>
                    <td></td>
                    <td>GD版本:</td>
                    <td><?=gd_info()["GD Version"]?></td>
                </tr>
                <tr>
                    <td>curl支持:</td>
                    <td><?=function_exists('curl_init') ? 'YES' : 'NO'?></td>
                    <td>zlib支持:</td>
                    <td><?=function_exists('gzclose') ? 'YES' : 'NO'?></td>
                    <td>安全模式:</td>
                    <td><?=(boolean) ini_get('safe_mode') ? 'YES' : 'NO'?></td>
                </tr>
                <tr>
                    <td>最大执行时间:</td>
                    <td><?= @ini_get("max_execution_time").'s'?></td>
                    <td>最大占用内存:</td>
                    <td><?= ini_get('memory_limit')?></td>
                    <td>文件上传限制:</td>
                    <td><?=@ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown'?></td>

                </tr>
            </table>
        </div>
    </div>
</div>

<?php $this->beginBlock('sitebar')?>
<!-- 左侧导航区域（可配合layui已有的垂直导航） -->
<ul class="layui-nav layui-nav-tree"  lay-filter="test">
    <li class="layui-nav-item layui-this">
        <a class="" href="javascript:;">首页</a>
    </li>
</ul>
<?php $this->endBlock('sitebar')?>

