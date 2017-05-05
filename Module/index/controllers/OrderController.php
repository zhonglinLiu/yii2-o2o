<?php 
namespace app\Module\index\controllers;
use yii\web\Controller;
use Yii;
use app\models\Deal;
use yii\web\Response;
use app\models\Order;
class OrderController extends CommonController{
	public $layout = 'layout1';
	public function actionIndex(){
		$user = Yii::$app->user->identity;
		if(empty($user)){
			return $this->redirect(['user/login']);
		}
		$get = Yii::$app->request->get();
		$id = intval($get['id']);
		$count = intval($get['count']);
		$deal = Deal::find()->where(['id'=>$id])->one();
		return $this->render('confirm',[
			'deal'=>$deal,
			'count'=>$count,
			'email'=>$user->email
		]);
	}
	public function actionConfirm(){
		if(Yii::$app->request->isPost){
			Yii::$app->response->format = Response::FORMAT_JSON;
			$post = Yii::$app->request->post();
			$count = intval($post['count']);
			$id =intval( $post['id']);
			$deal = Deal::find()->where(['id'=>$id,'status'=>1])->one();
			$trade = $this->getTrade();
			$user = Yii::$app->user->identity;
			$data = [
				'out_trade_no'=>$trade,
				'user_id'=>$user->id,
				'username'=>$user->username,
				'deal_id'=>$deal->id,
				'deal_count'=>$count,
				'pay_status'=>Order::CHECKORDER,
				'total_price'=>$deal->current_price*$count,
				'pay_status'=>0,
				'referer'=>Yii::$app->request->getReferrer(),
			];
			$order = new Order;
			$order->scenario='add';
			$order->setAttributes($data);
			if(!$order->save()){
				return ['code'=>-1,'data'=>'确认失败'];
			}else{
				return ['code'=>1,'data'=>'确认成功'];
			}

		}
	}

	public function getTrade(){
		list($mic,$sec) = explode(' ',microtime());
		return $trade = $sec.($mic*10);
	}
}