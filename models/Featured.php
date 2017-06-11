<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
class Featured extends ActiveRecord{
	public static function tableName(){
		return "{{%featured}}";
	}

	public function rules(){
		return [
			['type','required','message'=>'请选择推荐类型','on'=>['add']],
			['type','in','range'=>[0,1],'message'=>'请正确选择推荐类别','on'=>['add']],
			['url','required','message'=>'请上传封面图片','on'=>['add']],
			['title','required','message'=>'请填写title','on'=>['add']],
			['description','required','message'=>'请填上描述','on'=>['add']]
		];
	}

	public function beforeAction($action){
		return [
			[
				'class'=>TimestampBehavior::className(),
				'attributes'=>[
					ActiveRecord::EVENT_BEFORE_INSERT=>['create_time','update_time'],
					ActiveRecord::EVENT_BEFORE_UPDATE=>['update_time'],
				],
				'value'=>time(),
			],
		];	
	}

	public function getTops($limit=null){
		$data = [
			'status'=>1,
		];
		$order = 'listorder desc';
		return $this->find()->where($data)->orderby($order)->limit($limit)->all();
	}
	public function getRight($limit=1){
		$data = [
			'status'=>1,
		];
		$order = 'listorder desc';
		return $this->find()->where($data)->orderby($order)->limit($limit)->all();
	}

	public function add($data){
		$this->setAttributes($data);
		return $this->save();
	}
}