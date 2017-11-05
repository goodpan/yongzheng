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
use backend\logics\UnLimitTree;

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

    /** ajax获取权限分页数据
     * 
     */
    public function actionAuth_page(){
        $page = \Yii::$app->request->get('page');
        $limit = \Yii::$app->request->get('limit');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Auth();
        $count = $model->getCount();
        $auths = $model->getAuthsByPager($page,$limit);
        if($auths){
            //日期转换
            foreach($auths as $item){
                $item['create_time'] = date("Y-m-d H:i:s", $item['create_time']);
            }
            return [
                'code'=>0,
                'msg'=>'成功',
                'count'=>$count,
                'data'=>$auths
            ];
        };
        return [
            'code'=>0,
            'msg'=>'查询错误',
            'data'=>[]
        ];
    }

    /**
     * 添加权限
     */
    public function actionAuth_add(){
        $auth = new Auth();
        $model = $auth->getAuthsNameByAll();
        $parentData = $auth->getTree();
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
                $error = array_values($auth->getFirstErrors())[0];
                return [
                    'code'=>0,
                    'msg'=>'添加失败',
                    'error'=>$error,
                    'data'=>[]
                ];
            }
        }else{
            return $this->render('auth_add',['auths'=>$model,'parentData'=>$parentData]);
        }
    }

     /**
     * 编辑权限
     */
    public function actionAuth_edit(){
        $model = new Auth();
        $auth_id = \Yii::$app->request->get('auth_id');
        if(!$auth_id){
            \Yii::$app->session->setFlash('info','参数错误');
        }
        $auth = $model->getOneById('auth_id',$auth_id);
        $parentData = $model->getTree();
        return $this->render('auth_edit',['auth'=>$auth,'parentData'=>$parentData]);
    }

    /**
     * 添加角色
     */
    public function actionRole_add(){
        $model = new Auth();
        $data = $model->getData();
        $auth_list = UnLimitTree::getAuthsFullTree($data);
        return $this->render('role_add',['auth_list'=>$auth_list]);
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