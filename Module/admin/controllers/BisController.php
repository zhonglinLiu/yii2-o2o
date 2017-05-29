<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use app\models\Bis;
use yii\data\Pagination;
use Yii;
use app\models\BisLocation;
use app\models\Citys;
use app\models\Category;
use app\models\BisAccount;
use app\common\helpers\common;
use app\Module\service\admin\BisService;
class BisController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
		'index','detail','status'
	];
    protected $except=[];
	public function actionIndex(){
		$status = Yii::$app->request->get('status');
		$count = Bis::find()->where('status='.$status)->count();
		$pageSize = Yii::$app->params['pageSize']['bis'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$biss = Bis::find()->where('status='.$status)->limit($pager->limit)->offset($pager->offset)->all();

		return $this->render('index',['biss'=>$biss,'pager'=>$pager]);
	}

	public function actionDetail(){
		$id = Yii::$app->request->get('id');
		$bisModel = new Bis();
		$bis = $bisModel->getBisById($id);
		$se_city = $bis->getSeCitys();

		$citys = (new Citys)->getTopCitys();
		$cates = ( new Category)->getTopCates();

		$location = BisLocation::find()->where('is_main=1 and bis_id='.$bis->id)->one();
		$location_se_cates = explode(',',$location->category_path);
		
		$bis_account = BisAccount::find()->where('is_main=1 and bis_id='.$bis->id)->one();

		$se_cates = $location->get_se_category();
		return $this->render('detail',['bis'=>$bis,'se_city'=>$se_city,'citys'=>$citys,'location'=>$location,'cates'=>$cates,'account'=>$bis_account,'se_cates'=>$se_cates]);
	}
	
	public function actionStatus(){
		$data = Yii::$app->request->get();
		$status = intval($data['status']);
		$id = intval($data['id']);
		if(is_null($status) ||  is_null($id)){
			return '参数错误';
		}
		$db = Yii::$app->db;
		$transaction = $db->beginTransaction();
		try {
			
			(new BisService)->changeStatus($id,$status);
			$email = Bis::findOne($id)->email;
			$url = Yii::$app->request->hostInfo.'/'.'index.php?r=bis/login/index';
            $msg = '您的申请已经通过<br><a href="'.$url.'" >点我登录</a>';
            $rel = common::sendEmail($email,'xx商城注册',$msg);
            if($rel==false){
                throw new \Exception(json_encode('邮件发送失败'), 1);
            }
			$transaction->commit();
			$this->redirect($_SERVER['HTTP_REFERER']);
		} catch (\Exception $e) {
			return $this->render('/index/error',['msg'=>'修改失败']);
			$transaction->rollBack();
		}
	}
}