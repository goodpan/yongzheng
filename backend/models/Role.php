<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/4
 * Time: 22:22
 */

namespace backend\models;


class Role extends BaseModel
{
    public static function tableName()
    {
        return "{{%role}}";
    }

    public function rules()
    {
        return [
            ['role_name', 'required', 'message' => '角色名不能为空'],
            ['role_name', 'unique', 'message' => '该角色名已经存在'],
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
}