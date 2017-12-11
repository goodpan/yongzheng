<?php
namespace wap\modules\info\controllers;

use Yii;
use yii\filters\AccessControl;
use wap\controllers\BaseController;
use wap\models\Customer;

/** 
 * Site controller
 */
class CustomerController extends BaseController
{
    public function actionSave(){
        $customer = new Customer();
        $customer->primaryKey = 4;
        $customer->name= 'wen ';
        $customer->address= '福建 厦门';
        $customer->save();
    }
    
    public function actionIndex(){
        $customers = Customer::find()->asArray()->all();
        echo "<pre>";
        print_r($customers);
    }
}