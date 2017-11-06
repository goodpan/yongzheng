<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/5
 * Time: 22:58
 */

namespace backend\models;
use backend\logics\UnLimitTree;

class Category extends BaseModel
{
    public static function tableName()
    {
        return "{{%category}}";
    }

    public function rules()
    {
        return [
            ['cate_id','safe'],
            ['cate_name', 'required', 'message' => '分类名不能为空'],
            ['parent_id', 'required', 'message' => '请选择上级分类'],
        ];
    }

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

    public function getTree()
    {
        $result = $this->getAll();
        return $this->_reSort($result);
    }

    private function _reSort($data, $parent_id=0, $level=0, $isClear=TRUE)
    {
        static $ret = array();
        if($isClear)
            $ret = array();
        foreach ($data as $k => $v)
        {
            if($v['parent_id'] == $parent_id)
            {
                $v['level'] = $level;
                $ret[] = $v;
                $this->_reSort($data, $v['cate_id'], $level+1, FALSE);
            }
        }
        return $ret;
    }
}