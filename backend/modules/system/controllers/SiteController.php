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
    public function init(){
        $this->layout='@app/views/layouts/system.php';  
    }
    /** 后台首页控制台
     * @return string
     */
    public function actionIndex(){
        return $this->redirect('/manager/operation/managers');
    }

    /** 网站设置
     * @return string
     */
    public function actionSetting(){
        return $this->render('setting');
    }

    public function actionLinks(){
        
        return $this->render('links');
    }
}