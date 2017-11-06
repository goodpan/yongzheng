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
use backend\models\Role;
use backend\models\RoleAuth;

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

    public function actionRole_page(){
        $page = \Yii::$app->request->get('page');
        $limit = \Yii::$app->request->get('limit');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Role();
        $count = $model->getCount();
        $roles = $model->getAllByPager($page,$limit);
        if($roles){
            //日期转换
            foreach($roles as $item){
                $item['create_time'] = date("Y-m-d H:i:s", $item['create_time']);
            }
            return [
                'code'=>0,
                'msg'=>'成功',
                'count'=>$count,
                'data'=>$roles
            ];
        };
        return [
            'code'=>0,
            'msg'=>'查询错误',
            'data'=>[]
        ];
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
        $auths = $model->getAllByPager($page,$limit);
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
        $model = $auth->getListByFiled(['auth_id','auth_name']);
        $parentData = $auth->getTree();
        if(\Yii::$app->request->isAjax){
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
        $data = $model->getTree();
        $tree = UnLimitTree::getAuthsFullTree($data);
        $auth_list = UnLimitTree::getDomeTree($tree);
        if(\Yii::$app->request->isPost){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = \Yii::$app->request->post();
            $role = new Role();
            //先添加角色，在添加角色权限表
            if ($role->add($post)) {
                $role_id = $role->attributes['role_id'];
                $role_auth = new RoleAuth();
                $data = [];
                foreach ($post['auth_id'] as $v){
                    $item[0]=$role_id;
                    $item[1]=$v;
                    $item[2]=time();
                    $data[]=$item;
                }
                $res = $role_auth->batchAdd($data);
                if($res>0){
                    return [
                        'code'=>1,
                        'msg'=>'添加成功',
                        'data'=>[]
                    ];
                }else{
                    $error = array_values($role->getFirstErrors())[0];
                    return [
                        'code'=>-1,
                        'msg'=>'批量添加出错',
                        'error'=>$error,
                        'data'=>[]
                    ];
                }
            }else{
                $error = array_values($role->getFirstErrors())[0];
                return [
                    'code'=>0,
                    'msg'=>'添加失败',
                    'error'=>$error,
                    'data'=>[]
                ];
            }
        }
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