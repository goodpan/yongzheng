<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:09
 */

namespace wap\modules\member\controllers;

use wap\controllers\BaseController;

/** 会员空间控制器
 * Class SpaceController
 * @package pc\modules\member\controllers
 */
class SpaceController extends BaseController{
    //基本资料
    public function actionIndex(){
        return $this->render('index');
    }
}
