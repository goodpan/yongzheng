<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/6
 * Time: 14:43
 */
namespace pc\services\search;

use pc\services\search\SearchInterface;

class LikeSearch implements SearchInterface{
    public function toStart()
    {
        echo "this is like search";
        // TODO: Implement toStart() method.
    }
}