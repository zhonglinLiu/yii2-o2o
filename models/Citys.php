<?php 
namespace app\models;
use yii\db\ActiveRecord;
class Citys extends ActiveRecord{
	public static function tableName(){
		return '{{%citys}}';
	}

	public function rules(){
		return [
			['name','required','message'=>'城市名不能为空','on'=>['add']],
			['name','unique','message'=>'该城市已存在'],
			['parent_id','required','message'=>'请选择城市','on'=>['add']],
			['parent_id','compare','compareValue'=>0,'operator'=>'>','message'=>'非法城市','on'=>['add']],
			[['uname','status'],'safe']
		];
	}

	public function getTopCitys(){
		$data = [
			'status'=>1,
			'parent_id'=>0,
		];
		$order = 'listorder desc';
		$rel = $this->find()->where($data)->orderby($order)->all();
		return $rel;
	}

	public function attributeLabels(){
		return [
			'name'=>'城市名',
			'uname'=>'城市英文名',
		];
	}
}