<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\User;
use yii\data\Pagination;
use Yii;
use yii\web\Response;
class UserController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
		'index','edit','status','detail'
	];
     protected $except=[];
	public function actionIndex(){
		$str = null;
		$sdata = [];
		$data = [];
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			
			if(isset($data['register_start_time']) && $data['register_start_time']!=''){
				$sdata[] = 'create_time > '.strtotime($data['register_start_time']);
			}
			if(isset($data['register_end_time']) && $data['register_end_time']!=''){
				$sdata[] = 'create_time < '.strtotime($data['register_end_time']);
			}
			if(isset($data['start_time']) && $data['start_time']!=''){
				$sdata[] = 'update_time >'.strtotime($data['start_time']);
			}
			if(isset($data['end_time']) && $data['end_time']!=''){
				$sdata[] = 'update_time <'.strtotime($data['end_time']);
			}
			if(isset($data['username']) && $data['username']!=''){
				$sdata[] = 'username like "%'.htmlspecialchars(trim($data['username'])).'%"';
			}
			
		}
		$sdata[] = 'status <> -1';
		$str = implode(' and ',$sdata);
		$count = User::find()->where($str)->all();
		$pageSize = Yii::$app->params['pageSize']['user'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$users = User::find()->where($str)->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['users'=>$users,'pager'=>$pager,'data'=>$data]);
	}

	public function actionEdit(){
		if(Yii::$app->request->isPost){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$post = Yii::$app->request->post();
			$model = new User;
			$model->scenario = 'adminEdit';
			$model->setAttributes($post);
			$model->setAttribute('id',$post['id']);
			if($model->validate()){
				var_dump(3);
				$code = range(10000,999999);
				$post['code'] = $code;
				$post['password'] = md5($post['password'].$code);
				var_dump(2);
				$rel = User::updateAll($post,'id=:id',[':id'=>intval($post['id'])]);
				if($rel){
					return ['code'=>1,'data'=>'修改成功'];
				}
				return ['code'=>-1,'data'=>'修改失败'];
			}else{
				return ['code'=>-1,'data'=>$model->getErrors()];
			}
			return;
		}
		$id = Yii::$app->request->get('id');
		if(empty($id)){
			return '参数错误';
		}
		$user = User::findOne(['id'=>intval($id)]);
		return $this->render('edit',['user'=>$user]);
	}

	/*public function actionStatus(){
		if(Yii::$app->request->isAjax){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$data = Yii::$app->request->post();
			$rel = User::updateAll(['status'=>intval($data['status'])],'id=:id',[':id'=>intval($data['id'])]);
			if(!$rel){
				return ['code'=>-1,'msg'=>'修改状态失败'];
			}
			return ['code'=>1,'msg','修改状态成功'];
		}
		

	}*/
	public function actionDetail(){
		
	}

}