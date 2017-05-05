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
		$bis = Bis::find()->where('id=:id',[':id'=>$id])->one();
		$citypath = explode(',',$bis->city_path);
		if(count($citypath)>1){
			$se_city_id = $citypath[1];
			$flog = 1;
		}else{
			$flog = 0;
		}
		$model = new Citys;
		$se_city = Citys::find()->select(['name','id'])->where('id=:id',[':id'=>$se_city_id])->one();
		$citys = $model->getTopCitys();
		$cateModel = new Category;
		$cates = $cateModel->getTopCates();
		$location = BisLocation::find()->where('is_main=1 and bis_id='.$bis->id)->one();
		$location_se_cates = explode(',',$location->category_path);
		$bis_account = BisAccount::find()->where('is_main=1 and bis_id='.$bis->id)->one();
		unset($location_se_cates[0]);
		$se_cates_id = [];
		foreach ($location_se_cates as $k => $v) {
			$se_cates_id[]='id = '.$v;
		}
		if(count($se_cates_id)<2){
			$se_cates_str = implode(' or ',$se_cates_id);
		}else{
			$se_cates_str = $se_cates_id[0];
		}
		$se_cates = Category::find()->where($se_cates_str)->all();
		return $this->render('detail',['bis'=>$bis,'se_city'=>$se_city,'citys'=>$citys,'flog'=>$flog,'location'=>$location,'cates'=>$cates,'location_se_cates'=>$location_se_cates,'account'=>$bis_account,'se_cates'=>$se_cates]);
	}
	public function actionStatus(){
		$data = Yii::$app->request->get();
		$status = intval($data['status']);
		$id = intval($data['id']);
		if(!$status ||  !$id){
			throw new \Exception("内部错误", 1);
			
		}
		$db = Yii::$app->db;
		$transaction = $db->beginTransaction();
		try {
			$bis = Bis::find()->where(['id'=>$id])->one();
			$bis->status = 1;
			if(!$bis->save()){
				throw new \Exception("修改失败");
			} 
			$rel = BisAccount::updateAll(['status'=>1],'bis_id=:bid',[':bid'=>$id]);
			if(!$rel){
				throw new \Exception("修改失败");
			}
			$rel = BisLocation::updateAll(['status'=>1],'bis_id=:bid',[':bid'=>$id]);
			if(!$rel){
				throw new \Exception("修改失败");
			}
			$url = Yii::$app->request->hostInfo.'/'.'index.php?r=bis/login/index';
            $msg = '您的申请已经通过<br><a href="'.$url.'" >点我登录</a>';
            $rel = common::sendEmail($bis->email,'xx商城注册',$msg);
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