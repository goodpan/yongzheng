<?php
namespace backend\modules\test\controllers;

use backend\controllers\BaseController;


class SiteController extends BaseController{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        if(!$action instanceof \yii\web\ErrorAction) {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }

        return parent::beforeAction($action);
    }

    public function actionIndex(){
        echo 111;exit;
    }
}