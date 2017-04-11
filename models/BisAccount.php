<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
class BisAccount extends ActiveRecord{
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
			['repass','required','message'=>'确认密码不能为空'],
			['repass','compare','compareAttribute'=>'password','message'=>'密码与确认密码不一致','on'=>['create']],
			[['code','bis_id','last_login_ip','last_login_time','is_main','create_time','update_time'],'safe'],
		];
	}
}