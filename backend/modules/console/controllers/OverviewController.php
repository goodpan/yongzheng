<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/22
 * Time: 19:20
 */

namespace backend\modules\console\controllers;
use backend\controllers\BaseController;

/** 后台概览控制器
 * 
 */
class OverviewController extends BaseController{
    public function actionIndex(){
        return $this->render('index');
    }
}