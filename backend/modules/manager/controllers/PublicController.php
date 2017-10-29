<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/17
 * Time: 22:34
 */

namespace backend\modules\manager\controllers;
use yii\web\Controller;
use backend\modules\manager\logics\PublicLogic;
use Yii;

/** 会员相关公共类（登录、忘记密码等）
 * Class PublicController
 * @package backend\modules\member\controllers
 */
class PublicController extends Controller{
    /** 登录
     * 判断是否已经登录，ok则跳到后台首页
     * post提交情况下做登录处理，在model中对提交数据进行验证，验证成功存入session，更新登录信息
     * @return string
     */
    public function actionLogin(){
        $model = PublicLogic::getAdminModel();
        //已经登录
        if(PublicLogic::isLogin()){
            $this->redirect(['/console/overview/index']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                $this->redirect(['/console/overview/index']);
                Yii::$app->end();
            }
        }
        return $this->renderPartial("login", ['model' => $model]);
    }

    /** 退出后台
     *  清空session
     *  session中不存在session['admin']['isLogin']则跳转到登录页面
     */
    public function actionLogout()
    {
        Yii::$app->session->removeAll();
        if (!PublicLogic::isLogin()) {
            $this->redirect(['/manager/public/login']);
            Yii::$app->end();
        }
        $this->goback();
    }

    /** 找回密码
     *  让用户输入邮箱，验证邮箱是否输入正确（之前填写的邮箱）
     *  利用yii的emalier类给指定用户填写的邮箱发送邮件
     * @return string
     * @auth suwen
     * @date
     */
    public function actionSeekpassword()
    {
        $model = PublicLogic::getAdminModel();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->seekPass($post)) {
                Yii::$app->session->setFlash('sendEmailSuccess', '电子邮件已经发送成功，请查收');
            }
        }
        return $this->renderPartial("seekpassword", ['model' => $model]);
    }


}