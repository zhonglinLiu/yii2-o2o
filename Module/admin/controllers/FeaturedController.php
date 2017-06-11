<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\Featured;
use yii\data\Pagination;
use Yii;
use yii\web\Response;
use app\Module\service\responseHelper;
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
		$featuredmodel = new Featured(['scenario'=>'add']);
		if($request->isPost){
			$data = $request->post();
			if($featuredmodel->add($data)){
				return responseHelper::responseJson(1,'添加成功');
			}else{
				if($featuredmodel->hasErrors()){
					return responseHelper::responseJson(-1,$featuredmodel->getErrors());
				}else{
					return responseHelper::responseJson(-1,'添加失败');
				}
			}
		}
		$featured_type = Yii::$app->params['featured_type'];
		return $this->render('add',['featured_type'=>$featured_type]);
	}
}