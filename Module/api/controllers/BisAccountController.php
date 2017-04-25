<?php
namespace app\Module\api\controllers;
use yii\web\Controller;
use Yii;
use app\common\helpers\map;

use yii\web\Response;
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
		Yii::$app->response->format = Response::FORMAT_JSON;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$position = $post['position'];
			$rel = map::getCoorByAddress($position);
			$rel = json_decode($rel);
			if($rel->status!=0){
				return ['code'=>-1,'data'=>'地址有误'];
			}
			if(!empty($rel->result) && $rel->result->precise!=1){
				return ['code'=>-1,'data'=>'请填写详细地址'];
			}
			return ['code'=>1,'data'=>'ok'];
			
		}
	}
	public function actionShowmap($position){
		return map::getStaticImg($position);
	}
}