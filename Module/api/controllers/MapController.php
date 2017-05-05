<?php 
namespace app\Module\api\controllers;
use yii\web\Controller;
use Yii;
use app\common\helpers\map;
class MapController extends Controller{
	public function actionGetStaticMap($position,$width=400,$height=400){
		return map::getStaticImg($position,$width,$height);
	}
}