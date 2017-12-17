<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:06
 */
namespace wap\modules\member\controllers;

use Symfony\Component\CssSelector\Parser\Handler\StringHandler;
use wap\controllers\BaseController;
use wap\models\SmsCode;
use wap\models\User;
use wap\models\Business;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/** 会员操作控制器
 * Class OperationController
 * @package pc\modules\member\controllers
 */
class OperationController extends BaseController
{
    public $enableCsrfValidation = false;
    public $layout = '@app/views/layouts/home.php';

    public function beforeAction($action)
    {
       if(parent::beforeAction($action)){
            $arrAction = ['login','register','forgetpwd','business','mydemand','protocol','setting'];
           if(!$this->bLogin() && !in_array($action->id,$arrAction)){
               $this->redirect(Url::toRoute([
                   \Yii::$app->request->hostInfo . '/member/space/index',
                   'sReturnUrl' => \Yii::$app->request->url
               ], true));
           }
       }else{
           return false;
       }
       return true;
    }

    public function actionIndex()
    {
        echo 'menber index';
    }

    /**
     * 登录
     * @return string
     * @author ldz
     */
    public function actionLogin()
    {
        if($this->bLogin()){
            return $this->redirect(\Yii::$app->request->hostInfo.'/member/space/index');
        }
//        sdds
        return $this->render('login');
    }

    public function actionLoginpost(){
        $arrPost = \Yii::$app->request->post();

        $User = User::findData('user_id',['user_name'=>$arrPost['sMobile'],'user_pass'=>md5(md5($arrPost['sPassWord']))]);

        if(empty($User)){
            $data = ['status'=>false, 'msg'=>'账户名与密码不匹配，请重新输入'];
            return json_encode($data);
        }

        $session = \Yii::$app->session;
        $session->set('user_id',$User->user_id);
        $session->set('lifetime',time() + 3600);

        $data = ['status'=>true, 'msg'=>'登录成功'];
        return json_encode($data);
    }


    /**
     * 注册页
     * @return string
     * @author ldz
     * @time 2017-12-13 22:13:18
     */
    public function actionRegister()
    {
        return $this->render('register');
    }

    /**
     * 发送注册短信验证码
     * @return string
     * @author ldz
     * @time 2017-12-16 12:42:45
     */
    public function actionRegistcode()
    {
        $sMobile = \Yii::$app->request->post('sMobile');
        $user = User::find()
            ->where(['user_name' => $sMobile])
            ->one();
        if (!empty($user)) {
            \Yii::trace($sMobile.'该手机号已被注册');
            $data = [
                'status' => false,
                'msg'=>'手机号已经被注册了'
            ];
            return json_encode($data);
        }
        $sType = 'regist';
        //发送短信
        $smscode = new Smscode();
        $re_send =  $smscode->sendCode($sMobile,$sType);
        if($re_send['status']){
            $data = [
                'status' => true,
                'msg'=>$re_send['msg']
            ];
            return json_encode($data);
        }else{
            $data = [
                'status' => false,
                'msg'=>$re_send['msg']
            ];
            return json_encode($data);
        }

    }

    /**
     * 注册提交
     * @return string
     * @author ldz
     * @time 2017-12-16 15:40:13
     */
    public function actionRegistpost(){
       $arrPost = \Yii::$app->request->post();

      if($arrPost['sPassWord'] != $arrPost['sRePassWord']){
          $data = [
              'status' => false,
              'msg'=>'两次密码不一致'
          ];
          return json_encode($data);
      }elseif(StringHelper::byteLength($arrPost['sPassWord'] < 6)){
          $data = [
              'status' => false,
              'msg'=>'密码至少要6位数'
          ];
          return json_encode($data);
      }

      $smsCode = Smscode::find()->select('sCode')->where(['sMobile'=>$arrPost['sMobile']])->orderBy('sCreateDate DESC')->one();

       if(!$smsCode || $arrPost['sCode'] != $smsCode['sCode'] ){
           $data = [
               'status' => false,
               'msg'=>'验证码不正确'
           ];
           return json_encode($data);
       }

       //创建用户
        $User = new  User();
        $User->user_name = $arrPost['sMobile'];
        $User->user_pass = md5(md5($arrPost['sPassWord']));
        $User->user_phone = $arrPost['sMobile'];
        $User->create_time = time();
        $User->save();

        //删除相关验证
        Smscode::deleteAll(['sMobile'=>$arrPost['sMobile'],'sType'=>'regist']);

        $data = [
            'status' => true,
            'msg'=>'注册成功'
        ];
        return json_encode($data);

    }

    /**
     * 注册协议
     * @return string
     * @author suwen
     */
    public function actionProtocol()
    {
        return $this->render('protocol');
    }

    /**
     * 会员设置
     * @return string
     * @author suwen
     */
    public function actionSetting()
    {
        return $this->render('setting');
    }

    /**
     * 我提交的需求（个人会员）
     * @return string
     * @author suwen
     */
    public function actionMydemand()
    {
        return $this->render('mydemand');
    }


    /**
     * 忘记密码
     * @return string
     * @author ldz
     */
    public function actionForgetpwd()
    {
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
        return $this->render('business');
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