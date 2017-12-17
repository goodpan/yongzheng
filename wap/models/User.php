<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2017/11/18
 * Time: 21:34
 */
namespace wap\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function findData($select = '*', $where = [], $order = 'create_time DESC')
    {
        return self::find()->select($select)->where($where)->orderBy($order)->one();
    }
}