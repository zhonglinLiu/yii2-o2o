<?php 
namespace app\Module\index\controllers;
use yii\web\Controller;
use Yii;
use app\models\Deal;
use yii\data\Pagination;
use app\models\Category;
class ListsController extends CommonController{
	public $layout = 'layout1';
	public function actionIndex(){
		$data = Yii::$app->request->get();
		$cateid = '';
		$secid = '';
		$cateWhere = '';
		$order = 'listorder asc';
		if(isset($data['id']) && $data['id']!='' ){
			$cateid = $data['id'];
			$cateWhere = 'and category_id='.intval($data['id']);
			// $deals = Deal::find()->where('status <> -1 and category_id='.intval($data['id']))->all();
		}elseif(isset($data['sec_id'])){
			$secid = intval($data['sec_id']);
			$cateid = Category::find()->where(['parent_id'=>$cateid])->one()->id;
			$cateWhere = 'and se_category_id='.intval($data['sec_id']);
			// $deals = Deal::find()->where('status <> -1 and se_category_id='.intval($data['sec_id']))->all();
		}
		if( isset($data['order']) && $data['order']=='order_sale'){
			$order = 'buy_count desc';
		}
		if( isset($data['order']) &&$data['order']=='order_price'){
			$order = 'current_price asc';
		}
		if( isset($data['order']) &&$data['order']=='order_time'){
			$order = 'create_time desc';
		}
		$count = Deal::find()->where('status <> -1 '.$cateWhere)->count();
		$pageSize = Yii::$app->params['pageSize']['lists'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$deals = Deal::find()->where('status <> -1 '.$cateWhere)->limit($pager->limit)->offset($pager->offset)->orderby($order)->all();
		return $this->render('index',[
			'deals'=>$deals,
			'cateid'=>$cateid,
			'secid'=>$secid,
			'pager'=>$pager,
			]);
	}
}