<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/23
 * Time: 21:00
 */

namespace backend\models;

use yii\db\ActiveRecord;
use yii\data\Pagination;
class BaseModel extends ActiveRecord{
    /** 获取总数
     * @return int|string
     */
    public function getCount(){
        return self::find()->count();
    }

    /** 根据id查询一条数据
     * @param array $filedArr
     * @return array|null|ActiveRecord
     */
    public function getOneById($filedArr=[]){
        return self::find()->where($filedArr)->one();
    }

    /** 查询所有数据
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAll(){
        return self::find()->asArray()->all();
    }

    /** 根据字段查找所有信息
     * @param $filed
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getListByFiled($filedArr=[]){
        return self::find()->select($filedArr)->asArray()->all();
    }

    /** 分页查询所有数据
     * @param $offset
     * @param $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAllByPager($offset=1,$limit=10){
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => self::getCount(),
        ]);
        return self::find()->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
    }

    /** 分页查询所有字段数据
     * @param $offset
     * @param $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getFiledByPager($offset=1,$limit=10,$filedArr=[]){
        return self::find()->scalar($filedArr)->offset($offset)->limit($limit)->all();
    }
}