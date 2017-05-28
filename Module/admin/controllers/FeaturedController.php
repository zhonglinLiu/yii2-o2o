<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\Featured;
use yii\data\Pagination;
use Yii;
use yii\web\Response;
class FeaturedController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
		'index','add'
	];
     protected $except=[];
	public function actionIndex(){
		$data = Yii::$app->request->post();
		$where = '';
		if(!empty($data)){
			$where['type'] = $data['type'];
		}
		$count = Featured::find()->where(['<>','status',-1])->andWhere($where)->count();
		$pageSize = Yii::$app->params['pageSize']['featured'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$featured = Featured::find()->where(['<>','status',-1])->andWhere($where)->offset($pager->offset)->limit($pager->limit)->all();
		$featured_type = Yii::$app->params['featured_type'];
		return $this->render('index',['pager'=>$pager,'featured'=>$featured,'featured_type'=>$featured_type,'selected_type'=>$where]);
	}

	public function actionAdd(){
		$request = Yii::$app->request;
		if($request->isPost){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$data = $request->post();
			$featuredmodel = new Featured;
			$featuredmodel->scenario = 'add';
			$featuredmodel->setAttributes($data);
			if($featuredmodel->validate()){
				if($featuredmodel->save(false)){
					return ['code'=>1,'添加成功'];
				}
				return ['code'=>-1,'添加失败'];
			}else{
				return ['code'=>-1,'data'=>$featuredmodel->getErrors()];
			}
		}
		$featured_type = Yii::$app->params['featured_type'];
		return $this->render('add',['featured_type'=>$featured_type]);
	}
}