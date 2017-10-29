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
class OperationController extends BaseController{
    public function actionIndex(){
        echo 'menber index';
    }
    public function actionBusiness(){
        return $this->renderPartial('business');
    }
}