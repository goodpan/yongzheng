<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/18
 * Time: 22:06
 */

namespace backend\models;

use yii\db\ActiveRecord;


class Admin extends ActiveRecord
{
    public $rememberMe = true;
    public $repass;
    public static function tableName()
    {
        return "{{%admin}}";
    }

    public function attributeLabels()
    {
        return [
            'admin_user' => '管理员账号',
            'admin_email' => '管理员邮箱',
            'admin_pass' => '管理员密码',
            'repass' => '确认密码',
        ];
    }

    public function rules()
    {
        //on用来区分验证场景，只有在指定值中才有效，$this->scenario中指定
        return [
            ['admin_user', 'required', 'message' => '管理员账号不能为空', 'on' => ['login', 'seekpass','changepass', 'adminadd', 'changeemail']],
            ['admin_pass', 'required', 'message' => '管理员密码不能为空', 'on' => ['login', 'changepass', 'adminadd', 'changeemail']],
            ['rememberMe', 'boolean', 'on' => 'login'],
            ['admin_pass', 'validatePass', 'on' => ['login', 'changeemail']],
            ['admin_email', 'required', 'message' => '电子邮箱不能为空', 'on' => ['seekpass', 'adminadd', 'changeemail']],
            ['admin_email', 'email', 'message' => '电子邮箱格式不正确', 'on' => ['seekpass', 'adminadd', 'changeemail']],
            ['admin_email', 'unique', 'message' => '电子邮箱已被注册', 'on' => ['adminadd', 'changeemail']],
            ['admin_user', 'unique', 'message' => '管理员已被注册', 'on' => 'adminadd'],
            ['admin_email', 'validateEmail', 'on' => 'seekpass'],
            ['repass', 'required', 'message' => '确认密码不能为空', 'on' => ['changepass', 'adminadd']],
            ['repass', 'compare', 'compareAttribute' => 'admin_pass', 'message' => '两次密码输入不一致', 'on' => ['changepass', 'adminadd']],
        ];
    }

    public function validatePass()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('admin_user = :user and admin_pass = :pass', [":user" => $this->admin_user, ":pass" => md5($this->admin_pass)])->one();
            if (is_null($data)) {
                $this->addError("admin_pass", "用户名或者密码错误");
            }
        }
    }

    public function validateEmail()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('admin_user = :user and admin_email = :email', [':user' => $this->admin_user, ':email' => $this->admin_email])->one();
            if (is_null($data)) {
                $this->addError("admin_email", "管理员电子邮箱不匹配");
            }
        }
    }

    /** 登录操作
     * @param $data
     * @return bool
     */
    public function login($data)
    {
        //指定验证场景为login
        $this->scenario = "login";
        if ($this->load($data) && $this->validate()) {
            $lifetime = $this->rememberMe ? 24*3600 : 0;
            $session = \Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['admin'] = [
                'admin_user' => $this->admin_user,
                'isLogin' => 1,
            ];
            //登录成功更新用户表中相关信息
            $this->updateAll(['login_time' => time(), 'login_ip' => ip2long(\Yii::$app->request->userIP)], 'admin_user = :user', [':user' => $this->admin_user]);
            //返回存储session是否成功的状态
            return (bool)$session['admin']['isLogin'];
        }
        return false;
    }

    public function seekPass($data)
    {
        $this->scenario = "seekpass";//指定验证场景为seekpass
        if ($this->load($data) && $this->validate()) {
            $time = time();
            $token = $this->createToken($data['Admin']['admin_user'], $time);
            //加载邮件模版,参数可以在视图文件中使用
            $mailer = \Yii::$app->mailer->compose('seekpass', ['admin_user' => $data['Admin']['admin_user'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("suwen0603@163.com");
            $mailer->setTo($data['Admin']['admin_email']);
            $mailer->setSubject("雍正网-找回密码");

            if ($mailer->send()) {
                return true;
            }
        }
        return false;

    }

    public function createToken($adminuser, $time)
    {
        return md5(md5($adminuser).base64_encode(\Yii::$app->request->userIP).md5($time));
    }

    public function changePass($data)
    {
        $this->scenario = "changepass";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['admin_pass' => md5($this->admin_pass)], 'admin_user = :user', [':user' => $this->admin_user]);
        }
        return false;
    }

    public function reg($data)
    {
        $this->scenario = 'adminadd';
        if ($this->load($data) && $this->validate()) {
            $this->adminpass = md5($this->adminpass);
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function changeEmail($data)
    {
        $this->scenario = "changeemail";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['admin_email' => $this->adminemail], 'admin_user = :user', [':user' => $this->adminuser]);
        }
        return false;
    }

    public function getManagersByPager($pager){
        $managers = self::find()->offset($pager->offset)->limit($pager->limit)->all();
        return $managers;
    }

}
