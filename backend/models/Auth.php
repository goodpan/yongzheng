<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/18
 * Time: 22:06
 */

namespace backend\models;


class Auth extends BaseModel
{
    public static function tableName()
    {
        return "{{%auth}}";
    }

    public function rules()
    {
        return [
            ['auth_name', 'required', 'message' => '权限名不能为空'],
            ['auth_m', 'required', 'message' => '模块名不能为空'],
            ['auth_c', 'required', 'message' => '控制器名不能为空'],
            ['auth_a', 'required', 'message' => '方法名不能为空']
        ];
    }

    public function getAuthsNameByAll(){
        return self::find()->select(['auth_id','auth_name'])->all();
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
}