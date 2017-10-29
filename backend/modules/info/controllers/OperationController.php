<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:47
 */
namespace backend\modules\info\controllers;

use backend\controllers\BaseController;

/** 信息管理控制器
 * Class OperationController
 * @package backend\modules\info\controllers
 */
class OperationController extends BaseController{
    public function init(){
        $this->layout='@app/views/layouts/info.php';  
    }

    public function actionIndex(){
        echo 'backend info Operation index';
    }   
    
    /** 证件列表
     * 
     */
    public function actionList(){
        return $this->render('list');
    }
}