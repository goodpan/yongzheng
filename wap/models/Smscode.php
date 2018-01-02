<?php
/**
 * Created by PhpStorm.
 * User: ldz
 * Date: 2017/12/13
 * Time: 22:50
 */
namespace  wap\models;
use yii\db\ActiveRecord;

class Smscode extends ActiveRecord
{
    //云片网短信apikey   不可泄露
    public $apikey  = "df1a842ffafc593b46badcc962664bcd";

    /**
     * 短信发送
     * @param string $sMobile  手机号
     * @param string $sType    验证类型
     * @param string $text     发送内容
     * @author ldz
     * @time 2017-12-16 12:02:11
     */
    public function sendCode($sMobile = '',$sType = ''){
        $code = rand(1000, 9999);

        $text="您的验证码是".$code;

        $re_array =  $this->Curl($text,$sMobile);
        \Yii::trace($re_array,'发送结果：');
        //保存短信发送记录
        $smscode = new self();
        $smscode->sCode = $code;
        $smscode->sMobile = $sMobile;
        $smscode->sType = $sType;
        $smscode->sContent = $text;
        $smscode->sCreateDate = time();
        $smscode->sSendResult = $re_array['msg'];

        if($re_array['code'] == 0){//发送成功
            $smscode->sStatus = 1;
            $smscode->sSendedDate = time();
            $return['status'] = true;
            $return['msg'] = '短信发送成功';
        }else{
            $smscode->sStatus = 1;
            $smscode->sSendedDate = time();
            $return['status'] = false;
            $return['msg'] = $re_array['msg'];
        }
        $smscode->save();

        return $return;

    }

    public function Curl($text,$sMobile){
        $ch = curl_init();
        /* 设置验证方式 */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));
        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /* 设置超时时间*/
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 发送短信
        $data=array('text'=>$text,'apikey'=>$this->apikey,'mobile'=>$sMobile);
        $json_data = $this->send($ch,$data);
        $array = json_decode($json_data,true);
        return $array;
    }

    function send($ch,$data){
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';//单条短信发送
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }

    function checkErr($result,$error) {
        if($result === false)
        {
            echo 'Curl error: ' . $error;
        }
        else
        {
//            echo '操作完成没有任何错误';
        }
    }

}