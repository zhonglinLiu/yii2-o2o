<?php
namespace app\Module\api\controllers;
use yii\web\Controller;
use Yii;
class BisAccountController extends Controller{
	public function beforeAction($current)
    {
       $action = [
       	'actionShowposition'
       ];
       if(in_array($current->actionMethod,$action)){
       		$current->controller->enableCsrfValidation = false;
       }
       parent::beforeAction($current);
       return true;
    }    
	public function actionShowposition(){
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$position = $post['position'];
			$rel = \yii\helpers\Myhelper::getCoorByAddress($position);
			$rel = json_decode($rel);
			if($rel->status!=0){
				return \yii\helpers\Myhelper::result(-1,'地址有误');
			}
			if(!empty($rel->result) && $rel->result->precise!=1){
				return \yii\helpers\Myhelper::result(-1,'请填写详细地址');
			}
			return \yii\helpers\Myhelper::result(1,'ok');
			
		}
	}
	public function actionShowmap(){
		$position = Yii::$app->request->get('position');
		return \yii\helpers\Myhelper::getStaticImg($position);
	}
}