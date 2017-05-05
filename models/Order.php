<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
class Order extends ActiveRecord{
	const CREATEORDER = 0;
	const CHECKORDER = 100;
	const PAYFAILED = 201;
	const PAYSUCCESS = 202;
	const SENDED = 220;
	const RECEIVED = 255;
	public static $status = [
		self::CREATEORDER => '创建订单',
		self::CHECKORDER => '确认订单',
		self::PAYFAILED => '支付失败',
		self::PAYSUCCESS =>'支付成功',
		self::SENDED =>'已发货',
		self::RECEIVED => '已收货',
	];
	public static function tableName(){
		return "{{%order}}";
	}
	public function rules(){
		return [
			['out_trade_no','required','message'=>'out_trade_no not null','on'=>['add']],
			['out_trade_no','number','message'=>'out_trade_no must be number','on'=>['add']],
			['user_id','required','message'=>'user_id not null','on'=>['add']],
			['user_id','number','message'=>'user_id must be number','on'=>['add']],
			['username','required','message'=>'username not null','on'=>['add']],
			['deal_count','required','message'=>'deal_count not null','on'=>['add']],
			['deal_count','number','message'=>'deal_count must be number','on'=>['add']],
			['deal_id','required','message'=>'deal_id not null','on'=>['add']],
			['deal_id','number','message'=>'deal_id must be number','on'=>['add']],
			['pay_status','required','message'=>'pay_status not null','on'=>['add']],
			['pay_status','number','message'=>'pay_status must be number','on'=>['add']],
			['total_price','required','message'=>'total_price not null','on'=>['add']],
			['total_price','number','message'=>'total_price must be number','on'=>['add']],
			['referer','required','message'=>'referer is required','on'=>['add']],
		];
	}
	public function behaviors(){
		return [
			[
				'class'=>TimestampBehavior::className(),
				'attributes'=>[
					ActiveRecord::EVENT_BEFORE_INSERT =>['update_time','create_time'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time']
				],
			],
		];
	}
}