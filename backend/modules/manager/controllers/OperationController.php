<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 16:09
 */

namespace backend\modules\manager\controllers;
use backend\models\Admin;
use backend\controllers\BaseController;
use backend\modules\manager\logics\OperationLogic;
use Yii;

/** 会员管理控制器
 * Class OperationController
 * @package backend\modules\member\controllers
 */
class OperationController extends BaseController{
    
    public function actionIndex(){
        echo 'backend member Operation index';
    }

    /** 修改密码
     *  获取邮箱链接返回的get信息，如时间戳、用户名、token
     *  验证是否失效、token是否相等
     *  验证失败跳回登录页面
     *  验证成功显示修改密码页面
     *  post提交进入model验证，修改密码
     * @return string
     */
    public function actionMailchangepass()
    {
        $this->layout = false;
        $time = Yii::$app->request->get("timestamp");
        $adminuser = Yii::$app->request->get("admin_user");
        $token = Yii::$app->request->get("token");
        $model = new Admin;
        $myToken = $model->createToken($adminuser, $time);
        if ($token != $myToken) {
            $this->redirect(['/manager/public/login']);
            Yii::$app->end();
        }
        if (time() - $time > 300) {
            $this->redirect(['/manager/public/login']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changePass($post)) {
                Yii::$app->session->setFlash('changePassSuccess', '密码修改成功');
            }
        }
        $model->admin_user = $adminuser;
        return $this->render("mailchangepass", ['model' => $model]);

    }

    public function actionManagers()
    {
        $operLogic = new OperationLogic();
        $res = $operLogic->getManagersByPager();
        return $this->render("managers",$res);
    }

    public function actionGetmanagers(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Admin::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['manage'];//获取配置文件中的pageSize参数
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        if($managers){
            $res = [
                'code'=>1,
                'msg'=>'成功',
                'data'=>$managers
            ];
        }else{
            $res = [
                'code'=>0,
                'msg'=>'查询失败',
                'data'=>[]
            ];
        }
        return $res;
    }

    public function actionReg()
    {
        $this->layout = 'layout1';
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }
        $model->adminpass = '';
        $model->repass = '';
        return $this->render('reg', ['model' => $model]);
    }

    public function actionDel()
    {
        $adminid = (int)Yii::$app->request->get("admin_id");
        if (empty($adminid) || $adminid == 1) {
            $this->redirect(['manage/managers']);
            return false;
        }
        $model = new Admin;
        if ($model->deleteAll('admin_id = :id', [':id' => $admin_id])) {
            Yii::$app->session->setFlash('info', '删除成功');
            $this->redirect(['manage/managers']);
        }
    }

    public function actionChangeemail()
    {
        $this->layout = 'layout1';
        $model = Admin::find()->where('admin_user = :user', [':user' => Yii::$app->session['admin']['admin_user']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changeemail($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            }
        }
        $model->adminpass = "";
        return $this->render('changeemail', ['model' => $model]);
    }

    public function actionChangepass()
    {
        $this->layout = "layout1";
        $model = Admin::find()->where('admin_user = :user', [':user' => Yii::$app->session['admin']['admin_user']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changepass($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            }
        }
        $model->adminpass = '';
        $model->repass = '';
        return $this->render('changepass', ['model' => $model]);
    }
}