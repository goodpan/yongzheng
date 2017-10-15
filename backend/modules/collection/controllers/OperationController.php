<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:24
 */

namespace backend\modules\collection\controllers;

use backend\controllers\BaseController;

/** 采集操作控制器
 * Class OperationController
 * @package backend\modules\collection\controllers
 */
class OperationController extends BaseController{
    public function actionIndex(){
        echo 'backend collection operation index';
    }
}