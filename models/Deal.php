<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\Category;
use app\models\Citys;
class Deal extends ActiveRecord{
	public static function tableName(){
		return "{{%deal}}";
	}

	public function rules(){
		return [
			['name','required','message'=>'团购名称不能为空'],
			['category_id','required','message'=>'请选择城市'],
			['bis_id','required','message'=>'内部错误1'],
			['location_ids','required','message'=>'请选择参加活动店铺'],
			['image','required','message'=>'请上传logo'],
			['description','required','message'=>'请填上商品描述信息'],
			['start_time','required','message'=>'请填写商品团购开始时间'],
			['end_time','required','message'=>'请填写商品团购结束时间'],
			['origin_price','required','message'=>'请填写商品原始价格'],
			['origin_price','number','message'=>'价格填写非法'],
			['current_price','required','message'=>'请填写当前价格'],
			['current_price','number','message'=>'价格填写非法'],
			['city_id','required','message'=>'请选择城市'],
			['city_id','integer','message'=>'请正确选择城市'],
			['total_count','required','message'=>'商品价格不能为空'],
			['total_count','number','message'=>'价格填写非法'],
			['coupons_begin_time','required','message'=>'消费券生效时间不能为空'],
			['coupons_end_time','required','message'=>'消费券结束时间不能为空'],
			['notes','required','message'=>'商品提示不能为空'],
			[['se_category_id','xpoint','ypoint','bis_account_id','status'],'safe']
		];
	}

	public function behaviors(){
		return [
			[
				'class'=>TimestampBehavior::className(),
				'attributes'=>[
					ActiveRecord::EVENT_BEFORE_INSERT=>['create_time','update_time'],
					ActiveRecord::EVENT_BEFORE_UPDATE=>['update_time'],
				]
			]
		];
	}

	public function getCategory(){
		return $this->hasOne(Category::className(),['id'=>'category_id'])->select(['id','name']);
	}
	public function getCitys(){
		return $this->hasOne(Citys::className(),['id'=>'city_id'])->select(['id','name']);
	}

	public function getDealByCid($cid,$city_id=null,$limit=10){
		$data = [
			'status'=>1,
			'Category_id'=>$cid,
		];
		if(!is_null($city_id)){
			$data['city_id'] = $city_id;
		}
		$order = 'listorder desc';
		return $this->find()->where($data)->andWhere(['>','end_time',time()])->orderby($order)->limit($limit)->all();
	}
	
}