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
        $this->layout='@app/views/layouts/system.php';
        $operLogic = new OperationLogic();
        $res = $operLogic->getManagersByPager();
        return $this->render("managers",$res);
    }

    public function actionGetmanagers(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $operLogic = new OperationLogic();
        $managerData = $operLogic->getManagersByPager();
        if($managerData){
            $res = [
                'code'=>1,
                'msg'=>'成功',
                'data'=>$managerData['managers']
            ];
        }else{
            $res = [
                'code'=>0,
                'msg'=>'失败',
                'data'=>[]
            ];
        }
        return $res;
    }

    /** 添加新管理员
     * 
     */
    public function actionReg()
    {
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }
        $model->admin_pass = '';
        $model->repass = '';
        return $this->renderPartial('reg', ['model' => $model]);
    }

    /** 删除
     * @return bool
     */
    public function actionDel()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $admin_id = (int)Yii::$app->request->get("admin_id");
        if (empty($admin_id) || $admin_id == 1) {
            return [
                'code'=>'-1',
                'msg'=>'参数错误',
                'data'=>[]
            ];
        }
        $model = new Admin;
        if ($model->deleteAll('admin_id = :id', [':id' => $admin_id])) {
            return [
                'code'=>'1',
                'msg'=>'删除成功',
                'data'=>[]
            ];
        }else{
            return [
                'code'=>'-2',
                'msg'=>'删除失败',
                'data'=>[]
            ];
        }
    }

    public function actionBaseinfo(){
        $admin = new Admin();
        $model = $admin->getModelByUser();
        if(!$model){
            return $this->render('baseinfo');
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changeemail($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            }else{
                Yii::$app->session->setFlash('info', '修改失败，邮箱已经存在或者系统错误');
            }
        }
        $model->admin_pass = "";
        return $this->render('baseinfo', ['model' => $model]);
    }

    /** 修改管理员密码
     * 
     */
    public function actionChangepass()
    {
        $admin = new Admin();
        $model = $admin->getModelByUser();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changepass($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            }
        }
        $model->admin_pass = '';
        $model->repass = '';
        return $this->render('changepass', ['model' => $model]);
    }
}