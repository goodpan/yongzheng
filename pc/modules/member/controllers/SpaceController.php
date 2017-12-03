<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:09
 */

namespace pc\modules\member\controllers;

use pc\controllers\BaseController;
use pc\models\User;

/** 会员空间控制器
 * Class SpaceController
 * @package pc\modules\member\controllers
 */
class SpaceController extends BaseController{

    //基本资料
    public function actionIndex(){
        $this->layout = '@app/views/layouts/main.php';
        $uid =13;

       if(\Yii::$app->request->post()){ //如果有提交 那么修改用户信息
            $post = \Yii::$app->request->post();
            $userObj = User::find()
                ->where(['user_id'=>$uid])
                ->one();
            if ($userObj){
                $userObj->user_name = trim($post['user_name']);
                $userObj->nickname = trim($post['nickname']);
                $userObj->sex = trim($post['sex']);
                $userObj->birthday = strtotime($post['birthday']);
                $userObj->profile = trim($post['profile']);
                $userObj->update_time = time();
                if ($userObj->save()) {
                    $data['status'] = 1;
                    $data['msg'] = '修改成功';
                } else {
                    $data['status'] = 0;
                    $data['msg'] = '修改失败';
                }
            }
            // return json_encode($data);
            return \yii\helpers\Json::encode($data);
        }
        $data = User::getUserinfo($uid);
        return $this->render('userinfo',array('userinfo'=>$data));
    }

    //联系方式
    public function actionContactway(){
        $this->layout = '@app/views/layouts/main.php';
        $uid =1;
        if(\Yii::$app->request->post()){ //如果有提交 那么添加或修改用户信息
             $userObj = User::find()
                ->select('*')
                ->where(['user_id'=>$uid])
                ->one();
            $post = \Yii::$app->request->post();
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
                } else {
                    $data['status'] = 0;
                    $data['msg'] = '修改失败';
                }
            }
            return \yii\helpers\Json::encode($data);
        }
        $data = User::getUserinfo($uid);
        return $this->render('contactway',array('data'=>$data));
    }

    //修改密码
    public function actionChangepwd(){
        $this->layout = '@app/views/layouts/main.php';
        $uid = 1;
        if(\Yii::$app->request->post()){ //如果有提交 那么添加或修改用户信息
            $post = \Yii::$app->request->post();
            $userObj = User::find()
                ->select('user_pass')
                ->where(['user_id'=>$uid])
                ->one();

            if($userObj->user_pass == md5($post['pwd'])){
                $userObj->user_pass = md5($post['newpwd']);
                if ($userObj->save()) {
                    $data['status'] = 1;
                    $data['msg'] = '修改成功';
                }
            }else{
                $data['status'] = 0;
                $data['msg'] = '原密码错误，修改失败';
            }
            return \yii\helpers\Json::encode($data);
        }
        return $this->render('changepwd');
    }

    //账户管理
    public function actionManageinfo(){
        $this->layout = '@app/views/layouts/main.php';
        return $this->render('manageinfo');
    }


}
