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
                    'count'=>(int)$count,
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
            $p_data = explode('_',$post['p_data']);//父级信息 wenzhen-chen 2018-1-3 01:41:00
            //封装插入数据
            $new_data['pid'] = $p_data['0'];
            $new_data['degree'] = $p_data['1']+1;
            $new_data['name'] = $post['name'];
            if ($cate->add($new_data)) {
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

    /**
     * 删除数据
     * @return mixed
     * @author wenzhen-chen
     * @time 2018-1-3 02:47:30
     */
    public function actionDel(){
        $data_id[] = Yii::$app->request->get('id');
        $cate = new Category();
        $result = $cate->deleteById($data_id);
        if($result){
            $msg = '删除成功';
        }else{
            $msg = '删除失败';
        }
        return json_encode([
            'code' => $result,
            'msg' => $msg
        ]);
    }
}