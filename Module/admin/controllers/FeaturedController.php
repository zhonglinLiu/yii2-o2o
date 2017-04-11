<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\Featured;
use yii\data\Pagination;
use Yii;
use yii\helpers\Myhelper;
class FeaturedController extends Controller{
	public $layout = 'layout2';
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
			$data = $request->post();
			$featuredmodel = new Featured;
			$featuredmodel->scenario = 'add';
			$featuredmodel->setAttributes($data);
			if($featuredmodel->validate()){
				if($featuredmodel->save(false)){
					return Myhelper::result(1,'添加成功');
				}
				return Myhelper::result(-1,'添加失败');
			}else{
				return Myhelper::result(-1,$featuredmodel->getErrors());
			}
		}
		$featured_type = Yii::$app->params['featured_type'];
		return $this->render('add',['featured_type'=>$featured_type]);
	}
}