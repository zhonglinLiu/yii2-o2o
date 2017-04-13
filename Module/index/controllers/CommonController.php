<?php 
namespace app\Module\index\controllers;
use yii\web\Controller;
use Yii;
use app\models\Citys;
use app\models\Category;
class CommonController extends Controller{
	public $city_id = null;
	public $uname = '';
	public $top = '';
	public function beforeAction($action){
		$city_id = Yii::$app->request->get('city_id');

		$this->view->params['title'] = $action->controller->id;
		$rel = Citys::find()->asArray()->all();
		$citys = [];
		$cityChilds = [];
		foreach ($rel as $k => $v) {
			if($v['is_default']==1){
				$this->city_id = $v['id'];
				$this->view->params['uname'] = $v['uname'];
			}
			if($v['parent_id']==0){
				$citys[$v['id']] = $v;
			}else{
				// $citys[$v['parent_id']]['childs'][] = $v;
				$cityChilds[$v['parent_id']][] = $v;
			}
			 
		}
		if(!empty($city_id)){
			$this->city_id = $city_id;
			$this->view->params['uname'] = Yii::$app->request->get('uname');
		}


		$cateModel = new Category;
		$this->top = $tops = $cateModel->getTopCates(5);
		$cates = [];
		$catesChild = [];
		foreach ($tops as $k => $v) {
			$cates[$v->id]=$v;
			$catesChild[$v->id] = $v->getCatesByPid($v->id);
		}

		$this->view->params['cates'] = $cates;
		$this->view->params['catesChild'] = $catesChild;

		$this->view->params['citys'] = $citys;
		$this->view->params['cityChilds'] = $cityChilds;

		return true;
	}
	

}