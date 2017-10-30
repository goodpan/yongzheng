<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:16
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use backend\models\Auth;
use phpDocumentor\Reflection\Types\Parent_;

/** 权限管理控制器
 * Class RcbcController
 * @package backend\modules\system\controllers
 */
class RbacController extends BaseController{
    public $enableCsrfValidation = false;
    public function init(){
        $this->layout='@app/views/layouts/system.php';
    }
    
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
     * 权限列表
     */
    public function actionAuths(){
        return $this->render('auths');
    }
    /**
     * 添加权限
     */
    public function actionAuth_add(){
        $auth = new Auth();
        $model = $auth->getAuthsNameByAll();
        if(\Yii::$app->request->isPost){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = \Yii::$app->request->post();
            if ($auth->add($post)) {
                return [
                  'code'=>1,
                  'msg'=>'添加成功',
                  'data'=>[]
                ];
            } else {
                $msg = $auth->getErrors();
                return [
                    'code'=>0,
                    'msg'=>$msg,
                    'data'=>[]
                ];
            }
        }else{
            return $this->render('auth_add',['auths'=>$model]);
        }
    }

    /**
     * 添加、编辑角色
     */
    public function actionRole_add(){
        return $this->render('role_add');
    }
    /**
     * 添加、编辑角色
     */
    public function actionRole_edit(){
        return $this->render('role_edit');
    }

    /**
     * 删除角色
     */
    public function actionRole_del(){

    }
    
    public function actionRoledata(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'code'=> 0,
            'msg'=>"",
            'count'=> 3,
            'data'=>[
                [
                    'id'=>1000,
                    'name'=> "user-60",
                    'description'=>"男",
                    'create_time'=> "2017-5-5",
                ],
                [
                    'id'=>1001,
                    'name'=> "user-60",
                    'description'=>"男",
                    'create_time'=> "2017-5-5",
                ],
                [
                    'id'=>1002,
                    'name'=> "user-60",
                    'description'=>"男",
                    'create_time'=> "2017-5-5",
                ],
                [
                    'id'=>1003,
                    'name'=> "user-60",
                    'description'=>"男",
                    'create_time'=> "2017-5-5",
                ],
                [
                    'id'=>1004,
                    'name'=> "user-60",
                    'description'=>"男",
                    'create_time'=> "2017-5-5",
                ],
               
            ]
        ];
    }
}