<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:44
 */

namespace backend\modules\info\controllers;

use backend\controllers\BaseController;
use backend\models\Category;
use Yii;

/** 信息分类控制器
 * Class ClassifyController
 * @package backend\modules\info\controllers
 */
class ClassifyController extends BaseController{
    public $enableCsrfValidation = false;
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
        if(Yii::$app->request->isAjax){
            $page = \Yii::$app->request->get('page');
            $limit = \Yii::$app->request->get('limit');
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new Category();
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
        return $this->render('list');
    }

    public function actionAdd(){
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $cate = new Category();
            if ($cate->add($post)) {
                return [
                    'code'=>1,
                    'msg'=>'添加成功',
                    'data'=>[]
                ];
            } else {
                $error = array_values($cate->getFirstErrors())[0];
                return [
                    'code'=>0,
                    'msg'=>'添加失败',
                    'error'=>$error,
                    'data'=>[]
                ];
            }
        }
        $cate = new Category();
        $cates = $cate->getTree();
        return $this->render('add',['cates'=>$cates]);
    }
}