<?php 
namespace app\Module\api\controllers;
use yii\web\Controller;
use Yii;
use app\models\Citys;
use yii\web\Response;
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
			Yii::$app->response->format = Response::FORMAT_JSON;
			$id = Yii::$app->request->post('parent_id');
			if(is_null($id)){
				return ['code'=>-1,'data'=>'id不能为空'];
			}
			$citys = Citys::find()->select(['id','name'])->where('parent_id=:pid',[':pid'=>$id])->asArray()->all();
			if(empty($citys)){
				return ['code'=>-1,'data'=>'不存在子类'];
			}
			return ['code'=>1,'data'=>$citys];
		}
	}

	public function actionTest(){
		return 'ok';
	}

	
}