<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/6
 * Time: 14:38
 */

namespace pc\services\search;

class SearchService{
    public $_search = null;
    public function __construct(SearchInterface $search)
    {
        $this->_search = $search;
    }

    public function start(){
        $this->_search->toStart();
    }
}