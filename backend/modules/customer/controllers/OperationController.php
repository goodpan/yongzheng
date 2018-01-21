<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:47
 */
namespace backend\modules\customer\controllers;

use backend\controllers\BaseController;
use backend\models\Category;
use backend\models\Credentials;
use backend\modules\User;
use Yii;

/** 信息管理控制器
 * Class OperationController
 * @package backend\modules\info\controllers
 */
class OperationController extends BaseController{
//    public $enableCsrfValidation = false;
//    public function init(){
//        $this->layout='@app/views/layouts/customer.php';
//    }

    public function actionIndex(){
        echo 123;exit;
        echo 'backend info Operation index';
    }   
    
    /** 用户列表
     * 
     */
    public function actionList(){
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new User();
            $get = Yii::$app->request->get();
            if(!$get){
                return [
                    'code'=>-1,
                    'msg'=>'参数错误',
                    'data'=>[]
                ];
            }
            $count = $model->getCount();
            $list = $model->getUserByPager($get['page'],$get['limit']);
            if($list){
                //日期转换
                foreach($list as $item){
                    $item['create_time'] = date("Y-m-d H:i:s", $item['create_time']);
                }
                return [
                    'code'=>0,
                    'msg'=>'查询成功',
                    'count'=>$count,
                    'data'=>$list
                ];
            }else{
                return [
                    'code'=>-2,
                    'msg'=>'查询失败',
                    'data'=>[]
                ];
            }
        }
        return $this->render('list');
    }

    /** 添加个人信息
     * @return string
     */
    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $model = new User();
            if($model->add($post)){
                return [
                    'code'=>0,
                    'msg'=>'添加成功',
                    'data'=>[]
                ];
            }else{
                $error = array_values($model->getFirstErrors())[0];
                return [
                    'code'=>0,
                    'msg'=>'添加失败',
                    'error'=>$error,
                    'data'=>[]
                ];
            }
        }
        return $this->render('add');
    }

    /** 修改个人信息
     * @return string
     */
    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $model = new User();
            if($model->edit($post)){
                return [
                    'code'=>0,
                    'msg'=>'修改成功',
                    'data'=>[]
                ];
            }else{
                $error = array_values($model->getFirstErrors())[0];
                return [
                    'code'=>0,
                    'msg'=>'修改失败',
                    'error'=>$error,
                    'data'=>[]
                ];
            }
        }
        $userid = Yii::$app->request->get('id');
        if(!isset($cred_id)){
            echo '参数错误';
            exit;
        }
        //用户信息
        $User = new User();
        $userdata = $User->getOneById(['user_id'=>$userid]);

        return $this->render('edit',['userdata'=>$userdata]);
    }

    public function actionDelete(){

    }

}