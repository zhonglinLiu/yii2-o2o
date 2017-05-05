<?php 
namespace app\Module\index\controllers;
use yii\web\Controller;
use Yii;
use app\models\Deal;
use app\models\Category;
use app\models\Bis;
use app\models\BisLocation;
class DetailController extends CommonController{
	public $layout = 'layout1';
	public function actionIndex(){
		$id = Yii::$app->request->get('id');
		$deal = Deal::find()->where('status=1 and id='.intval($id))->one();
		$bis = Bis::find()->where('status=1 and id='.$deal->bis_id)->one();
		$countDown = '';
		$timestemp = $deal->start_time-time();
		if($t = ($timestemp/3600/24)>1){
			$countDown = floor($t).'天';
		}
		if($t = ($timestemp%(3600*24)/3600)>1){
			$countDown.= floor($t).'小时'; 
		}
		if($t = ($timestemp%(3600*24)%60/60)>0){
			$countDown.= floor($t).'分钟';
		}
		if(empty($deal)){
			return '该商品不存在';
		}
		$cache = Yii::$app->cache;
		$topcatesKey = 'topCate';
		if(!$cache->get($topcatesKey)){
			$catemodel = new Category;
			$topCates = $catemodel->getTopCates();
			$cache->set($topcatesKey,$topCates,3600);
		}else{
			$topCates = $cache->get($topcatesKey);
		}
		$cate = '';
		foreach ($topCates as $value) {
			if($value->id==$deal->category_id){
				$cate = $value;
				break;
			}
		}
		$locations = BisLocation::find()->select(['name','id','address','xpoint','ypoint','is_main'])->where(['bis_id'=>$deal->bis_id])->all();
		$mainLoc = '';
		foreach ($locations as $value) {
			if($value->is_main==1){
				$mainLoc = $value;
			}
		}
		return $this->render('index',[
			'cate'=>$cate,
			'deal'=>$deal,
			'bis'=>$bis,
			'countDown' =>$countDown,
			'locations'=>$locations,
			'mainLoc'=>$mainLoc,
		]);
	}
}