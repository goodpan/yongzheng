<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2017/11/18
 * Time: 21:34
 */
namespace  pc\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $rememberMe = true;

    /**
     * 定义规则
     */
    public function rules()
    {
        return [
            //on用来区分验证场景，只有在指定值中才有效，$this->scenario中指定
            ['sMobile','required','message'=>'请输入正确的邮箱或手机号','on'=>['login']],
            ['pwd','required','message'=>'请输入6-16位密码，区分大小写，不能使用空格！','on'=>['login']]
        ];
    }

    /**
     * 验证密码是否正确
     * @author ldz
     * @time 2017-12-9 22:49:40
     */
//    public function validatePass(){
//        if(!$this->hasErrors()){
//
//        }
//    }

    /**
     * 登录并保存到session
     * @param $data
     * @return bool
     * @author ldz
     * @time 2017-12说-9 22:49:59
     */
    public function login($data){

        $this->scenario = 'login';

        if ($this->load($data) && $this->validate()) {
            echo '<pre>';
            print_r(1111);
            exit();
            $lifetime = $this->rememberMe ? 24*3600 : 0;
            $session = \Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['User'] = [
                'UserID' => $this->admin_user,
                'isLogin' => 1,
            ];
            //登录成功更新用户表中相关信息
            $this->updateAll(['login_time' => time(), 'login_ip' => ip2long(\Yii::$app->request->userIP)]);
            return (bool)$session['UserID']['isLogin'];
        }
        echo '<pre>';
        print_r(222);
        exit();
       return false;


    }


    /**
     * 获取用户信息
     * @param $uid
     * @return array|null|ActiveRecord
     * @author liumingkang
     * 2017年12月1日21:53:08
     */
    public static function getUserinfo($uid){
        return self::find()->where(['user_id'=>$uid])->asArray()->one();
    }

}