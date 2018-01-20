<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:09
 */

namespace wap\modules\member\controllers;

use Yii;
use pc\models\User;
use wap\controllers\BaseController;

/** 会员空间控制器
 * Class SpaceController
 * @package pc\modules\member\controllers
 */
class SpaceController extends BaseController{
    //基本资料
    public function actionIndex(){
        $userid = Yii::$app->session->get('user_id');
        $userdata = User::find()
            ->where(['user_id'=>$userid])
            ->asArray()
            ->one();
        return $this->render('index',array('userdata'=>$userdata));
    }
}
