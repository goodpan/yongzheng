<?php
/**
 * Created by PhpStorm.
 * User: lc
 * Date: 2017/12/13
 * Time: 22:30
 */
namespace wap\models;
use backend\models\BaseModel;

class Category extends BaseModel{
    /**
     * 获取分类列表
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     * @author wenzhen-chen
     * @time 2017-12-13 22:34:31
     */
    public function getFirstClassifyList($limit = 10){
        $List = self::find()
            ->select('name,id')
            ->where(['pid' => '0'])
            ->limit($limit)
            ->all();
        return $List;
    }

    /**
     * 根据pid获取子分类
     * @param int $pid
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getClassifyListByPid($pid = 0){
        return self::find()
            ->select('id,name')
            ->where(['pid' => $pid])
            ->all();
    }
}