<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use Yii;
use app\controllers\common\BaseController;
class CommonController extends Controller{
	public function actionStatus(){
		$data = Yii::$app->request->get();
		$model = preg_replace_callback('/(-[a-zA-Z])/', function($matches){
			return strtoupper(substr($matches[0], 1));
		} , Yii::$app->controller->id);
		$model = '\app\models\\'.ucfirst($model);
		$rel = $model::updateAll(['status'=>intval($data['status'])],'id=:id',[':id'=>intval($data['id'])]);
		if(empty($rel)){
			$this->render('/index/error',['msg'=>'修改失败']);
		}
		$this->redirect(Yii::$app->request->getReferrer());
	}
}