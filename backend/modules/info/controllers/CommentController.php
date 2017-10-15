<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/10/14
 * Time: 15:36
 */
namespace backend\modules\info\controllers;
use backend\controllers\BaseController;

/** 评论控制器
 * Class CommentController
 * @package backend\modules\info\controllers
 */
class CommentController extends BaseController{
    public function actionIndex(){
        echo 'backend info comment index';
    }
}