<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\Bis;
use app\models\Category;
class BisLocation extends ActiveRecord{
	public static function tableName(){
		return '{{%bis_location}}';
	}

	public function behaviors()
	{
	    return [
	        [
	            'class' => TimestampBehavior::className(),
	            'attributes' => [
	                ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
	                ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
	            ],
	            // if you're using datetime instead of UNIX timestamp:
	            // 'value' => new Expression('NOW()'),
	        ],
	    ];
	}

	public function rules(){
		return [
			['name','required','message'=>'名称不能为空','on'=>['add']],
			['logo','required','message'=>'请上传公司logo','on'=>['add']],
			['address','required','message'=>'商户地址不能为空','on'=>['add']],
			['tel','required','message'=>'商户电话不能为空','on'=>['add']],
			['category_id','required','message'=>'栏目不能为空','on'=>['add']],
			['category_id','number','message'=>'请正确现在栏目','on'=>['add']],
			['contact','required','message'=>'联系人不能为空','on'=>['add']],
			['city_id','required','message'=>'请选择城市','on'=>['add']],
			['city_id','number','message'=>'请正确选择城市','on'=>['add']],
			['bank_info','required','message'=>'请填写银行账户','on'=>['add']],
			['content','required','message'=>'店铺简介不能为空','on'=>['add']],
			['open_time','default','value'=>0,'on'=>['add']],
			[['xpoint','ypoint','bis_id','open_time','is_main','city_path','category_path','create_time','update_time'],'safe']
		];
	}

	public function getBis(){
		return $this->hasOne(Bis::className(),['id'=>'bis_id']);
	}

	public function get_se_category(){
		$se_categoryids = explode(',',$this->category_path);
		if(isset($se_categoryids[$this->category_id])) unset($se_categoryids[$this->category_id]);
		$categorys = Category::findAll($se_categoryids);
		return $categorys;

	}

	public function changeStatusByBid($bis_id,$status){
		$this->updateAll(['status'=>$status],'bis_id=:id and is_main=1',[':id'=>$bis_id]);
	}
}