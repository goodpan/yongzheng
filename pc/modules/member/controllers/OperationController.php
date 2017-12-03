<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:06
 */
namespace pc\modules\member\controllers;

use pc\controllers\BaseController;
use pc\models\User;

use Yii;

use pc\models\Business;

/** 会员操作控制器
 * Class OperationController
 * @package pc\modules\member\controllers
 */
class OperationController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        echo 'menber index';
    }
    /**
     * 登录
     * @return string
     * @author ldz
     */
    public function actionLogin(){
        $this->layout = false;

        return $this->render('login');
    }
    /**
     * 注册
     * @return string
     * @author ldz
     */
    public function actionRegister(){
        $this->layout = false;

        if(Yii::$app->request->post()){
           $arrConfig =  \Yii::$app->request->post();
           if(empty($arrConfig['sMobile'])|| empty($arrConfig['verify']) || empty($arrConfig['sPwd'])){
               $result = [
                   'status'=>false,
                   'msg'=>'请输入注册完整信息。'
               ];
               return json_encode($result);
           }

           $oldUser = User::find()
               ->where(['user_name'=>$arrConfig['sMobile']])
               ->one();
            //判断用户是否存在
            if(!empty($oldUser)){
                $result = [
                    'status'=>true,
                    'msg'=>'用户已存在，请登录。'
                ];
                return json_encode($result);
            }

            $veriFy = '';
            //验证手机验证码是否正确
//            if($arrConfig['verify']  != $veriFy){
//
//            }

            //注册用户，保存用户信息
            $user = new User();
            $user->nickname  = $arrConfig['sMobile'];   //注册后昵称默认为登录账号
            $user->user_name  = $arrConfig['sMobile'];  //登录账号
            $user->user_phone  = $arrConfig['sMobile'];       //手机号默认为登录账号
            $user->user_pass  = $arrConfig['sPwd'];           //登录密码
            $user->create_time = time();        //注册时间
            $user->save();
            Yii::trace($user,'注册成功');
            if($user){
                $result = [
                    'status'=>true,
                    'msg'=>'注册成功'
                ];
                return json_encode($result);
            }else{
                $result = [
                    'status'=>false,
                    'msg'=>'注册失败，请联系客服'
                ];
                return json_encode($result);
            }
        }
        return $this->render('register');
    }

    /**
     * 忘记密码
     * @return string
     * @author ldz
     */
    public function actionForgetpwd(){
        $this->layout = false;

        if(Yii::$app->request->post()){
            $arrData =  \Yii::$app->request->post();
            if(empty($arrData['sMobile'])){
                $result = [
                    'status'=>false,
                    'msg'=>'手机号不能为空，请输入。'
                ];
                return json_encode($result);
            }
            if(empty($arrData['verify'])){
                $result = [
                    'status'=>false,
                    'msg'=>'验证码不能为空，请输入。'
                ];
                return json_encode($result);
            }
            if(empty($arrData['sPwd'])){
                $result = [
                    'status'=>false,
                    'msg'=>'密码不能为空，请输入。'
                ];
                return json_encode($result);
            }

            $user = User::find()
                ->where(['user_name'=>$arrData['sMobile']])
                ->one();

            if(empty($user)){
                $result = [
                    'status'=>false,
                    'msg'=>'该用户不存在，请先注册！。'
                ];
                return json_encode($result);
            }

            $veriFy = '';
            //验证手机验证码是否正确
//            if($arrData['verify']  != $veriFy){
//                $result = [
//                    'status'=>false,
//                    'msg'=>'验证码不正确，请重新输入。'
//                ];
//                return json_encode($result);
//            }
            $user->user_pass = $arrData['sPwd'];
            $user->save();

            $result = [
                'status'=>true,
                'msg'=>'密码修改成功，请登录'
            ];
            return json_encode($result);

        }

        return $this->render('forgetpwd');
    }
    /**
     * 商家入驻
     * @return string
     * @author wenzhen-chen
     */
    public function actionBusiness()
    {
        $this->layout = '@app/views/layouts/main.php';

        $user_id = 7;
        $data = [];
        $data['result'] = Business::getBusinessInfo($user_id);
        // var_dump($data);exit;
        return $this->render('business',$data);
    }

    /**
     * 保存商家入驻信息
     */
    public function actionBusinessinfosave()
    {
        echo '<pre>';
        print_r(\Yii::$app->request->post());
        print_r($_FILES);
    }

    /**
     * 图片保存
     */
    public function actionImagesave()
    {
        echo '<pre>';
        echo 123;
        print_r(\Yii::$app->request->post());
//        $img = '/image/business_img/' . $_FILES['file']['name'];
//        $file = file_get_contents($_FILES['file']);
//        file_put_contents($img,$file);
    }
}