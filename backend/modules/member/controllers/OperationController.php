<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:09
 */

namespace backend\modules\member\controllers;

use backend\controllers\BaseController;

/** 会员管理控制器
 * Class OperationController
 * @package backend\modules\member\controllers
 */
class OperationController extends BaseController{
    public function actionIndex(){
        echo 'backend member Operation index';
    }
}