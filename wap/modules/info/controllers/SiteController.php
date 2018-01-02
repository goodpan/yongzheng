<?php
namespace wap\modules\info\controllers;

use wap\models\Category;
use wap\models\Credentials;
use wap\models\Business;

use wap\models\Requirements;
use pc\controllers\BaseController;


/** 网站信息控制器
 * Site controller
 */
class SiteController extends BaseController
{
    public $enableCsrfValidation = false;

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
        //获取cookie中的地址
//        $position = $_COOKIE['position'];
        $position = "福建省 厦门市 湖里区";
        list($provance,$city,$area) = explode(" ",$position);

        //获取首页证件
        $credentials = Credentials::find()
                ->where(['provance'=>$provance,'city'=>$city,'area'=>$area])
                ->limit(5)
                ->asArray()
                ->all();
        //获取商家信息
        $business = Business::find()
                ->where(['provance'=>$provance,'city'=>$city,'area'=>$area])
                ->limit(5)
                ->asArray()
                ->all();
//        var_dump($business);exit;
        return $this->render('index',array('data'=>$credentials,'business'=>$business));
    }
    /**
     * 分类页
     * @return mixed
     */
    public function actionClassify()
    {
        /** @var Category $category */
        $category = new Category();
        $firstClassifyList = $category->getClassifyListByDegree(10,0);
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
        //附加查询条件
        $where = "'is_hot => 1'";
        $hotClassifyList = $category->getClassifyListByDegree(10,3,$where);
        return $this->render('classify',[
            'dataClassifyList' => $dataClassifyList,
            'checkFirstKey' => $checkFirstKey,
            'hotClassifyList' => $hotClassifyList
        ]);
    }

    /**
     * 发布需求post-your-want
     * @author lmk
     * @return mixed
     */
    public function actionPostyourwant()
    {
        $uid = 1;
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            if($post['TypeID'] == 'company'){$post['TypeID'] = 1;}
            elseif ($post['TypeID'] == 'personal'){$post['TypeID'] = 2;}
            elseif ($post['TypeID'] == 'unlimited'){$post['TypeID'] = 3;}

            if($post['requ_id']){  //更新
                $requObj = Requirements::find()
                    ->select('*')
                    ->where(['user_id'=>$uid,'requ_id'=>$post['requ_id']])
                    ->one();
                if($requObj){
                    $requObj->sName = trim($post['sName']);
                    $requObj->sContent = trim($post['sContent']);
                    $requObj->TypeID = trim($post['TypeID']);
                    $requObj->sBudget = trim($post['sBudget']);
                    $requObj->sPhone = trim($post['sPhone']);
                    $requObj->dDeliverDate = $post['dDeliverDate'];
                    $requObj->update_time = time();
                    $requObj->user_id = $uid;
                    if ($requObj->save()) {
                        $data['status'] = 1;
                        $data['msg'] = '修改成功';
                        return json_encode($data);
                    } else {
                        $data['status'] = 0;
                        $data['msg'] = '修改失败';
                        return json_encode($data);
                    }
                }
            }else{ //插入
                $requObj = new Requirements();
                $requObj->sName = trim($post['sName']);
                $requObj->sContent = trim($post['sContent']);
                $requObj->TypeID = trim($post['TypeID']);
                $requObj->sBudget = trim($post['sBudget']);
                $requObj->sPhone = trim($post['sPhone']);
                $requObj->dDeliverDate = $post['dDeliverDate'];
                $requObj->create_time = time();
                $requObj->user_id = $uid;
                if ($requObj->save()) {
                    $data['status'] = 1;
                    $data['msg'] = '修改成功';
                    return json_encode($data);
                } else {
                    $data['status'] = 0;
                    $data['msg'] = '修改失败';
                    return json_encode($data);
                }
            }
        }
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
        $cred_id = \Yii::$app->request->get('id');
        $credential = new Credentials();
        $credentialDetail = $credential->getCredentialsById($cred_id);
        return $this->renderPartial('cred',[
            'credentialDetail' => $credentialDetail
        ]);
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
