<?php
/**
 * Created by PhpStorm.
 * User: zsmds
 * Date: 2018/1/21
 * Time: 7:50
 */
namespace backend\modules;
use backend\models\BaseModel;
use yii\data\Pagination;


class User extends BaseModel
{
    public static function tableName()
    {
        return "{{%user}}";
    }

    public function rules()
    {
        return [
            ['user_id', 'safe'],
            ['user_id', 'required', 'message' => '用户id不能为空'],
            ['user_name', 'required', 'message' => '用户名不能为空'],
            ['user_phone', 'required', 'message' => '用户电话不能为空'],

        ];
    }

    /** 用户信息
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getUserByPager($page=1,$limit=10){
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => self::getCount(),
        ]);
        return self::find()->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
    }

    /** 修改个人信息
     * @param $data
     * @return bool
     */
    public function edit($data){
        if($this->load($data,'')&&$this->validate()){
            $id = $data['user_id'];
            $model = self::findOne($id);
            $model->user_name = $data['user_name'];
            $model->user_pass = md5(md5($data['user_pass']));
            $model->user_email = $data['user_email'];
            $model->user_phone = $data['user_phone'];
            $model->nickname = $data['nickname'];
            $model->profile = $data['profile'];
            $model->birthday = $data['birthday'];
            $model->sex = $data['sex'];
            $model->detailaddress = $data['detailaddress'];
            $model->pca = $data['pca'];
            $model->immobilize_phone = $data['immobilize_phone'];
            $model->qq = $data['qq'];
            $model->avatar = $data['avatar'];
            if ($model->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }
}