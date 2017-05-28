<?php 
namespace app\Module\service\admin;
use app\models\Bis;
use app\models\BisAccount;
use app\models\BisLocation;
class BisService{
	public function changeStatus($id,$status){

		(new Bis)->changeStatus($id,$status);
		(new BisAccount)->changeStatusByBid($id,$status);
		(new BisLocation)->changeStatusByBid($id,$status);
	}
}