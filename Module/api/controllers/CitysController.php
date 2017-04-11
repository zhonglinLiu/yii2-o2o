<?php 
namespace app\Module\api\controllers;
use yii\web\Controller;
use Yii;
use app\models\Citys;
class CitysController extends Controller{
	public function beforeAction($current)
    {
        $actions = [
        	'actionGetCitysByPid',
        ];
        if(in_array($current->actionMethod, $actions)){
        	$current->controller->enableCsrfValidation = false;
        }
        parent::beforeAction($current);
        return true;
    }    
	public function actionGetCitysByPid(){
		if(Yii::$app->request->isPost){
			$id = Yii::$app->request->post('parent_id');
			if(is_null($id)){
				return \yii\helpers\Myhelper::result(-1,'id不能为空');
			}
			$citys = Citys::find()->select(['id','name'])->where('parent_id=:pid',[':pid'=>$id])->asArray()->all();
			if(empty($citys)){
				return \yii\helpers\Myhelper::result(-1,'不存在子类');
			}
			return \yii\helpers\Myhelper::result(1,$citys);
		}
	}

	public function actionTest(){
		return 'ok';
	}

	
}