<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:14
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;

/** 网站设置控制器
 * Class SiteController
 * @package backend\modules\system\controllers
 */
class SiteController extends BaseController{
    public function actionIndex(){
        echo 'bakend system site index';
    }
}