<?php 
namespace app\models;
use yii\db\ActiveRecord;
class Category extends ActiveRecord{
	public $childs;
	public static function tableName(){
		return "{{%category}}";
	}
	public function getTopCates($limit=null){
		$data = [
			'status'=>1,
			'parent_id'=>0,
		];
		$order ='listorder desc';
		$data = $this->find()->where($data)->orderby($order)->limit($limit)->all();
		return $data;
	}

	public function getCatesByPid($pid,$limit=null){
		$data = [
			'parent_id'=>$pid,
			'status'=>1
		];
		$order = 'listorder desc';
		return $this->find()->where($data)->orderby($order)->limit($limit)->all();
	}


	
}