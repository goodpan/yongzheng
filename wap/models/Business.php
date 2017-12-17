<?php
namespace wap\models;

use yii\db\ActiveRecord;

/**
 * 商家model
 * Created by PhpStorm.
 * User: lc
 * Date: 2017/11/18
 * Time: 16:46
 */
class Business extends ActiveRecord
{
    /**
     * 添加或修改商家信息
     * @param array $data
     * @return array
     * @author chenwenzhen
     * @time 2017-11-18 21:06:52
     */
    public static function addOrEditBusiness($data = [])
    {
//        $user_id = \Yii::$app->session('user_id');
        $user_id = 7;
        $businessObj = self::find()
            ->select('id,status')
            ->where(['user_id' => $user_id])
            ->one();
        if ($businessObj) {//审核已通过，则不能在提交
            $businessObj->user_id = $user_id;
            $businessObj->comp_name = $data['comp_name'];
            $businessObj->comp_img = $data['comp_img'];
            $businessObj->comp_comf_img = $data['comp_comf_img'];
            $businessObj->info_name = $data['info_name'];
            $businessObj->info_num = $data['info_num'];
            $businessObj->info_img = $data['info_img'];
            $businessObj->tel = $data['tel'];
            $businessObj->email = $data['email'];
            $businessObj->status = 0;
            if ($businessObj->save()) {
                $status = 1;
                $msg = '提交成功';
            } else {
                $status = 0;
                $msg = '提交失败，未知错误，请联系客服';
            }
        } else {//不存在该用户信息，则新增信息
            $businessObj = new  self();
            $businessObj->user_id = $user_id;
            $businessObj->comp_name = $data['comp_name'];
            $businessObj->comp_img = $data['comp_img'];
            $businessObj->comp_comf_img = $data['comp_comf_img'];
            $businessObj->info_name = $data['info_name'];
            $businessObj->info_num = $data['info_num'];
            $businessObj->info_img = $data['info_img'];
            $businessObj->tel = $data['tel'];
            $businessObj->email = $data['email'];
            $businessObj->status = 0;
            if ($businessObj->save()) {
                $status = 1;
                $msg = '提交成功';
            } else {
                $status = 0;
                $msg = '提交失败，未知错误，请联系客服';
            }
        }
        return [
            'status' => $status,
            'msg' => $msg
        ];
    }

    /**
     * 获取商家信息
     * @param $user_id
     * @return static
     * @author chenwenzhen
     * @time 2017-11-18 21:09:05
     */
    public static function getBusinessInfo($user_id)
    {
        return self::findOne(['user_id' => $user_id]);
    }
}