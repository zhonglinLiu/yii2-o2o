<?php 
namespace app\Module\bis\controllers;
use yii\web\Controller;
use app\models\BisLocation;
use yii\data\Pagination;
use Yii;
use app\models\Category;
use app\models\Citys;
use yii\helpers\Myhelper;
use app\Module\bis\controllers\CommonController;
class LocationController extends CommonController{
	public $layout = 'layout2';
       protected $actions=[
            'index','add'
       ];
     protected $except=[];
	public function actionIndex(){
		$user = Yii::$app->bis->identity;
		$count = BisLocation::find()->where('status<>-1 and bis_id='.$user->bis_id)->count();
		$pageSize = Yii::$app->params['pageSize']['bis_location'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$locs = BisLocation::find()->where('status<>-1 and bis_id='.$user->bis_id)->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager'=>$pager,'locs'=>$locs]);
	}

	public function actionAdd(){
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$rel = Myhelper::getCoorByAddress($post['address']);
			$rel = json_decode($rel);
			if($rel->status==2 || $rel->status!=0){
                        return Myhelper::result(-1,'请正确填写地址');
                  }
                  if(!empty($rel->result) && $rel->result->precise!=1){
                      return Myhelper::result(-1,'请填写详细地址');
                  }
                  $post['xpoint'] = $rel->result->location->lat;
                  $post['ypoint'] = $rel->result->location->lng;
                  $post['bis_id'] = Yii::$app->bis->identity->bis_id;
                  if(isset($post['se_city_id']) && $post['se_city_id']!=''){
                  	$post['city_path'] = $post['city_id'].','.$post['se_city_id'];
                  }
                  if(isset($post['se_category_id']) && $post['se_category_id']!=''){
                  	$post['category_path'] = implode(',',$post['se_category_id']);
                  }
                  if(isset($post['id']) && $post['id']!=''){
                        $location = BisLocation::find()->where('id='.$post['id'])->one();
                  }else{
                        $location = new BisLocation;
                  }
                  
                  $location->scenario = 'add';
                  $location->setAttributes($post);
                  if($location->validate()){
            	if($location->save(false)){
            		return Myhelper::result(1,'申请成功');
            	}else{
            		return Myhelper::result(-1,'申请失败');
                  }
                  }else{
            	     return Myhelper::result(-1,$location->getErrors());
                  }
		}else{
                  $id = Yii::$app->request->get('id');
                  if(empty($id)){
                        $location = new BisLocation;
                  }else{
                        $location = BisLocation::find()->where(['id'=>$id])->one();
                  }
            }
		$cityModel = new Citys;
		$cateModel = new Category;
		$citys = $cityModel->getTopCitys();
		$cates = $cateModel->getTopCates();
            
		return $this->render('add',['citys'=>$citys,'cates'=>$cates,'model'=>$location]);
	}


}