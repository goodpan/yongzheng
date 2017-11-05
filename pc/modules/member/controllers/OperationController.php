<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:06
 */
namespace pc\modules\member\controllers;

use pc\controllers\BaseController;
use pc\models\Tesr;

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
        return $this->render('register');
    }
    /**
     * 忘记密码
     * @return string
     * @author ldz
     */
    public function actionForgetpwd(){
        $this->layout = false;
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