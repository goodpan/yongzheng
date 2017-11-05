<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/23
 * Time: 21:00
 */

namespace backend\models;

use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord{
    /** 获取总数
     * @return int|string
     */
    public function getCount(){
        return self::find()->count();
    }

    public function getOneById($field,$id){
        return self::find()->where([$field=>$id])->one();
    }
}