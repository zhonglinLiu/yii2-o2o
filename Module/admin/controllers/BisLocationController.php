<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\BisLocation;
use yii\data\Pagination;
use Yii;
use app\Module\admin\controllers\CommonController;
class BisLocationController extends CommonController{
	public $layout = 'layout2';
	public function actionIndex(){
		$status = Yii::$app->request->get('status');
		$count = BisLocation::find()->where(['status'=>$status])->count();
		$pageSize = Yii::$app->params['pageSize']['bis_location'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$locations = BisLocation::find()->where(['status'=>$status])->offset($pager->offset)->limit($pager->limit)->all();

		return $this->render('index',['locations'=>$locations,'pager'=>$pager,'status'=>$status]);
	}

	public function actionDetail(){
		return '待开发...';
	}

}