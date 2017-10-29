#PC端说明
> 基于模块化
## 目录结构
* pc
    *   assets  静态资源
    *   config  配置文件
    *   controllers 控制器
    *   logics   逻辑层
    *   models  模型层
    *   services    服务层
    *   views   视图
    *   runtime     缓存／日志
    *   tests   测试
    *   web     入口
        *   index.php   入口文件

## 路由
* 默认路由配置：config\main.php中设置：'defaultRoute'=>'info/site/index'。未匹配到模块会默认跳转到该路径下。

## 模块
* pc/modules/info   信息模块
* pc/modules/member 会员模块
* pc/modules/marketing  营销模块

## 如何创建模块
1.创建模块文件夹名，如info

2.在info下创建Info.php模块配置类

3.在config/main.php配置文件中配置：

'modules'=>[
        'info'=>[
            'class'=>'pc\info\Info'
        ]
    ]
## 依赖注入（服务定定位器）
1.在service层中定义相关服务，如search（创建search文件夹）

2.创建服务类,如SearchService

3.创建服务类依赖的相关类，并定义接口继承

4.服务类调用

    1)  实例化服务类
    通过配置文件方式指定,在config/main.php中component下:
    'search'=>[
        'class'=>'pc\services\search\SearchService'//服务定位器，依赖注入
     ]
     
    2)  在调用处通过全局容器指定依赖关系
    \Yii::$container->set('pc\services\search\SearchInterface','pc\services\search\FulltextSearch');
    \Yii::$app->search->start();
    
## 相关说明
* 模块中布局文件默认为yii框架布局（即在pc/views/layouts/main.php),如果需要自定义文件，则在控制中设置属性：
public $layout = '***/**/main'


## 数据库
### 

