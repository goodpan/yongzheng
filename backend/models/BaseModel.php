<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/23
 * Time: 21:00
 */

namespace backend\models;

use yii\base\Object;
use yii\db\ActiveRecord;
use yii\data\Pagination;
class BaseModel extends ActiveRecord{
    /** 新增
     * @param $data
     * @return bool
     */
    public function add($data){
        if($this->load($data,'')&&$this->validate()){
            $this->create_time = time();//创建时间
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }


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
        return self::find()->where($filedArr)->asArray()->one();
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

    /**
     * 递归获分类树(按等级进行排序)
     * 
     */
	public function getTree()
	{
        $result = $this->getAll();
		return $this->_reSort($result);
    }
    
    private function _reSort($data, $pid=0, $level=0, $isClear=TRUE)
	{
		static $ret = array();
		if($isClear)
            $ret = array();
		foreach ($data as $k => $v)
		{
			if($v['pid'] == $pid)
			{
				$v['level'] = $level;
				$ret[] = $v;
				$this->_reSort($data, $v['id'], $level+1, FALSE);
			}
		}
		return $ret;
    }
    
    public function getChildren($id=0)
	{
		$data = $this->getAll();
		return $this->_children($data, $id);
    }
    
	private function _children($data, $parent_id=0, $isClear=TRUE)
	{
		static $ret = array();
		if($isClear)
			$ret = array();
		foreach ($data as $k => $v)
		{
			if($v['pid'] == $parent_id)
			{
				$ret[] = $v['id'];
				$this->_children($data, $v['id'], FALSE);
			}
		}
		return $ret;
	}
}