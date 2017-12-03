<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:47
 */
namespace backend\modules\info\controllers;

use backend\controllers\BaseController;
use backend\models\Category;
use backend\models\Credentials;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use Yii;

/** 信息管理控制器
 * Class OperationController
 * @package backend\modules\info\controllers
 */
class OperationController extends BaseController{
    public $enableCsrfValidation = false;
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
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new Credentials();
            $get = Yii::$app->request->get();
            if(!$get){
                return [
                    'code'=>-1,
                    'msg'=>'参数错误',
                    'data'=>[]
                ];
            }
            $count = $model->getCount();
            $list = $model->getCredJoinCateByPager($get['page'],$get['limit']);
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

    /** 添加证件
     * @return string
     */
    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $model = new Credentials();
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
        //获取分类options
        $cateModel = new Category();
        $cateList = $cateModel->getTree();
        return $this->render('add',['cateList'=>$cateList]);
    }


    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $model = new Credentials();
            if($model->edit($post)){
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
        $cred_id = Yii::$app->request->get('id');
        if(!isset($cred_id)){
            echo '参数错误';
            exit;
        }
        //获取分类options
        $cateModel = new Category();
        $cateList = $cateModel->getTree();
        $credModel = new Credentials();
        $cred = $credModel->getOneById(['cred_id'=>$cred_id]);

        return $this->render('edit',['cateList'=>$cateList,'cred'=>$cred]);
    }

    /** 上传图片
     * @return string
     */
    public function actionUpload()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new UploadForm();
        if (Yii::$app->request->isAjax) {
            $model->credFile = UploadedFile::getInstance($model, 'credFile');
            if ($model->credFile && $model->validate()) {
                $dir = '/uploads/cred/';
                //如果文件夹不存在，则新建文件夹
                if (!file_exists(Yii::getAlias('@webroot') .'/'. $dir)) {
                    FileHelper::createDirectory(Yii::getAlias('@webroot') .'/'. $dir, 777);
                }
                $path =$dir. $model->credFile->baseName . '.' . $model->credFile->extension;
                if($model->credFile->saveAs(Yii::getAlias("@webroot").'/'.$path) === true){
                    return [
                        'code'=>0,
                        'msg'=>'上传成功',
                        'data' => [
                            'src'=>$path
                        ]
                    ];
                }
            }
        }
    }
}