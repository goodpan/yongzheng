<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:12
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;

/** 短信管理控制器
 * Class SmsControllers
 * @package backend\modules\system\controllers
 */
class SmsController extends BaseController{
    public function actionIndex(){
        echo 'backend system sms index';
    }
}