<?php 
namespace app\Module\service;
use Yii;
use yii\web\Response;
class responseHelper{
	public static function responseJson($code,$data){
		Yii::$app->response->format = Response::FORMAT_JSON;
		return ['code'=>$code,'data'=>$data];
	}
}