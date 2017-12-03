<?php
/**
 * 证件模型
 * Created by PhpStorm.
 * User: lc
 * Date: 2017/11/27
 * Time: 19:54
 */
namespace pc\models;

use yii\db\ActiveRecord;

class Credentials extends ActiveRecord
{
    /**
     * 获取证件列表
     * @param string $name
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getCredentialsByName($name = '', $limit = 10, $page = 1)
    {
        $offset = ($page - 1) * $limit;
        $bMoreData = true;//是否有更多数据
        $where = '';
        if ($name) {
            $where = [
                ['like', 'cred_name', $name]
            ];
        }
        $credentials = $this->find()
            ->select('cred_name,cover,descr')
            ->where($where)
            ->offset($offset)
            ->limit($limit)
            ->all();
        if (count($credentials) != $limit) {
            $bMoreData = false;
        }
        $countItem = $this->find()->where($where)->count();
        return [
            'credentialsList' => $credentials,
            'bMoreData' => $bMoreData,
            'countItem' => $countItem
        ];
    }
}