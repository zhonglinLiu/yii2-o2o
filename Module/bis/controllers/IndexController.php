<?php 
namespace app\Module\bis\controllers;
use yii\web\Controller;
use Yii;
use app\Module\bis\controllers\CommonController;
class IndexController extends CommonController{
	public $layout = 'layout2';
	 protected $actions=['index'];
     protected $except=[];
	public function actionIndex(){
		return $this->render('index');
	}
	
}