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
		/*if(Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			$model = new User;
			$model->scenario = 'register';
			$model->setAttributes($data);
			if($model->validate()){
				$model->code = mt_rand(1000,9999);
				$model->password = md5($model->password.$model->code);
				if($model->save(false)){
					return ['code'=>1,'data'=>'注册成功'];
				}else{
					return ['code'=>-1,'data'=>'注册失败'];

				}
			}else{
				return ['code'=>-1,'data'=>$models->getErrors()];
			}

		}*/
		$model = new User(['scenario' => 'register']);
		if(Yii::$app->request->ispost){
			$post = Yii::$app->request->post();
			if($model->load($post) && $model->validate()){
				$code = mt_rand(1000,9999);
				$model->code = $code;
				$model->password = md5($model->password.$code);
				if($model->save(false)){
					Yii::$app->session->setFlash('info','注册成功');
				}else{
					Yii::$app->session->setFlash('info','注册失败');
				}
			}
		}
		$model->password = '';
		$model->repass = '';
		return $this->render('register',['model'=>$model]);
	}

	public function actionLogout(){
		Yii::$app->user->logout(false);
		return $this->redirect('/index/user/login');
	}
}
