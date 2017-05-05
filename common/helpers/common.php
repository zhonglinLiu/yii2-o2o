<?php 
namespace app\common\helpers;
use Yii;
class common{
	public static function showLocations($location_ids){
		if(preg_match('/,/', $location_ids)){
			return count(explode(',',$location_ids));
		}
		return 1;
	}
	public static function doCurl($url,$type=0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,$type);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER,false);
		$rel = curl_exec($ch);
		curl_close($ch);
		return $rel;
	}

	public static function sendEmail($email,$sub,$msg){
		$mail = Yii::$app->mailer->compose();
		$mail->setFrom('17739650739@163.com')
		->setTo($email)
		->setSubject($sub)
		->setHtmlBody($msg)
		->send();
	}


}