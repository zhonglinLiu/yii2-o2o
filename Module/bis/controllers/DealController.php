<?php 
namespace app\Module\bis\controllers;
use yii\web\Controller;
use app\models\Deal;
use yii\data\Pagination;
use Yii;
use app\models\Category;
use app\models\Citys;
use app\models\BisLocation;
use yii\web\Response;

class DealController extends CommonController{
	public $layout = 'layout2';
	 protected $actions=[
	 	'index','add'
	 ];
     protected $except=[];
	public function actionIndex(){
		$count = Deal::find()->where('status<>-1')->count();
		$pageSize = Yii::$app->params['pageSize']['deal'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$deals = Deal::find()->where('status<>-1')->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['deals'=>$deals,'pager'=>$pager]);
	}

	public function actionAdd(){
		if(Yii::$app->request->isAjax){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$user = Yii::$app->bis->identity;
			$data = Yii::$app->request->post();
			if(isset($data['se_category_id'])){
				$data['se_category_id'] = implode(',',$data['se_category_id']);
			}
			$data['bis_id'] = $user->bis_id;
			if(!isset($data['location_ids']) || !is_array($data['location_ids'])){
				return ['code'=>-1,'data'=>'请选择参加活动地址'];
			}
			$location = BisLocation::find()->where(['bis_id'=>$user->bis_id,'is_main'=>1])->one();
			if(empty($location)){
				return ['code'=>-1,'data'=>'内部错误2'];
			}
			$data['xpoint'] = $location->xpoint;
			$data['ypoint'] = $location->ypoint;
			$data['location_ids'] = implode(',',$data['location_ids']);
			$data['start_time'] = strtotime($data['start_time']);
			$data['end_time'] = strtotime($data['end_time']);
			$data['coupons_begin_time'] = strtotime($data['coupons_begin_time']);
			$data['coupons_end_time'] = strtotime($data['coupons_end_time']);
			$data['bis_account_id'] = $user->id;
			$data['status']=0;
			if(isset($data['id']) && $data['id']!=''){
				$model = Deal::find()->where(['id'=>$data['id']])->one();
			}else{
				$model = new Deal;
			}
			$model->setAttributes($data);
			if($model->validate()){
				if($model->save(false)){
					return ['code'=>1,'data'=>'申请成功'];
				}else{
					return ['code'=>-1,'data'=>'申请失败'];
				}
			}else{
				return ['code'=>-1,'data'=>$model->getErrors()];
			}

		}
		$id = Yii::$app->request->get('id');
		if(!empty($id)){
			$model = Deal::find()->where(['id'=>intval($id)])->one();
		}else{
			$model = new Deal;
		}
		$cityModel = new Citys;
        $cateModel = new Category;
        $bis_id = Yii::$app->bis->identity->bis_id;
        $citys = $cityModel->getTopCitys();
        $cates = $cateModel->getTopCates();
        $stores = BisLocation::find()->where('status=1 and bis_id='.$bis_id)->all();
        return $this->render('add',['citys'=>$citys,'cates'=>$cates,'stores'=>$stores,'model'=>$model]);
	}
} 

