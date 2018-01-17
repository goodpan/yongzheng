<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:06
 */
namespace wap\modules\member\controllers;

use wap\controllers\BaseController;
use wap\models\Requirements;
use wap\models\SmsCode;
use wap\models\User;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use  Yii;

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
            $arrAction = ['login','register','forgetpwd','business','mydemand','protocol','setting','logout','changename','changepass','imagesave'];
           if(!in_array($action->id,$arrAction) && $this->bLogin()){
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
     * @time 2017-12-13 22:13:18
     */
    public function actionLogin()
    {
        if($this->bLogin()){
            return $this->redirect(\Yii::$app->request->hostInfo.'/member/space/index');
        }
        return $this->render('login');
    }

    /**
     * 提交登录信息
     * @return string
     * @author ldz
     */
    public function actionLoginpost(){
        $arrPost = \Yii::$app->request->post();
        $User = User::findData('user_id',['user_phone'=>$arrPost['sMobile'],'user_pass'=>md5(md5($arrPost['sPassWord']))]);

        if(empty($User)){
            return $this->asJson(['status'=>false, 'msg'=>'账户名与密码不匹配，请重新输入']);
        }

        $this->createSession($User->user_id);
        return $this->asJson(['status'=>true, 'msg'=>'登录成功']);
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
     * 注册提交
     * @return string
     * @author ldz
     * @time 2017-12-16 15:40:13
     */
    public function actionRegistpost(){
       $arrPost = \Yii::$app->request->post();

      if($arrPost['sPassWord'] != $arrPost['sRePassWord']){
          return $this->asJson(['status' => false, 'msg'=>'两次密码不一致']);
      }elseif(StringHelper::byteLength($arrPost['sPassWord'] < 6)){
         return $this->asJson(['status' => false, 'msg'=>'密码至少要6位数']);
      }

      $smsCode = Smscode::find()->select('sCode')->where(['sMobile'=>$arrPost['sMobile']])->orderBy('sCreateDate DESC')->one();

       if(!$smsCode || $arrPost['sCode'] != $smsCode['sCode'] ){
           return $this->asJson(['status' => false, 'msg'=>'验证码不正确']);
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
        return $this->asJson($data = ['status' => true, 'msg'=>'注册成功']);
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
        $userid = Yii::$app->session->get('user_id');
        $user = User::findData('user_id,avatar',['user_id'=>$userid]);
        return $this->render('setting',array('user'=>$user));
    }

    /**
     * 我提交的需求（个人会员）
     * @return string
     * @author suwen
     */
    public function actionMydemand()
    {
        $userid = Yii::$app->session->get('user_id');
        $userRequiredata = Requirements::find()
                ->where(['user_id'=>$userid])
                ->asArray()
                ->all();
        return $this->render('mydemand',array('requiredata'=>$userRequiredata,'user_id'=>$userid));
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
     * @return \yii\console\Response|\yii\web\Response
     * @author ldz
     * @time 2017-12-17 20:40:13
     */
    public function actionForgetpost(){

        $arrPost = Yii::$app->request->post();

        if($arrPost['sPassWord'] != $arrPost['sRePassWord']){
            return $this->asJson(['status' => false, 'msg'=>'两次密码不一致']);
        }elseif(StringHelper::byteLength($arrPost['sPassWord'] < 6)){
            return $this->asJson(['status' => false, 'msg'=>'密码至少要6位数']);
        }
        //查询验证码
        $smsCode = Smscode::find()->select('sCode')->where(['sMobile'=>$arrPost['sMobile'],'sType'=>'RetrievePwd'])->orderBy('sCreateDate DESC')->one();

        if(!$smsCode || $arrPost['sCode'] != $smsCode['sCode'] ){
            return $this->asJson(['status' => false, 'msg'=>'验证码不正确']);
        }

        $user = User::findData('user_id',['user_name'=>$arrPost['sMobile']]);
        if(!$user){
            return $this->asJson(['status'=>false,'msg'=>'手机号不存在']);
        }
        //判断密码是否一致
        if ($arrPost['sPassWord'] != $arrPost['sRePassWord']) {
            return $this->asJson(['status'=>false,'msg'=>'两次密码不一致']);
        }
        $user->user_pass = md5(md5($arrPost['sPassWord']));
        $user->save();

        //删除相关验证
        Smscode::deleteAll(['sMobile'=>$arrPost['sMobile'],'sType'=>'RetrievePwd']);
        return $this->asJson(['status' => true, 'msg'=>'修改成功']);
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
    public function actionBusinessinfo()
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
        $userid = Yii::$app->session->get('user_id');
        $data = \Yii::$app->request->post();
        $sAvatar = '';
        $img = $data['sAvatar'];
        //设置生成的图片名字
        $imageName = date("His",time())."_".rand(1111,9999).'.png';
        //判断是否有逗号，如果有就截取后半部分
        if(strstr($img,',')){
            $images = explode(',',$img);
            $sAvatar = $images[1]; //图片的数据
        }
        //设置图片保存路径
        $path = "img/upload/".date("Ymd",time());
        //判断文件目录是否存在 不存在就创建 并赋予777权限
        if(!is_dir($path)){  //如果文件不存在
            mkdir($path,0777,true); //默认最大权限
        }
        //拼接文件路径和图片名称
        $imageSrc = $path."/".$imageName;
        //生成图片 返回的是字节数
        $s = file_put_contents($imageSrc,base64_decode($sAvatar));
        //r㘝字节数存在 说明生成成功
        if($s){
            //图片生成成功 保存到数据库中该用户的头像路径中
            $user = User::findData('user_id',['user_id'=>$userid]);
            if($user){
                $user->avatar = $imageSrc;
                $user->save();
            }
            return $this->asJson(['status' => 1, 'msg'=>'头像保存成功']);
        }else{
            return $this->asJson(['status' => 2, 'msg'=>'头像保存失败']);
        }
    }

    /**
     * 发送注册短信验证码
     * @return string
     * @author ldz
     * @time 2017-12-16 12:42:45
     */
    public function actionSendstcode()
    {
        $sMobile = Yii::$app->request->post('sMobile');   //手机号
        $sType  = Yii::$app->request->post('sType');      //类型
        return $this->getSmscode($sMobile,$sType);
    }

    /**
     * 退出登录
     * @author lmk
     * @date 2018年1月9日21:22:54
     */
    public function actionLogout()
    {
         Yii::$app->session->set('user_id','');
         Yii::$app->session->set('lifetime','');
        return $this->asJson(['status' => 1, 'msg'=>'退出成功']);
    }

    /**
     * 修改昵称
     * @author lmk
     * @return string|\yii\console\Response|\yii\web\Response
     */
    public function actionChangename()
    {
        $userid = Yii::$app->session->get('user_id');
        $nickname = '';

        if(\Yii::$app->request->post('nickname')){
            $user = User::findData('user_id,nickname',['user_id'=>$userid]);
            if($user){
                $user->nickname = \Yii::$app->request->post('nickname');
                $user->save();
            }
            return $this->asJson(['status'=>1,'msg'=>'保存成功']);
        }
        if($userid){
            $data = User::find()
                ->select('nickname')
                ->where(['user_id'=>$userid])
                ->one();
            $nickname = $data->nickname;
        }

        return $this->render('changename',array('nickname'=>$nickname,'user_id'=>$userid));
    }

    /**
     * 修改密码
     * @author lmk
     */
    public function actionChangepass(){
        $userid = Yii::$app->session->get('user_id');
        $_POST = \Yii::$app->request->post();
        if($_POST){
            if($_POST['passVal'] != $_POST['rePassVal']){
                return $this->asJson(['status' => false, 'msg'=>'两次密码不一致']);
            }elseif(StringHelper::byteLength($_POST['passVal'] < 6)){
                return $this->asJson(['status' => false, 'msg'=>'密码至少要6位数']);
            }
            $user = User::findData('user_id,user_pass',['user_id'=>$userid]);
            if($user){
                if($user->user_pass == md5(md5($_POST['lastpassVal']))){
                    $user->user_pass = md5(md5($_POST['passVal']));
                    $user->save();
                    return $this->asJson(['status'=>1,'msg'=>'修改成功']);
                }else{
                    return $this->asJson(['status'=>false,'msg'=>'原密码错误']);
                }
            }
        }
        return $this->render('changepass',array('user_id'=>$userid));

    }
}