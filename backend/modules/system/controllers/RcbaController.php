<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:16
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;

/** 权限管理控制器
 * Class RcbcController
 * @package backend\modules\system\controllers
 */
class RcbaController extends BaseController{
    public function actionIndex(){
        echo 'backend system rcba index';
    }

    /**
     * 角色列表
     */
    public function actionRoles(){
        return $this->render('roles');
    }

    /**
     * 添加、编辑角色
     */
    public function actionRole_info(){
        return $this->render('role_info');
    }

    public function actionRole_delete(){

    }
}