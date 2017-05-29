<?php 
namespace app\models;
use yii\db\ActiveRecord;
class Citys extends ActiveRecord{
	public static function tableName(){
		return '{{%citys}}';
	}

	public function rules(){
		return [
			['name','required','message'=>'城市名不能为空','on'=>['add','edit']],
			['name','unique','message'=>'该城市已存在','on'=>['add','edit']],
			['parent_id','required','message'=>'请选择城市','on'=>['add','edit']],
			['parent_id','compare','compareValue'=>0,'operator'=>'>','message'=>'非法城市','on'=>['add','edit']],
			[['uname','status','id'],'safe']
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

	public function add($data){
		$this->load($data);
		if($this->validate() && $this->save(false)){
			return true;
		}
		return false;
	} 

	public function buildList(){
		$citys = $this->getTopCitys();
		$select[0] = '分类';
		foreach ($citys as $value) {
			$select[$value->id] = $value->name;
		}
		return $select;
	}

	public function editById($id,$data){
		return $this->updateAll($data,'id=:id',[':id'=>$id]);

	}
}