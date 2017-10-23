<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/21
 * Time: 20:38
 */
use yii\widgets\LinkPager;
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
<div id="demo7"></div>


<div class="content">
    <div class="breadcrumb">
        <span class="layui-breadcrumb" lay-separator="-">
            <a href="">首页</a><span class="separator">></span>
            <a href="">管理员列表</a>
        </span></div>
    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid">
                
                <button class="layui-btn" data-method="add"><i class="layui-icon">&#xe654;</i>
                        添加新管理员</button>
            </div>
            <!-- Users table -->
            <div class="row-fluid table">
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col width="200">
                        <col width="200">
                        <col width="200">
                        <col width="200">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="span2">
                            管理员ID
                        </th>
                        <th class="span2">
                            <span class="line"></span>管理员账号
                        </th>
                        <th class="span2">
                            <span class="line"></span>管理员邮箱
                        </th>
                        <th class="span3">
                            <span class="line"></span>最后登录时间
                        </th>
                        <th class="span3">
                            <span class="line"></span>最后登录IP
                        </th>
                        <th class="span2">
                            <span class="line"></span>添加时间
                        </th>
                        <th class="span2">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($managers as $manager): ?>
                        <!-- row -->
                        <tr>
                            <td>
                                <?php echo $manager->admin_id; ?>
                            </td>
                            <td>
                                <?php echo $manager->admin_user; ?>
                            </td>
                            <td>
                                <?php echo $manager->admin_email; ?>
                            </td>
                            <td>
                                <?php echo date('Y-m-d H:i:s', $manager->login_time); ?>
                            </td>
                            <td>
                                <?php echo long2ip($manager->login_ip); ?>
                            </td>
                            <td>
                                <?php echo date("Y-m-d H:i:s", $manager->create_time); ?>
                            </td>
                            <td class="align-right">
                                <?php if ($manager->admin_id != 1): ?>
                                    <span class="layui-btn layui-btn-primary layui-btn-mini" data-method="del">删除</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                if (Yii::$app->session->hasFlash('info')) {
                    echo Yii::$app->session->getFlash('info');
                }
                ?>
            </div>
            <div id="test1"></div>
            <div class="pagination pull-right">
                <?php echo yii\widgets\LinkPager::widget(['pagination' => $pager, 'prevPageLabel' => '上一页', 'nextPageLabel' => '下一页']); ?>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>



<?php $this->beginBlock('jsblock')?>
<script>
    layui.use('layer', function() { //独立版的layer无需执行这一句
        var active = {
            del: function(){
                layer.confirm('是否确认删除?', {icon: 3, title:'提示'}, function(index){
                    //do something
                    console.log(index)
                    layer.close(index);
                });
            },
            add:function () {
                layer.open({
                    type: 1,
                    content: '传入任意的文本或html' //这里content是一个普通的String
                });
            }
        };
        var $ = layui.jquery, layer = layui.layer;
        $('.layui-btn').on('click', function(){
            var othis = $(this), method = othis.data('method');
            active[method] ? active[method].call(this, othis) : '';
        });

    })

</script>

<?php $this->endBlock('jsblock') ?>
