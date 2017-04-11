<?php 
namespace app\Module\bis\controllers;
use yii\web\Controller;
use app\models\BisAccount;
use yii\data\Pagination;
use Yii;
use app\Module\bis\controllers\CommonController;
use yii\helpers\Myhelper;
class ManagerController extends CommonController{
	public $layout = 'layout2';
	public function beforeAction($action){
		$user = Yii::$app->session->get('bis');
		if($user->is_main!=1){
			return '无权访问';
		}
		return true;
	}
	public function actionIndex(){
		$user = Yii::$app->session->get('bis');
		$count = BisAccount::find()->where(['<>','status',-1])->andWhere(['bis_id'=>$user->bis_id])->all();
		$pageSize = Yii::$app->params['pageSize']['bis_account'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$account = BisAccount::find()->where('status<>-1 and bis_id='.$user->bis_id)->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager'=>$pager,'account'=>$account]);
	}

	public function actionAdd(){
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			if(isset($data['id']) && $data['id']!=''){
				$acountmodel = BisAccount::find()->where(['id'=>$data['id']])->one();
			}else{
				$acountmodel = new BisAccount;
			}
			
			$acountmodel->scenario = 'create';
			$acountmodel->setAttributes($data);
			if($acountmodel->validate()){
				$acountmodel->code = mt_rand(1000,9999);
				$acountmodel->password = md5($data['password'].$acountmodel->code);
				$acountmodel->status = 1;
				$acountmodel->bis_id = Yii::$app->session->get('bis')->bis_id;
				if($acountmodel->save(false)){
					return Myhelper::result(1,'添加成功');
				}
				return Myhelper::result(-1,'添加失败');
			}else{
				return Myhelper::result(-1,$acountmodel->getErrors());
			}
		}
		$acountmodel = new BisAccount;
		return $this->render('add',['model'=>$acountmodel]);
	}

	public function actionStatus(){
		$data = Yii::$app->request->get();
		$rel = BisAccount::updateAll(['status'=>intval($data['status'])],'id=:s',[':s'=>intval($data['id'])]);
		if(!empty($rel)){
			return $this->redirect($_SERVER['HTTP_REFERER']);
		}
		return $this->render('/layouts/error',['msg'=>'修改失败']);
	}

	public function actionEdit(){
		$data = Yii::$app->request->get();
		$model = BisAccount::find()->where(['id'=>intval($data['id'])])->one();
		return $this->render('add',['model'=>$model]);
	}
}