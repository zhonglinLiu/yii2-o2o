<?php
namespace app\Module\api\controllers;
use yii\web\Controller;
use Yii;
use app\models\Category;
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
			$id = Yii::$app->request->post('parent_id');
			if(is_null($id)){
				return \yii\helpers\Myhelper::result(-1,'id不能为空');
			}
			$cates = Category::find()->select(['name','id'])->where('parent_id=:pid',[':pid'=>$id])->asArray()->all();
			if(empty($cates)){
				return \yii\helpers\Myhelper::result(-1,'不存在子类');
			}
			return \yii\helpers\Myhelper::result(1,$cates);
		}
	}
}