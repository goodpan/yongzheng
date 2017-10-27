<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/21
 * Time: 20:38
 */
use yii\widgets\LinkPager;
$this->title = "管理员列表";
?>
<div class="content">
    <div class="breadcrumb">
        <span class="layui-breadcrumb" lay-separator="-">
            <a href="">首页</a>
            <a href="">管理员列表</a>
        </span></div>
    <blockquote class="layui-elem-quote">
        <h6>操作提示</h6>
        <p>网站系统角色, 由总平台设置管理.</p>
    </blockquote>
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
                                    <!-- <span class="layui-btn layui-btn-primary layui-btn-mini" data-method="del">删除</span> -->
                                    <button class="layui-btn layui-btn-small layui-btn-mini"  data-method="del" data-adminid="<?=$manager->admin_id?>"><i class="layui-icon"></i> 删除</button>
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
            <div class="pagination pull-right">
                <?php echo yii\widgets\LinkPager::widget(['pagination' => $pager, 'prevPageLabel' => '上一页', 'nextPageLabel' => '下一页']); ?>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>

<?php $this->beginBlock('jsblock')?>
<script>
    layui.use(['element','layer','form'], function() { //独立版的layer无需执行这一句
        var $ = layui.jquery, layer = layui.layer,form = layui.form;
        var active = {
            del: function(){
                var adminid = $(this).data('adminid');
                layer.confirm('是否确认删除?', {icon: 3, title:'提示'}, function(index){
                    //do something
                    $.get('/manager/operation/del',{admin_id:adminid},function(res){
                        layer.msg(res.msg);
                        layer.close(index);
                        location.reload();
                    })
                });
            },
            add:function () {
                layer.open({
                    id:'mangager',
                    type: 2,
                    content: ['/manager/operation/reg', 'no'], 
                    area: ['600px', '400px'],
                    title:'添加新管理员',
                    // btn:['确认'],
                    success: function(layero, index){
                        var body = layer.getChildFrame('body', index);
                        var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();
                        var admin_user = body.find('input[name="admin_user"]').val();
                        var admin_email = body.find('input[name="admin_email"]').val();
                    },
                    yes: function(index, layero){
                        var body = layer.getChildFrame('body', index);
                        var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();
                        var form = body.find('form');
                        var admin_user = body.find('input[name="admin_user"]').val();
                        var admin_email = body.find('input[name="admin_email"]').val();
                        console.log(form);
                        console.log(admin_email);
                    }
                });
            }
        };
        
        $('.layui-btn').on('click', function(){
            var othis = $(this), method = othis.data('method');
            active[method] ? active[method].call(this, othis) : '';
        });
    })
</script>
<?php $this->endBlock('jsblock') ?>
