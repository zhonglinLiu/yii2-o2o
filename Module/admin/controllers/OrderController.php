<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Order;
use Yii;
class OrderController extends Controller{
	public $layout = 'layout2';
	public function actionIndex(){
		$data = [];
		$sdata = [];
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			if(isset($data['start_time']) && $data['start_time']!='' ){
				$sdata[] = 'create_time > '.strtotime($data['start_time']); 
			}
			if(isset($data['end_time']) && $data['end_time']!='' ){
				$sdata[] = 'create_time < '.strtotime($data['end_time']); 
			}
			if(isset($data['username']) && $data['username']!=''){
				$sdata['username'] = 'username = '.trim(htmlspecialchars($data['username']));
			}
		}
		$str = '';
		if(!empty($sdata)){
			$str = implode(' and ',$sdata);
		}
		$count = Order::find()->where($str)->count();
		$pageSize = Yii::$app->params['pageSize']['order'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$orders = Order::find()->where($str)->limit($pager->limit)->offset($pager->offset)->orderby('id desc')->all();
		return $this->render('index',['orders'=>$orders,'pager'=>$pager]);
	}
}