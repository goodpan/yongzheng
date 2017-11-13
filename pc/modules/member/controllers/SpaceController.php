<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:09
 */

namespace pc\modules\member\controllers;

use pc\controllers\BaseController;

/** 会员空间控制器
 * Class SpaceController
 * @package pc\modules\member\controllers
 */
class SpaceController extends BaseController{

    //基本资料
    public function actionIndex(){
        $this->layout = '@app/views/layouts/main.php';
        return $this->render('grzx');
    }

    //联系方式
    public function actionLxfs(){
        $this->layout = '@app/views/layouts/main.php';
        return $this->render('lxfs');
    }

    //基本资料
    public function actionXgmm(){
        $this->layout = '@app/views/layouts/main.php';
        return $this->render('xgmm');
    }

    //基本资料
    public function actionZhgl(){
        $this->layout = '@app/views/layouts/main.php';
        return $this->render('zhgl');
    }


}
