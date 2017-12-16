<?php
namespace wap\modules\info\controllers;

use wap\models\Category;
use wap\models\Credentials;
use Yii;
use yii\filters\AccessControl;
use pc\controllers\BaseController;


/** 网站信息控制器
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * 首页
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * 分类页
     * @return mixed
     */
    public function actionClassify()
    {
        /** @var Category $category */
        $category = new Category();
        $firstClassifyList = $category->getfirstClassifyList(10);
        $dataClassifyList = [];//组装数据
        $e = 0;
        $checkFirstKey = '';//判断第一个分类，供页面首次加载判断样式用
        foreach ($firstClassifyList as $firstClassifyName => $item){
            $e ++;
            if($e == 1){
                $checkFirstKey = $item->name;
            }
            $dataClassifyList[$item->name] = [];
            $secondClasifyList = $category->getClassifyListByPid($item->id);
            foreach ($secondClasifyList as $key => $value){
                $dataClassifyList[$item->name][$value->name] = [];
                $dataClassifyList[$item->name][$value->name] = $category->getClassifyListByPid($value->id);
                //二级分类id
                $dataClassifyList[$item->name][$value->name]['secondClassifyId'] = $value->id;
            }
            //一级分类id
            $dataClassifyList[$item->name]['firstClassifyId'] = $item->id;
        }
        return $this->render('classify',[
            'dataClassifyList' => $dataClassifyList,
            'checkFirstKey' => $checkFirstKey
        ]);
    }

    /**
     * 发布需求post-your-want
     *
     * @return mixed
     */
    public function actionPostyourwant()
    {
        return $this->render('postyourwant');
    }

    /**
     * 联系方式
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new Contactform();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setflash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setflash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 关于我们
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @return string
     * @author suwen
     */
    public function actionSearch()
    {
        $this->layout = '@app/views/layouts/search.php';
        return $this->render('search');
    }

    /**
     * @return string
     * @author suwen
     */
    public function actionSearchcomp()
    {
        $this->layout = '@app/views/layouts/search.php';
        return $this->render('searchcomp');
    }

    /**
     * @return string
     * @author suwen
     */
    public function actionSearchperson()
    {
        $this->layout = '@app/views/layouts/search.php';
        return $this->render('searchperson');
    }

    /**
     * @return string
     * @author suwen
     */
    public function actionCred(){
        $this->layout = '@app/views/layouts/home.php';
        return $this->renderPartial('cred');
    }

    /**
     * @return string
     * @author suwen
     */
    public function actionCompany(){
        $this->layout = '@app/views/layouts/home.php';
        return $this->render('company');
    }

    /**
     * @return string
     * @author suwen
     */
    public function actionPersonal(){
        $this->layout = '@app/views/layouts/home.php';
        return $this->render('personal');
    }
}
