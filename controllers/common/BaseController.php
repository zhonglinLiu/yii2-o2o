<?php 
namespace app\controllers\common;
use yii\web\Controller;
use Yii;
class BaseController extends Controller{
	protected $userInfo;
	protected $allowAction = [
		'login/index',
	];
	protected $field='admin';
	protected $redirect='login/index';
	public function beforeAction($action){
		$status = $this->checkLogin();
		if(!$status && !in_array($action->uniqueId,$this->allowAction)){
			$this->redirect([$this->redirect]);
		}
		return true;
	}

	public function checkLogin(){
		$session = Yii::$app->session;
		if(!($this->userInfo = $session->get($this->field))){
			return false;
		}
		return true;
	}
}