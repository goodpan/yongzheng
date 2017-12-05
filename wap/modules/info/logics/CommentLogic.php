<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/5
 * Time: 21:01
 */

namespace pc\modules\info\logic;
use pc\logics\BaseLogic;
//use yii\di\Container;

class CommentLogic extends BaseLogic{
    public static function echoStr(){
        echo 'this from block';
    }

    public static function search(){
        //依赖注入
//        $container = new Container;
//        $container->set('pc\services\search\SearchInterface','pc\services\search\LikeSearch');//设置类与类的关联
//        $search = $container->get('pc\services\search\SearchService');//获取类实例
//        $search->start();
        //依赖注入，服务定位器
        \Yii::$container->set('pc\services\search\SearchInterface','pc\services\search\FulltextSearch');
        \Yii::$app->search->start();
    }
}