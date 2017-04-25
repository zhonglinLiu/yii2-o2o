<?php 
namespace app\Module\index\controllers;
use yii\web\Controller;
use app\models\User;
use Yii;
use yii\helpers\Myhelper;
use app\Module\index\controllers\CommonController;
use yii\captcha\CaptchaAction;
use yii\web\Response;
class UserController extends CommonController{
	public $layout='layout1';
	public function actions()
    {		
        return  [	
            'captcha' => [
                        'class' => 'yii\captcha\CaptchaAction',
                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                        'backColor'=>0x000000,//背景颜色
                        'maxLength' => 6, //最大显示个数
                        'minLength' => 5,//最少显示个数
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
		if(Yii::$app->request->isPost){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$data = Yii::$app->request->post();
			$model = new User;
			$model->scenario = 'login';
			$model->setAttributes($data);
			if($model->validate()){
				return ['code'=>1,'data'=>'登录成功'];
			}else{
				return ['code'=>-1,'data'=>$model->getErrors()];
			}
		}
		return $this->render('login');
	}

	public function actionRegister(){
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			$model = new User;
			$model->scenario = 'register';
			$model->setAttributes($data);
			if($model->validate()){
				$model->code = mt_rand(1000,9999);
				$model->password = md5($model->password.$model->code);
				if($model->save(false)){
					return Myhelper::result(1,'注册成功');
				}else{
					return Myhelper::result(-1,'注册失败');
				}
			}else{
				return Myhelper::result(-1,$model->getErrors());
			}

		}
		return $this->render('register');
	}
}
