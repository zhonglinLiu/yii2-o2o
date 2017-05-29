<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\Category;
use yii\data\Pagination;
use app\Module\admin\controllers\CommonController;
use Yii;
use app\Module\service\responseHelper;
class CategoryController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
		'index','add','edit','order','listorder'
	];
     protected $except=[];
	public function actionIndex(){
		$pid = Yii::$app->request->get('parent_id');
		if(empty($pid)){
			$pid = 0;
		}
		$connection = Yii::$app->db;
		$count = Category::find()->where('status<>-1 and parent_id='.$pid)->count();
		$pageSize = Yii::$app->params['pageSize']['category'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$cates = Category::find()->where('status<>-1 and parent_id='.$pid)->orderby('listorder desc')->limit($pager->limit)->offset($pager->offset)->all();
		if(empty($cates)){
			return $this->render('/index/error',['msg'=>'木有子类']);
		}
		return $this->render('index',['cates'=>$cates,'pager'=>$pager]);
	}

	public function actionAdd(){
		$model = new Category(['scenario'=>'add']);
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if($model->addCategory($post)){
				Yii::$app->session->setFlash('info','添加成功');
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
			
		}

		$select = $model->buildList();
		return $this->render('add',['model'=>$model,'select'=>$select]);
	}

	public function actionEdit(){
		$categoryModel = new Category(['scenario'=>'add']);
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if($categoryModel->editById($post)){
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}else{
			$id = Yii::$app->request->get('id');
			$categoryModel = $categoryModel->find()->where('id=:id',[':id'=>$id])->one();
			$categoryModel->scenario = 'add';
		}
		
		$select = $categoryModel->buildList();

		
		return $this->render('edit',['select'=>$select,'model'=>$categoryModel]);
	}

	public function actionListorder(){
		if(Yii::$app->request->isAjax){
			$post = Yii::$app->request->post();
			$model = Category::find()->where('id=:id',[':id'=>$post['id']])->one();
			$model->listorder = $post['listorder'];
			if($model->save()){
				return responseHelper::responseJson(1,'修改成功');
			}
			return responseHelper::responseJson(1,'修改失败');
		}
	}

	
}