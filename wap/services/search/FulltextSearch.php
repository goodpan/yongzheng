<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/6
 * Time: 14:51
 */
namespace pc\services\search;
use pc\services\search\SearchInterface;

class FulltextSearch implements SearchInterface{
    public function toStart()
    {
        echo "this is fulltext search";
        // TODO: Implement toStart() method.
    }
}