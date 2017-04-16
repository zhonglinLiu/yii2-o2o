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

	public function payStatus($status){
		if($status==0){
        	return '<span class="label label-warning radius" >待支付</span>';
	    }
	    if($status==1){
	        return '<span class="label label-info radius" >支付成功</span>';
	    }
	    if($status==2){
	        return '<span class="label label-danger radius" >支付失败</span>';
	    }
	    if($status==3){
	        return '<span class="label label-info radius" >已发货</span>';
	    }
	    if($status==4){
	        return '<span class="label label-success radius" >已收货</span>';
	    }
	}
}