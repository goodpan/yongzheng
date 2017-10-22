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

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>管理员列表</h3>
                <div class="span10 pull-right">

                    <a href="<?php echo yii\helpers\Url::to(['manage/reg']); ?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        添加新管理员
                    </a>
                </div>
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
                                    <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="del" href="<?php echo yii\helpers\Url::to(['manage/del', 'adminid' => $manager->admin_id]) ?>">删除</a>
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


    <table class="layui-table" lay-data="{height:332, url:'/manager/opreation/managers', page:true, id:'idTest'}" lay-filter="managers">
        <thead>
        <tr>
            <th lay-data="{checkbox:true, fixed: true}"></th>
            <th lay-data="{field:'id', width:80, sort: true, fixed: true}">ID</th>
            <th lay-data="{field:'username', width:80}">用户名</th>
            <th lay-data="{field:'sex', width:80, sort: true}">性别</th>
            <th lay-data="{field:'city', width:80}">城市</th>
            <th lay-data="{field:'sign', width:177}">签名</th>
            <th lay-data="{field:'experience', width:80, sort: true}">积分</th>

            <th lay-data="{field:'classify', width:80}">职业</th>
            <th lay-data="{field:'wealth', width:135, sort: true}">财富</th>
            <th lay-data="{field:'score', width:80, sort: true, fixed: 'right'}">评分</th>
            <th lay-data="{fixed: 'right', width:160, align:'center', toolbar: '#barDemo'}"></th>
        </tr>
        </thead>
    </table>
    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
        <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
    </script>


</div>

<?php $this->beginBlock('jsblock')?>
<script>
    layui.use('table', function(){
        var table = layui.table;
        //监听表格复选框选择
        table.on('checkbox(managers)', function(obj){
            console.log(obj)
        });
        //监听工具条
        table.on('tool(managers)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.msg('ID：'+ data.id + ' 的查看操作');
            } else if(obj.event === 'del'){
                layer.confirm('真的删除行么', function(index){
                    obj.del();
                    layer.close(index);
                });
            } else if(obj.event === 'edit'){
                layer.alert('编辑行：<br>'+ JSON.stringify(data))
            }
        });

    });
</script>

<?php $this->endBlock('jsblock') ?>
