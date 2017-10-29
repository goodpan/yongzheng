<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:08
 */
namespace backend\logics;
use Yii;
/** 后台逻辑基类
 * Class BaseLogic
 */
class BaseLogic{
    /** 是否登录
     * @return mixed
     */
    public static function isLogin(){
        return isset(Yii::$app->session['admin']['isLogin']);
    }
}