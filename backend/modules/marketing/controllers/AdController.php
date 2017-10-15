<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:02
 */

namespace backend\modules\marketing\controllers;

use backend\controllers\BaseController;

/** 广告控制器
 * Class AdController
 * @package backend\modules\marketing\controllers
 */
class AdController extends BaseController{
    public function actionIndex(){
        echo 'backend marketing ad index';
    }
}