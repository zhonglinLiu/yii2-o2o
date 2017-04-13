<?php
namespace app\Module\bis\controllers;
use yii\web\Controller;
// use app\controllers\common\BaseController;
class CommonController extends Controller{
	 /*protected $field = 'bis';
     protected $allowAction = [
           'login/index',
     ];*/
     // protected $redirect = 'login/index';
     protected $actions=[];
     protected $except=[];
     public function behaviors(){
		return [
			'access'=>[
				'class'=>\yii\filters\AccessControl::className(),
				'only'=>['*'],
				'user'=>'bis',
				'except'=>$this->except,
				'rules'=>[
					[
						'allow'=>false,
						'actions'=>$this->actions,
						'roles'=>['?'],
					],
					[
						'allow'=>true,
						'actions'=>$this->actions,
						'roles'=>['@'],
					]
				]
			]
		];
	}
}