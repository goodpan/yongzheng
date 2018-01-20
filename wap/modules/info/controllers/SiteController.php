<?php
namespace wap\modules\info\controllers;

use Stecman\Component\Symfony\Console\BashCompletion\EnvironmentCompletionContext;
use wap\models\Category;
use wap\models\Credentials;
use wap\models\Business;
use wap\models\Requirements;
use wap\models\SmsCode;


use wap\controllers\BaseController;
use Yii;
use yii\helpers\ArrayHelper;

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
        list($provance, $city, $area) = explode(" ", $position);

        //获取首页证件
        $credentials = Credentials::find()
            ->where(['provance' => $provance, 'city' => $city, 'area' => $area])
            ->limit(5)
            ->asArray()
            ->all();
        //获取商家信息
        $business = Business::find()
            ->where(['provance' => $provance, 'city' => $city, 'area' => $area])
            ->limit(5)
            ->asArray()
            ->all();
//        var_dump($business);exit;
        return $this->render('index', array('data' => $credentials, 'business' => $business));
    }

    /**
     * 分类页
     * @return mixed
     */
    public function actionClassify()
    {
        /** @var Category $category */
        $category = new Category();
        $firstClassifyList = $category->getClassifyListByDegree(10, 0);
        $dataClassifyList = [];//组装数据
        $e = 0;
        $checkFirstKey = '';//判断第一个分类，供页面首次加载判断样式用
        foreach ($firstClassifyList as $firstClassifyName => $item) {
            $e++;
            if ($e == 1) {
                $checkFirstKey = $item->name;
            }
            $dataClassifyList[$item->name] = [];
            $secondClasifyList = $category->getClassifyListByPid($item->id);
            foreach ($secondClasifyList as $key => $value) {
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
        $hotClassifyList = $category->getClassifyListByDegree(10, 3, $where);
        return $this->render('classify', [
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
        $userid = Yii::$app->session->get('user_id');

        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();

            $smsCode = Smscode::find()->select('sCode')->where(['sMobile'=>$post['sPhone']])->orderBy('sCreateDate DESC')->one();

            if(!$smsCode || $post['sCode'] != $smsCode['sCode'] ){
                return $this->asJson(['status' => 0, 'msg'=>'验证码不正确']);
            }

            if($post['TypeID'] == 'company'){$post['TypeID'] = 1;}
            elseif ($post['TypeID'] == 'personal'){$post['TypeID'] = 2;}
            elseif ($post['TypeID'] == 'unlimited'){$post['TypeID'] = 3;}

            $requObj = new Requirements();
            $requObj->sName = trim($post['sName']);
            $requObj->sContent = trim($post['sContent']);
            $requObj->TypeID = trim($post['TypeID']);
            $requObj->sBudget = trim($post['sBudget']);
            $requObj->sPhone = trim($post['sPhone']);
            $requObj->dDeliverDate = $post['dDeliverDate'];
            $requObj->update_time = time();
            $requObj->user_id = $userid;
            if ($requObj->save()) {
                $data['status'] = 1;
                $data['msg'] = '添加成功';
                return json_encode($data);
            } else {
                $data['status'] = 0;
                $data['msg'] = '添加失败';
                return json_encode($data);
            }
        }

        return $this->render('postyourwant');
    }

    /**
     * 发送发布需求短信验证码
     * @return string
     * @author ldz
     * @time 2017-12-16 12:42:45
     */
    public function actionSendstcode()
    {
        $sMobile = Yii::$app->request->post('sMobile');   //手机号
        $sType  = Yii::$app->request->post('sType');      //类型
        return $this->getSmscode($sMobile,$sType);
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
     * 搜索证件
     * @param int $page 页数
     * @param int $limit 每页条数
     * @return string
     * @author ldz
     * @time 2017-12-31 19:20:16
     */
    public function actionSearch($page = 1, $limit = 10)
    {
//        $this->layout = '@app/views/layouts/search.php';
        $data = [];
        if (Yii::$app->request->isAjax) {
            $request = \Yii::$app->request;
            //费用排序(默认升序，就是费用从低到高排序)
            if ($request->get('sortby')) {
                $orderBy = $request->get('sortby') . " " . $request->get('ascdesc');
            } else {
                $orderBy = 'cost asc';
            }

            //关键字
            $sName = $request->get('sName', '');
            //所在地
            $sAddress = $request->get('sAddress', '');

            if ($sAddress) {
                $arrAddress = explode(',', $sAddress);
                $ProvinceName = $arrAddress[0];
                $CityName = $arrAddress[1];
                $sAddress = str_ireplace(',', ' ', $sAddress);
            }

            $where = [
                'or',
                ['like', 'cred_name', $sName],
                ['like', 'descr', $sName]
            ];

            $arrCreden = Credentials::find()
                ->select('cred_id,cred_name,cost,cover,provance,city,area')
                ->where($where)
                ->limit($limit)
                ->orderBy($orderBy)
                ->all();

            $arrList = [];
            $data['arrList'] = [];
            foreach ($arrCreden as $creden) {
                $arrList['sName'] = $creden->cred_name;
                $arrList['fPrice'] = $creden->cost;
                $arrList['sImageUrl'] = $creden->cover;
                $arrList['sAddress'] = $creden->provance . ' ' . $creden->city;
                $arrList['sUrl'] = 'https://www.baidu.com/';
                $data['arrList'][] = $arrList;
            }

            return json_encode($data);
        }

        //分类
        $categroy = Category::find()->select('id,name')->where(['pid' => -1])->limit(3)->all();

        foreach ($categroy as $cateInfo) {

            $arrType = Category::find()->select('id,name')->where(['pid' => $cateInfo->id])->limit((8))->all();

            $arrType = ArrayHelper::toArray($arrType, [
                Category::className() =>
                    [
                        'tagId' => 'id', 'tagName' => 'name',
                        'seleted' => function ($arrType) {
                            return false;
                        }
                    ]
            ]);
            $data['arrTypeList'][] = [
                'typeName' => $cateInfo->name,
                'typeID' => 'TypeID',
                'isAll' => true,
                'tags' => $arrType
            ];
        }

        $data['arrTypeList'] = json_encode($data['arrTypeList']);
        return $this->render('search', $data);
    }

    /**
     * 搜索企业
     * @return string
     * @author suwen
     */
    public function actionSearchcomp()
    {
        $this->layout = '@app/views/layouts/search.php';
        return $this->render('searchcomp');
    }

    /**
     * 搜个人
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
    public function actionCred()
    {
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
    public function actionCompany()
    {
        $this->layout = '@app/views/layouts/home.php';
        return $this->render('company');
    }

    /**
     * @return string
     * @author suwen
     */
    public function actionPersonal()
    {
        $this->layout = '@app/views/layouts/home.php';
        return $this->render('personal');
    }
}
