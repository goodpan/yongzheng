<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/18
 * Time: 22:06
 */

namespace backend\models;


class Auth extends BaseModel
{
    public static function tableName()
    {
        return "{{%auth}}";
    }

    public function rules()
    {
        return [
            ['pid','safe'],
            ['name', 'required', 'message' => '权限名不能为空'],
            ['auth_m', 'required', 'message' => '模块名不能为空'],
            ['auth_c', 'required', 'message' => '控制器名不能为空'],
            ['auth_a', 'required', 'message' => '方法名不能为空']
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


    /************************************* 递归相关方法 *************************************/
    

    /** 设置权限等级格式
     * 
     */
    public function setPrefix($data, $p = "|-----")
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if ($data[$key - 1]['pid'] != $val['pid']) {
                    $num ++;
                }
            }
            if (array_key_exists($val['pid'], $prefix)) {
                $num = $prefix[$val['pid']];
            }
            $val['name'] = str_repeat($p, $num).$val['name'];
            $prefix[$val['pid']] = $num;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }

    public function getOptions()
    {
        $data = $this->getAll();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        $options = ['添加顶级分类'];
        foreach($tree as $cate) {
            $options[$cate['cateid']] = $cate['title'];
        }
        return $options;
    }

    public function getTreeList()
    {
        $data = $this->getAll();
        $tree = $this->getTree($data);
        return $tree = $this->setPrefix($tree);
    }

    /**获取权限树菜单
     * 
     */
    public static function getMenu()
    {
        $top = self::find()->where('pid = :pid', [":pid" => 0])->orderby('create_time asc')->asArray()->all();
        $data = [];
        foreach((array)$top as $k=>$auth) {
            $auth['children'] = self::find()->where("pid = :pid", [":pid" => $auth['id']])->asArray()->all();
            $data[$k] = $auth;
        }
        return $data;
    }

    /** 获取权限树菜单
     * 
     */
    public function getAuthsFullTree(){
        $data = $this->getAll();
        $res = $this->getAuthsTreeNodes($data);
        return $res;
    }

    /** 获取树节点
     * 
     */
    public function getAuthsTreeNodes($data,$pid=0){
        $tree = array();//每次都声明一个新数组用来放子元素  
        foreach($data as $v){  
            if($v['pid'] == $pid){//匹配子记录  
                $v['children'] = $this->getAuthsTreeNodes($data,$v['id']); //递归获取子记录
                if($v['children'] == null){  
                    unset($v['children']);//如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）  
                }  
                $tree[] = $v;//将记录存入新数组  
            }  
        }  
        return $tree;//返回新数组  
    } 
}