<?php 
namespace app\Module\admin\controllers;
use app\models\Citys;
use yii\web\Controller;
use yii\data\Pagination;
use app\Module\admin\controllers\CommonController;
use Yii;
class CitysController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
		'index','add','edit'
	];
     protected $except=[];
	public function actionIndex(){
		$id = Yii::$app->request->get('parent_id');
		if(is_null($id)){
			$id = 0;
		}
		$pageSize = Yii::$app->params['pageSize']['citys'];
		$count = Citys::find()->where('status <>-1 and parent_id='.$id)->count();

		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$citys = Citys::find()->where('status <>-1 and parent_id='.$id)->orderby('listorder desc')->limit($pager->limit)->offset($pager->offset)->all();
		return $this->render('index',['citys'=>$citys,'pager'=>$pager]);
	}

	

	public function actionAdd(){
		$model = new Citys(['scenario'=>'add']);
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$post['Citys']['status'] = 1;
			if($model->add($post)){
				Yii::$app->session->setFlash('info','添加成功');
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
			
		}
		
		$select = $model->buildList();
		return $this->render('add',['model'=>$model,'select'=>$select]);
	}

	public function actionEdit(){
		$model = new Citys(['scenario'=>'edit']);
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post('Citys');
			if($model->editById($post['id'],$post)){
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}else{
			$id = Yii::$app->request->get('id');
			$model = $model->findOne($id);
			$model->scenario = 'edit';
		}
		$select = $model->buildList();
		return $this->render('edit',['select'=>$select,'model'=>$model]);
	}
	
}