<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:06
 */
namespace pc\modules\member\controllers;

use pc\controllers\BaseController;
<<<<<<< HEAD
use pc\models\User;
=======
use pc\models\Business;
use pc\models\Tesr;
>>>>>>> 801a6db265a658531201d8b62cdc0827a28f56d4

/** 会员操作控制器
 * Class OperationController
 * @package pc\modules\member\controllers
 */
class OperationController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        echo 'menber index';
    }

    /**
     * 登录
     * @return string
     * @author ldz
     */
    public function actionLogin()
    {
        $this->layout = false;
        return $this->render('login');
    }

    /**
     * 注册
     * @return string
     * @author ldz
     */
    public function actionRegister()
    {
        $this->layout = false;
        return $this->render('register');
    }

    /**
     * 忘记密码
     * @return string
     * @author ldz
     */
    public function actionForgetpwd()
    {
        $this->layout = false;
        return $this->render('forgetpwd');
    }

    /**
     * 商家入驻
     * @return string
     * @author wenzhen-chen
     */
    public function actionBusiness()
    {
        $this->layout = '@app/views/layouts/main.php';
        $user_id = 7;
        $data = [];
        $data['result'] = Business::getBusinessInfo($user_id);
        return $this->render('business',$data);
    }

    /**
     * 保存商家入驻信息
     */
    public function actionBusinessinfosave()
    {
        $data['comp_name'] = \Yii::$app->request->post('comp-name');//企业名称
        $data['comp_img'] = \Yii::$app->request->post('comp-img');//企业营业执照扫描件
        $data['comp_comf_img'] = \Yii::$app->request->post('comp-comf-img');//确认书扫描件
        $data['info_name'] = \Yii::$app->request->post('user-name');//姓名
        $data['info_num'] = \Yii::$app->request->post('info-num');//身份证号码
        $data['info_img'] = \Yii::$app->request->post('info-img');//身份证正面照
        $data['tel'] = \Yii::$app->request->post('tel');//联系电话
        $data['email'] = \Yii::$app->request->post('email');//邮箱
        //存储商家信息
        $result = Business::addOrEditBusiness($data);
        return json_encode([
            'status' => $result['status'],
            'msg' => $result['msg']
        ]);
    }

    /**
     * 图片保存
     */
    public function actionImagesave()
    {
        $base64_image = \Yii::$app->request->post('image');//base64源码
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)) {
            $type = $result[2];
            $new_file = __DIR__."/../../../web/image/business_img/";
            $tfile_name = time() . ".{$type}";
            $new_file = $new_file .$tfile_name ;
            $data = str_replace($result[1], '', $base64_image);//去除头部
            if (file_put_contents($new_file, base64_decode($data))) {
                $status = '1';
                $msg = '图片上传成功';
                $url = \Yii::$app->getHomeUrl()."image/business_img/".$tfile_name;
            } else {
                $status = '0';
                $msg = '图片上传失败';
                $url = '';
            }
            return json_encode([
                'status' => $status,
                'msg' => $msg,
                'url' => $url
            ]);
        }
    }
}