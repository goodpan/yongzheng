<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:44
 */

namespace backend\modules\info\controllers;

use backend\controllers\BaseController;

/** 信息分类控制器
 * Class ClassifyController
 * @package backend\modules\info\controllers
 */
class ClassifyController extends BaseController{
    public function init(){
        $this->layout='@app/views/layouts/info.php';  
    }

    public function actionIndex(){
        echo 'backend info classify index';
    }

    /** 证件分类列表
     * 
     */
    public function actionList(){
        return $this->render('list');
    }
}