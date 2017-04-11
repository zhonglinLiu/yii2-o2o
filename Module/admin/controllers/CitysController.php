<?php 
namespace app\Module\admin\controllers;
use app\models\Citys;
use yii\web\Controller;
use yii\data\Pagination;
use app\Module\admin\controllers\CommonController;
use Yii;
class CitysController extends CommonController{
	public $layout = 'layout2';
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

	/*public function actionStatus(){
		$city = Yii::$app->request->get();
		$rel = Citys::updateAll(['status'=>intval($city['status'])],'id=:id',[':id'=>intval($city['id'])]);
		if(empty($rel)){
			$this->render('index/error',['msg'=>'修改失败']);
		}
		$this->redirect(Yii::$app->request->getReferrer());
	}*/

	public function actionAdd(){
		$model = new Citys;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$post['Citys']['parent_id'] = $post['parent_id'];
			$model->scenario = 'add';
			$post['Citys']['status'] = 1;
			$model->load($post);
			if($model->validate()){
				$model->save(false);
				Yii::$app->session->setFlash('info','添加成功');
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
		}
		$citys = $model->getTopCitys();
		return $this->render('add',['citys'=>$citys,'model'=>$model]);
	}

	public function actionEdit(){
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$id = $post['Citys']['id'];
			$city = Citys::find()->where('id=:id',[':id'=>$id])->one();
			$city->scenario = 'add';
			$city->load($post);
			if($city->validate()){
				if($city->save()){
					Yii::$app->session->setFlash('info','修改成功');
				}else{
					Yii::$app->session->setFlash('info','修改失败');
				}
			}
		}else{
			$id = Yii::$app->request->get('id');
			$city = Citys::find()->where('id=:id',[':id'=>$id])->one();
		}
		$citys = $city->getTopCitys();
		return $this->render('edit',['citys'=>$citys,'model'=>$city]);
	}
	
}