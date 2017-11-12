<?php
/**
 * Created by PhpStorm.
 * 无限级分类
 * Auth suwen
 *
 */
namespace backend\logics;

class UnLimitTree
{
    //组合一维数组
    Static Public function unlimitedForLevel ($cate, $html = '--', $pid = 0, $level = 0) {
        $arr = array();
        foreach ($cate as $k => $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level + 1;
                $v['html']  = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
            }
        }
        return $arr;
    }
    //组合多维数组
    Static Public function unlimitedForLayer ($cate, $c_ame = 'children', $pid = 0) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $v[$c_ame] = self::unlimitedForLayer($cate, $c_ame, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
    //传递一个子分类ID返回所有的父级分类
    Static Public function getParents ($cate, $id) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['id'] == $id) {
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v['pid']), $arr);
            }
        }
        return $arr;
    }
    //传递一个父级分类ID返回所有子分类ID
    Static Public function getChildsId ($cate, $pid) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, self::getChildsId($cate, $v['id']));
            }
        }
        return $arr;
    }
    //传递一个父级分类ID返回所有子分类
    Static Public function getChilds ($cate, $pid) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v;
                $arr = array_merge($arr, self::getChilds($cate, $v['id']));
            }
        }
        return $arr;
    }
    //获取权限树
    static  public function getAuthsFullTree($data,$pid=0){
        $tree = array();//每次都声明一个新数组用来放子元素
        foreach($data as $v){
            if($v['pid'] == $pid){//匹配子记录
                $v['children'] = self::getAuthsFullTree($data,$v['id']); //递归获取子记录
                if($v['children'] == null){
                    unset($v['children']);//如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）
                }
                $tree[] = $v;//将记录存入新数组
            }
        }
        return $tree;//返回新数组
    }


    static public function getDomeTree($data){
        static $html = '';
        foreach($data as $v){
            $html.='<div class="p-node">';
            $html.='<div class="c-node">|-----<input lay-verify="check" name="id[]" type="checkbox" lay-skin="primary" title="'.$v["name"].'" value="'.$v["id"].'"/></div>';
            if(isset($v['children'])){//匹配子记录
                self::getDomeTree($v['children']);
            }
            $html.='</div>';
        }
        return $html;//返回新数组
    }
}