<?php 
namespace app\Module\index\controllers;
use yii\web\Controller;
use Yii;
use app\Module\index\controllers\CommonController;
use app\models\Category;
use app\models\Featured;
use app\models\Deal;
class IndexController extends CommonController{
	public $layout = 'layout1';
	public function actionIndex(){
		/*$cateModel = new Category;
		$tops = $cateModel->getTopCates(5);
		$cates = [];
		$catesChild = [];
		foreach ($tops as $k => $v) {
			$cates[$k]=$v;
			$catesChild[$k] = $v->getCatesByPid($v->id);
		}*/
		// Yii::error('message');
		$Featured = new Featured();
		$dealmodel = new Deal;
		$dealid = Yii::$app->params['deal'];
		$detailCate = [];
		foreach ($this->top as $k => $v) {
			if(in_array($v->id, $dealid)){
				$detailCate[$v->id] = $v;
			}
		}
		foreach ($dealid as $v) {
			$deals[$v] = $dealmodel->getDealByCid($v,$this->city_id);
		}

		/*$this->view->params['cates'] = $cates;
		$this->view->params['catesChild'] = $catesChild;*/
		$this->view->params['tops'] = $Featured->getTops();
		$this->view->params['right'] = $Featured->getRight();
		return $this->render('index',['detailCate'=>$detailCate,'deals'=>$deals]);
	}

	
	
}
