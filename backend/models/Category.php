<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/5
 * Time: 22:58
 */

namespace backend\models;
use backend\logics\UnLimitTree;

class Category extends BaseModel
{
    public static function tableName()
    {
        return "{{%category}}";
    }

    public function rules()
    {
        return [
            ['id','safe'],
            ['name', 'required', 'message' => '分类名不能为空'],
            ['pid', 'required', 'message' => '请选择上级分类'],
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