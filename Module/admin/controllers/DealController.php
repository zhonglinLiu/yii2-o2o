<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use Yii;
use app\Module\admin\controllers\CommonController;
use app\models\Deal;
use yii\data\Pagination;
use app\models\Category;
use app\models\Citys;
class DealController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
		'index','detail'
	];
    protected $except=[];
	public function actionIndex(){
		$status = Yii::$app->request->get('status');
		$count = Deal::find()->where(['status'=>$status])->count();
		$pageSize = Yii::$app->params['pageSize']['deal'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$deals = Deal::find()->where(['status'=>$status])->limit($pager->limit)->offset($pager->offset)->all();
		$citymodel = new Citys;
		$catemodel = new Category;
		$citys = $citymodel->getTopCitys();
		$cates = $catemodel->getTopCates();
		return $this->render('index',['pager'=>$pager,'deals'=>$deals,'cates'=>$cates,'citys'=>$citys]);
	}

	public function actionDetail(){
		return '待开发...';
	}

}