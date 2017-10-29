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
use yii\data\Pagination;
use Yii;

class OperationLogic extends BaseLogic{
    public $admin;
    public function __construct($config = [])
    {
        $this->admin = new Admin();
    }
    public function getManagersByPager(){
        $admin = $this->admin;
        $count = $admin->getCount();
        $pageSize = Yii::$app->params['pageSize']['manage'];//获取配置文件中的pageSize参数
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $admin->getManagersByPager($pager->offset,$pager->limit);
        return [
            'managers'=>$managers,
            'pager'=>$pager,
        ];
    }
}