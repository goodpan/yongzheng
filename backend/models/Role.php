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
}