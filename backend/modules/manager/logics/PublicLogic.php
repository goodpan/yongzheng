<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/21
 * Time: 08:37
 */

namespace backend\modules\manager\logics;

use backend\logics\BaseLogic;
use backend\models\Admin;

class PublicLogic extends BaseLogic{
    /** 获取admin model
     * @return Admin
     */
    public static function getAdminModel(){
        return new Admin();
    }


}