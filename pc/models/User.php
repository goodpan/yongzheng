<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2017/11/18
 * Time: 21:34
 */
namespace  pc\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    /**
     * 获取用户信息
     * @param $uid
     * @return array|null|ActiveRecord
     * @author liumingkang
     * 2017年12月1日21:53:08
     */
    public static function getUserinfo($uid){
        return self::find()->where(['user_id'=>$uid])->asArray()->one();
    }

    /**
     * 修改用户密码
     * @param  [type] $uid  [description]
     * @param  [type] $data [description]
     * @author liumingkang
     */
    public static function modifyUserpwd($uid,$pwd){
        //取出用户原来的密码
        $userObj = User::find()
            ->select('user_pass')
            ->where(['user_id'=>$uid])
            ->one();

        if($userObj->user_pass == md5($pwd['pwd'])){
            $userObj->user_pass = md5($pwd['newpwd']);
            if ($userObj->save()) {
                $data['status'] = 1;
                $data['msg'] = '修改成功';
                return $data;
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = '原密码错误，修改失败';
            return $data;
        }
    }

/**
 * 修改用户联系方式
 * @param  [type] $uid  [description]
 * @param  [type] $post [description]
 * @author  liumingkang <[email address]>
 */
    public static function modifyUsercontatway($uid,$post){
        $userObj = User::find()
            ->select('*')
            ->where(['user_id'=>$uid])
            ->one();
//        var_dump($userdata);exit;
        if($userObj){ //如果数据存在 那么更新 否则插入
            $userObj->user_phone = trim($post['phone']);
            $userObj->user_email = trim($post['email']);
            $userObj->immobilize_phone = trim($post['quhao'])-trim($post['phone2']);
            // $userObj->pca = trim($post['provience'])-trim($post['city'])-trim($post['area']);
            $userObj->qq = trim($post['qq']);
            $userObj->detailaddress = trim($post['detailaddress']);
            $userObj->update_time = time();

            if ($userObj->save()) {
                $data['status'] = 1;
                $data['msg'] = '修改成功';
                return $data;
            } else {
                $data['status'] = 0;
                $data['msg'] = '修改失败';
                return $data;
            }
        }else{
            $userObj = new User();
            $userObj->user_phone = trim($post['phone']);
            $userObj->user_email = trim($post['email']);
            $userObj->immobilize_phone = trim($post['quhao'])-trim($post['phone2']);
            // $userObj->pca = trim($post['provience'])-trim($post['city'])-trim($post['area']);
            $userObj->qq = trim($post['qq']);
            $userObj->detailaddress = trim($post['detailaddress']);
            $userObj->create_time = time();
//            var_dump($userObj);exit;
            if ($userObj->save()) {
                $data['status'] = 1;
                $data['msg'] = '修改成功';
                return $data;
            } else {
                $data['status'] = 0;
                $data['msg'] = '修改失败';
                return $data;
            }
        }
    }
}