<?php
/**
 * @author: akun
 * @time: 2017/2/16 13:27
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;

/**
 * 响应返回json数据
 * @property int $status 响应状态码
 * @property int $msg 响应信息
 * @author akun
 * @time 2017-2-16 13:28:56
 */
class ResponseJson extends Component
{
    /**
     * 响应状态码
     */
    const CODE_SUCCESS = 1;//普通成功
    const CODE_FAIL = -1;//普通失败
    const CODE_FAIL_NEED_LOGIN = -2;//失败-需要登录
    const CODE_FAIL_LOST_PARAM = -3;//失败-参数丢失
    const CODE_FAIL_NOT_POWER = -4;//失败-没有权限
    const CODE_FAIL_REDIRECT = -5;//失败-需要重定向
    const CODE_FAIL_NODATA = -6; //失败-没有数据

    /**
     * 匹配状态码的默认信息
     * @return array
     * @author: akun
     * @time: 2017-2-16 13:48:29
     */
    public function matchMsg()
    {
        return [
            self::CODE_SUCCESS => '操作成功',
            self::CODE_FAIL => '操作失败',
            self::CODE_FAIL_NEED_LOGIN => '请先登录',
            self::CODE_FAIL_LOST_PARAM => '参数错误',
            self::CODE_FAIL_NOT_POWER => '没有权限',
            self::CODE_FAIL_NODATA => '找不到数据',
        ];
    }

    /**
     * 转成数组形式
     * @param bool $bSetResponse 是否设置返回数据
     * @return array
     * @author: akun
     * @time: 2017-2-16 14:10:18
     */
    public function toArray($bSetResponse = true)
    {
        if ($bSetResponse) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        $result = [
            'status' => $this->getStatus(),
            'msg' => $this->getMsg(),
            'data' => $this->getData()
        ];

        Yii::trace($result, '返回数据');
        return $result;
    }

    /**
     * 转化字符串
     * @return string
     * @author: akun
     * @time: 2017-2-16 14:10:04
     */
    public function __toString()
    {
        return Json::encode($this->toArray());
    }

    /**
     * @var int $_status 响应状态码
     */
    private $_status;

    /**
     * 获取响应状态码
     * @return int
     * @author: akun
     * @time: 2017-2-16 13:41:33
     */
    public function getStatus()
    {
        if (!isset($this->_status)) {
            $this->_status = self::CODE_SUCCESS;
        }

        return $this->_status;
    }

    /**
     * 设置响应状态码
     * @param $status
     * @return $this
     * @author: akun
     * @time: 2017-2-16 13:42:11
     */
    public function setStatus($status)
    {
        $this->_status = $status;
        $this->setMsg(ArrayHelper::getValue($this->matchMsg(), $this->getStatus()));
        return $this;
    }

    /**
     * @var string $_msg 响应信息
     */
    private $_msg;

    /**
     * 获取响应信息
     * @return string
     * @author: akun
     * @time: 2017-2-16 13:39:15
     */
    public function getMsg()
    {
        if (!isset($this->_msg)) {
            $this->_msg = ArrayHelper::getValue($this->matchMsg(), $this->getStatus());
        }

        return $this->_msg;
    }

    /**
     * 设置响应信息
     * @param $msg
     * @return $this
     * @author: akun
     * @time: 2017-2-16 13:39:59
     */
    public function setMsg($msg)
    {
        $this->_msg = $msg;
        return $this;
    }

    /**
     * @var array $_data 响应主体信息
     */
    private $_data;

    /**
     * 获取响应主体信息
     * @return array
     * @author: akun
     * @time: 2017-2-16 13:51:00
     */
    public function getData()
    {
        if (!isset($this->_data)) {
            $this->_data = [];
        }
        return $this->_data;
    }

    /**
     * 设置响应主体信息
     * @param array|null $data
     * @return $this
     * @author: akun
     * @time: 2017-2-16 13:51:46
     */
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * 增加响应主体信息
     * @param array $data
     * @return $this
     * @author: akun
     * @time: 2017-2-16 13:53:12
     */
    public function appendData($data = [])
    {
        return $this->setData(ArrayHelper::merge($this->getData(), $data));
    }

    /**
     * 删除响应信息中键值
     * @param $key
     * @return $this
     * @author: akun
     * @time: 2017-2-16 13:54:12
     */
    public function removeData($key)
    {
        ArrayHelper::remove($this->getData(), $key);
        return $this;
    }

    /**
     * 成功响应
     * @param array $data
     * @return $this
     * @author: akun
     * @time: 2017-2-16 13:56:02
     */
    public function success($data = [])
    {
        return $this->setStatus(self::CODE_SUCCESS)
            ->setData($data);
    }

    /**
     * 操作失败
     * @param string $msg
     * @param array $data
     * @return $this
     * @author: akun
     * @time: 2017-2-16 13:58:20
     */
    public function fail($msg = null, $data = [])
    {
        $this->setStatus(self::CODE_FAIL)
            ->setData($data);

        if (!is_null($msg)) {
            $this->setMsg($msg);
        }

        return $this;
    }

    /**
     * 请先登录
     * @param null $msg
     * @param array $data
     * @return $this
     * @author: akun
     * @time: 2017-2-16 14:05:24
     */
    public function needLogin($msg = null, $data = [])
    {
        $this->setStatus(self::CODE_FAIL_NEED_LOGIN)
            ->setData($data);

        if (!is_null($msg)) {
            $this->setMsg($msg);
        }

        return $this;
    }

    /**
     * 参数错误
     * @param array $params 错误参数列表
     * @return ResponseJson
     * @author: akun
     * @time: 2017-2-16 14:07:27
     */
    public function badParams($params = [])
    {
        return $this->setStatus(self::CODE_FAIL_LOST_PARAM)
            ->appendData($params);
    }

    /**
     * 没有权限
     * @return ResponseJson
     * @author: akun
     * @time: 2017-2-16 14:08:29
     */
    public function notPower()
    {
        return $this->setStatus(self::CODE_FAIL_NOT_POWER);
    }

    /**
     * 找不到数据
     * @return ResponseJson
     * @author YanZhongOuYang
     * @time: 2017-4-17 20:03:33
     */
    public function noData()
    {
        return $this->setStatus(self::CODE_FAIL_NODATA);
    }

    /**
     * 失败重定向
     * @param string $sUrl
     * @return ResponseJson
     * @author: akun
     * @time: 2017-3-8 10:10:36
     */
    public function failRedirect($sUrl)
    {
        return $this->setStatus(self::CODE_FAIL_REDIRECT)
            ->appendData(['sUrl' => $sUrl]);
    }
}