<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\Category;
use yii\data\Pagination;
use app\Module\admin\controllers\CommonController;
use Yii;
class CategoryController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
		'index','add','edit','order'
	];
     protected $except=[];
	public function actionIndex(){
		$pid = Yii::$app->request->get('parent_id');
		if(empty($pid)){
			$pid = 0;
		}
		$connection = Yii::$app->db;
		$count = $connection->createCommand('select count(*) from {{%category}} where status<>-1 and parent_id='.$pid)->queryOne();
		$count = current($count);
		$pageSize = Yii::$app->params['pageSize']['category'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$cates = Category::find()->where('status<>-1 and parent_id='.$pid)->orderby('listorder desc')->limit($pager->limit)->offset($pager->offset)->all();
		if(empty($cates)){
			return $this->render('/index/error',['msg'=>'木有子类']);
		}
		return $this->render('index',['cates'=>$cates,'pager'=>$pager]);
	}

	public function actionAdd(){
		$model = new Category;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$model->parent_id = intval($post['parent_id']);
			$model->name = $post['name'];
			$model->status = 1;
			$model->scenario = 'add';
			if($model->validate()){
				if($model->save()){
					Yii::$app->session->setFlash('info','添加成功');
				}else{
					Yii::$app->session->setFlash('info','添加失败');
				}
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
			
		}
		$cates = $model->getTopCates();
		return $this->render('add',['cates'=>$cates]);
	}

	public function actionEdit(){

		
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$cate = Category::find()->where('id=:id',[':id'=>$post['id']])->one();
			$cate->parent_id = $post['parent_id'];
			$cate->name=$post['name'];
			if($cate->save()){
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}else{
			$id = Yii::$app->request->get('id');
			$cate = Category::find()->where('id=:id',[':id'=>$id])->one();
		}
		$model = new Category;
		$cates = $model->getTopCates();
		return $this->render('edit',['cates'=>$cates,'cate'=>$cate]);
	}

	public function actionListorder(){
		if(Yii::$app->request->isAjax){
			$post = Yii::$app->request->post();
			$model = Category::find()->where('id=:id',[':id'=>$post['id']])->one();
			$model->listorder = $post['listorder'];
			if($model->save()){
				return \yii\helpers\Myhelper::result(1,'修改成功');
			}
			return yii\helpers\Myhelper::result(-1,'修改失败');
		}
	}

	/*public function actionStatus(){
		$status = Yii::$app->request->get('status');
		$id = Yii::$app->request->get('id');
		if(is_null($status) || is_null($id)){
			return $this->render('index/error',['msg'=>'修改失败']);
		}
		$rel = Category::updateAll(['status'=>intval($status)],'id=:id',[':id'=>$id]);
		if(!$rel){
			return $this->render('index/error',['msg'=>'修改失败']);
		}
		return $this->redirect($_SERVER['HTTP_REFERER']);

	}*/
}