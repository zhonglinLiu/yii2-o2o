<?php 
namespace app\common\components;
use yii\base\Widget;
class statusWidget extends Widget{
	public function init(){
		parent::init();
	}

	public function run(){

	}

	public function showStatus($status){
		switch ($status) {
			case -1:
				echo "<span class='label label-denger' >删除</span>";
				break;
			case 0:
				echo "<span class='label label-warning' >待审</span>";
				break;
			case 2:
				echo "<span class='label label-warning' >停用</span>";
				break;
			case 1:
				echo "<span class='label label-success' >正常</span>";
				break;
			default:
				# code...
				break;
		}
	}
}