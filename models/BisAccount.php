<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
class BisAccount extends ActiveRecord implements \yii\web\IdentityInterface {
	public $repass;
	public static function tableName(){
		return "{{%bis_account}}";
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
	public function rules(){
		return [
			['username','required','message'=>'用户名不能为空','on'=>['add','login','create']],
			['password','required','message'=>'密码不能为空','on'=>['add','login','create']],
			['repass','required','message'=>'确认密码不能为空','on'=>['create']],
			['repass','compare','compareAttribute'=>'password','message'=>'密码与确认密码不一致','on'=>['create']],
			[['code','bis_id','last_login_ip','last_login_time','is_main','create_time','update_time'],'safe'],
		];
	}

	public function changeStatusByBid($bis_id,$status){
		$this->updateAll(['status'=>$status],'bis_id=:id and is_main=1',[':id'=>$bis_id]);
	}

	public function getUser(){
		return $this->find()->where('username=:uname',[':uname'=>$this->username])->one();
	}

	

	public static function findIdentity($id){
		return static::findOne($id);
	}
	public static function findIdentityByAccessToken($token, $type = null){

	}

	public function getId(){
		return $this->id;
	}

	public function getAuthKey(){

	}

	public function validateAuthKey($authKey){

	}
}