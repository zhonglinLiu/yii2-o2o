<?php 
namespace app\Module\api\controllers;
use yii\web\Controller;
use yii\web\UploadedFile;
class ImageController extends Controller{
	public function beforeAction($current){
		$action = [
			'actionUploadImage',
		];
		if(in_array($current->actionMethod, $action)){
			$current->controller->enableCsrfValidation = false;
		}
		parent::beforeAction($current);
		return true;
	}
	public function actionUploadImage(){
		/*$file = UploadedFile::getInstanceByFileName('imgFile');
		$path = 'upload/'.date('Y').'/'.date('m').'/'.date('d').'/'.$file->name;*/
		$upload = new UploadedFile();
		$file = $upload::getInstanceByName('imgFile');
		$path = 'upload/'.date('Y').'/'.date('m').'/'.date('d');
		if(!is_dir($path)){
			mkdir($path,0777,true);
		}
		$filename = time().mt_rand(1000,9999).$file->getExtension();
		$file->saveAs($path.'/'.$filename);
		return \yii\helpers\Myhelper::result(1,$path.'/'.$filename);
		// print_r($file);
	}
}