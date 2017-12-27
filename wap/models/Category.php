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
     * 根据分类等级获取分类列表
     * @param int $limit
     * @param int $degree
     * @param string $where
     * @return array|\yii\db\ActiveRecord[]
     * @author wenzhen-chen
     * @time 2017-12-13 22:34:31
     */
    public function getClassifyListByDegree($limit = 10,$degree = 0,$where = ''){
        $List = self::find()
            ->select('name,id')
            ->where(['degree' => $degree])
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