<?php
namespace app\Module\api\controllers;
use yii\web\Controller;
use Yii;
use app\models\Category;
use yii\web\Response;
class CategoryController extends Controller{
	public function beforeAction($current)
    {
        $actions = [
        	'actionGetCategoryByPid',
        ];
        if(in_array($current->actionMethod, $actions)){
        	$current->controller->enableCsrfValidation = false;
        }
        parent::beforeAction($current);
        return true;
    }    
	public function actionGetCategoryByPid(){
		if(Yii::$app->request->isPost){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$id = Yii::$app->request->post('parent_id');
			if(is_null($id)){
				return ['code'=>-1,'data'=>'id不能为空'];
			}
			$cates = Category::find()->select(['name','id'])->where('parent_id=:pid',[':pid'=>$id])->asArray()->all();
			if(empty($cates)){
				return ['code'=>-1,'data'=>'不存在子类'];
			}
			return ['code'=>1,'data'=>$cates];
		}
	}
}