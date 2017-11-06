<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/4
 * Time: 22:23
 */

namespace backend\models;


class RoleAuth extends BaseModel
{
    public static function tableName()
    {
        return "{{%role_auth}}";
    }

    public function rules()
    {
        return [
            ['role_id', 'required', 'message' => '角色id不能为空'],
            ['auth_id', 'required', 'message' => '权限id不能为空'],
        ];
    }

    public function add($data){
        if($this->load($data,'')&&$this->validate()){
            $this->create_time = time();//创建时间
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function batchAdd($data){
        return \Yii::$app->db->createCommand()->batchInsert(self::tableName(), ['role_id','auth_id','create_time'], $data)->execute();
    }
}