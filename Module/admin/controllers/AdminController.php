<?php
namespace app\Module\admin\controllers;
use yii\web\Controller;
use Yii;
use app\Module\admin\models\Admin;
use app\Module\service\responseHelper;
class AdminController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[];
    protected $except=['login','logout'];

   public function actions()
    {		
        return  [	
            'captcha' => [
                        'class' => 'yii\captcha\CaptchaAction',
                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                        'backColor'=>0x000000,//背景颜色
                        'maxLength' =>4 , //最大显示个数
                        'minLength' => 4,//最少显示个数
                        'padding' => 5,//间距
                        'height'=>40,//高度
                        'width' => 130,  //宽度  
                        'foreColor'=>0xffffff,     //字体颜色
                        'offset'=>4,        //设置字符偏移量 有效果
                        //'controller'=>'login',        //拥有这个动作的controller
                ],
		];
	}
	public function actionLogin(){
		$model = new Admin(['scenario'=>'login']);
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			$model->setAttributes($data);
			if($model->validate()){
				Yii::$app->admin->login($model->admin,3600);
				return responseHelper::responseJson(1,'登录成功');
			}else{
				// return ['code'=>-1,'data'=>$model->getErrors()];
				return responseHelper::responseJson(-1,$model->getErrors());
			}
		}
		return $this->render('login',['model'=>$model]);
	}

	public function actionLogout(){
		Yii::$app->admin->logout(false);
		$this->redirect(['/admin/admin/login']);
	}


}