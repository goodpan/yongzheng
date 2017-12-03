<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2017/11/18
 * Time: 21:34
 */
namespace  pc\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    /**
     * 获取用户信息
     * @param $uid
     * @return array|null|ActiveRecord
     * @author liumingkang
     * 2017年12月1日21:53:08
     */
    public static function getUserinfo($uid){
        return self::find()->where(['user_id'=>$uid])->asArray()->one();
    }

}