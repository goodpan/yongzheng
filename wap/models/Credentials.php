<?php
/**
 * Created by PhpStorm.
 * User: lc
 * Date: 2017/12/13
 * Time: 22:52
 */
namespace wap\models;
use backend\models\BaseModel;

class Credentials extends BaseModel{
    /**
     * 根据证件分类id获取证件信息
     * @param string $cate_id
     * @return array|\yii\db\ActiveRecord[]
     * @author wenzhen-chen
     * @time 2017-12-13 22:55:30
     */
    public function getCredentialsByCateId($cate_id=''){
       return self::find()
           ->select('cred_name,cover')
           ->where(['cate_id' => $cate_id])
           ->all();
    }
}