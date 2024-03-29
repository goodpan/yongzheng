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
            ['degree', 'integer'],
        ];
    }

    /**
     * 返回1、2级分类
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getParents(){
        return self::find()
            ->select('id,name,degree')
            ->where(['<','degree','3'])
            ->all();
    }
}