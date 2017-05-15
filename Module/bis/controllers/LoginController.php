<?php 
namespace app\Module\bis\controllers;
use yii\web\Controller;
use Yii;
use app\models\BisAccount;
use yii\web\Response;
class LoginController extends CommonController{
	public $layout = 'layout2';
	protected $except=['*'];
	public function actionIndex(){
		/*if(!empty(Yii::$app->session->get('bis'))){
			$this->redirect(['index/index']);
		}*/
		if(Yii::$app->request->isPost){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$post = Yii::$app->request->post();
			$model = new BisAccount();
			$model->scenario = 'login';
			$model->setAttributes($post);
			if($model->validate()){
				$rel = $model->find()->where('username=:u and status=:s',[':u'=>$post['username'],':s'=>1])->one();
				if(!empty($rel)){
					if($rel->password==md5($post['password'].$rel->code)){
						$rel = Yii::$app->bis->login($model->getUser(),3600*24);
						return ['code'=>1,'data'=>'登录成功'];
					}else{
						return ['code'=>-1,'data'=>'用户或密码错误'];
					}
				}else{
					return ['code'=>-1,'data'=>'用户不存在'];
				}
			}else{
				return ['code'=>-1,'data'=>$model->getErrors()];
			}
		}
		return $this->render('index');
	}

	public function actionLogout(){
		Yii::$app->bis->logout(false);
		$this->redirect(['login/index']);
	}
}