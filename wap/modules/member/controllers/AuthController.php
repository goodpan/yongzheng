<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:06
 */
namespace wap\modules\member\controllers;

use wap\controllers\BaseController;
use wap\models\User;
use wap\models\Business;

/** 认证操作控制器
 * Class OperationController
 * @package pc\modules\member\controllers
 */
class AuthController extends BaseController
{
    public $enableCsrfValidation = false;
    public $layout = '@app/views/layouts/home.php';
    /**
     * 开发者认证入口
     * @return string
     * @author suwen
     */
    public function actionAuthentry(){
        return $this->render('authentry');
    }
    /**
     * 开发者认证
     * @return string
     * @author suwen
     */
    public function actionAuthchoose(){
        return $this->render('authchoose');
    }
    /**
     * 企业认证
     * @return string
     * @author suwen
     */
    public function actionAuthcomp(){
        return $this->render('authcomp');
    }
    /**
     * 个人认证
     * @return string
     * @author suwen
     */
    public function actionAuthperson(){
        return $this->render('authperson');
    }
}