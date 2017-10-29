<?php
/* @var $this yii\web\View */
$this->title = '雍正网后台管理中心';
?>
<style>
.user-map{
    width: 40%;
    height:400px;
    border:1px solid #e3e3e3;
    padding:30px;
    display:inline-block;
    margin-right:20px;
}
</style>
<div class="layui-col-md">
    <div class="layui-row grid-demo">
        <div class="layui-col-md12">
            <h3>管理中心</h3>
            <hr class="layui-bg-gray">
            <div class="map-chat" id="main">
                <div class="user-map" id="user-map">

                </div>
                <div class="user-map" id="user-map2"></div>
            </div>
            <div class="status-wrap">
                <!-- <ul class="status-list">
                    <li>入驻审核</li>
                    <li>会员总数</li>
                    <li>证件总数</li>
                    <li>入驻申请</li>
                </ul> -->
            </div>
        </div>
        <div class="layui-col-md12">
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

<?php $this->beginBlock('jsblock')?>
<script src="/js/echarts.min.js"></script>
<script>
var myChart = echarts.init(document.getElementById('user-map'));
var option = {
    title : {
        text: '用户访问来源',
        subtext: '实时统计',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'直接访问'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1548, name:'搜索引擎'}
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};
 // 使用刚指定的配置项和数据显示图表。
 myChart.setOption(option);
</script>
<script>
var myChart2 = echarts.init(document.getElementById('user-map2'));
myChart2.title = '堆叠柱状图';
var option2 = {
    tooltip : {
        trigger: 'axis',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        }
    },
    legend: {
        data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎','百度','谷歌','必应','其他']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            data : ['周一','周二','周三','周四','周五','周六','周日']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'直接访问',
            type:'bar',
            data:[320, 332, 301, 334, 390, 330, 320]
        },
        {
            name:'邮件营销',
            type:'bar',
            stack: '广告',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'联盟广告',
            type:'bar',
            stack: '广告',
            data:[220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'视频广告',
            type:'bar',
            stack: '广告',
            data:[150, 232, 201, 154, 190, 330, 410]
        },
        {
            name:'搜索引擎',
            type:'bar',
            data:[862, 1018, 964, 1026, 1679, 1600, 1570],
            markLine : {
                lineStyle: {
                    normal: {
                        type: 'dashed'
                    }
                },
                data : [
                    [{type : 'min'}, {type : 'max'}]
                ]
            }
        },
        {
            name:'百度',
            type:'bar',
            barWidth : 5,
            stack: '搜索引擎',
            data:[620, 732, 701, 734, 1090, 1130, 1120]
        },
        {
            name:'谷歌',
            type:'bar',
            stack: '搜索引擎',
            data:[120, 132, 101, 134, 290, 230, 220]
        },
        {
            name:'必应',
            type:'bar',
            stack: '搜索引擎',
            data:[60, 72, 71, 74, 190, 130, 110]
        },
        {
            name:'其他',
            type:'bar',
            stack: '搜索引擎',
            data:[62, 82, 91, 84, 109, 110, 120]
        }
    ]
};
myChart2.setOption(option2);
</script>
<?php $this->endBlock('jsblock') ?>

