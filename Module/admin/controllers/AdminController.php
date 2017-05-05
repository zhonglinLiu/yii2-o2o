<?php
namespace app\Module\admin\controllers;
use yii\web\Controller;
use Yii;
use app\Module\admin\models\Admin;
use yii\web\Response;
class AdminController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[];
    protected $except=['login','logout'];
	public function actionLogin(){
		if(Yii::$app->request->isPost){
			Yii::$app->response->format=Response::FORMAT_JSON;
			$data = Yii::$app->request->post();
			$model = new Admin;
			$model->scenario = 'login';
			$model->setAttributes($data);
			if($model->validate()){
				Yii::$app->admin->login($model->admin,3600);
				return ['code'=>1,'data'=>'登录成功'];
			}else{
				return ['code'=>-1,'data'=>$model->getErrors()];
			}
		}

		return $this->render('login');
	}

	public function actionLogout(){
		Yii::$app->admin->logout(false);
		$this->redirect(['/admin/admin/login']);
	}
}