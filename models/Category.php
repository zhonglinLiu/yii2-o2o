<?php 
namespace app\models;
use yii\db\ActiveRecord;
class Category extends ActiveRecord{
	public $childs;
	public static function tableName(){
		return "{{%category}}";
	}
	public function rules(){
		return [
			['name','required','message'=>'名称不能为空','on'=>['add']],
			['parent_id','required','message'=>'参数非法','on'=>['add']],
			['parent_id','number','message'=>'参数非法','on'=>['add']],
			['parent_id','compare','compareValue'=>0,'operator'=>'>','message'=>'分类错误','on'=>['add']],
			[['status'],'safe']
		];
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

	public function addCategory($data){
		$this->setAttributes($post);
		if($this->validate() && $this->save(false)){
			return true;
		}
		return false;
	}

	/**
	 * [buildList 返回的数据供dropDownList使用]
	 * @return [type] [description]
	 */
	public function buildList($pid = null){
		$select = [];
		if(is_null($pid)){
			$cates = $this->getTopCates();
		}else{
			$cates = $this->getCatesByPid($pid);
		}
		$select[0] = '分类';
		foreach ($cates as $value) {
			$select[$value->id] = $value->name;
		}
		return $select;
	}

	public function editById($id,$data){
		return $this->updateAll($data,'id=:id',[':id'=>$id]);
	}


	
}