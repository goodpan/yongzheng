<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/12
 * Time: 16:15
 */

namespace backend\models;
use backend\models\Category;
use yii\data\Pagination;
class Credentials extends BaseModel
{
    public static function tableName()
    {
        return "{{%credentials}}";
    }

    public function rules()
    {
        return [
            ['cred_id', 'safe'],
            ['cate_id', 'required', 'message' => '分类不能为空'],
            ['cred_name', 'required', 'message' => '证件名不能为空'],
            ['descr', 'safe'],
            ['condition', 'safe'],
            ['material', 'safe'],
            ['cost', 'safe'],
            ['locale', 'safe'],
            ['is_hot', 'safe'],
            ['is_del', 'safe'],
            ['cover', 'required', 'message' => '封面图不能为空'],
        ];
    }

    //关联表
    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'cred_id']);
    }

    /** 获取证件及证件分类
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCredJoinCateByPager($page=1,$limit=10){
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => self::getCount(),
        ]);
        return self::find()->alias('cred')->joinWith('category As cate', true, 'LEFT JOIN')->select('cred_id,cred_name,descr,cover,is_hot,name,cred.create_time')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
    }

    /** 编辑证件
     * @param $data
     * @return bool
     */
    public function edit($data){
        if($this->load($data,'')&&$this->validate()){
            $id = $data['cred_id'];
            $model = self::findOne($id);
            $model->cate_id = $data['cate_id'];
            $model->cred_name = $data['cred_name'];
            $model->descr = $data['descr'];
            $model->condition = $data['condition'];
            $model->material = $data['material'];
            $model->cost = $data['cost'];
            $model->locale = $data['locale'];
            $model->is_hot = $data['is_hot'];
            $model->cover = $data['cover'];
            if ($model->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }
}