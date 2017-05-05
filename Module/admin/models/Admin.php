<?php 
namespace app\Module\admin\models;
use yii\db\ActiveRecord;
class Admin extends ActiveRecord implements \yii\web\IdentityInterface{
	public $admin = null;
	public static function  tabelName(){
		return "{{%admin}}";
	}

	public function behavoirs(){
		[
			[
				'class'=>\yii\behaviors\TimestampBehavior::className(),
				'attrbiutes'=>[
					ActiveRecord::EVENT_BEFORE_INSERT =>['create_time','update_time'],
					ActiveRecord::EVENT_BEFORE_UPDATE=>['update_time'],
				],
			]

		];
	}

	public function rules(){
		return [
			['username','required','message'=>'用户名不能为空','on'=>['login']],
			['password','required','message'=>'密码不能为空 ','on'=>['login']],
			['password','checkLogin','on'=>['login']],
		];
	}

	public function checkLogin(){
		$this->admin = $rel = $this->find()->where(['username'=>$this->username])->one();
		if(empty($rel)){
			$this->addError('username','用户名不存在');
			return false;
		}
		if($rel->password != md5($this->password.$rel->code)){
			$this->addError('password','账号或密码错误');
			return false;
		}
		return true;
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