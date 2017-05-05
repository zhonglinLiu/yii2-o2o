<?php 
namespace app\common\helpers;
use Yii;
use app\common\helpers\common;
class map{
	public static function getCoorByAddress($position){
		//http://api.map.baidu.com/geocoder/v2/?address=北京市海淀区上地十街10号&output=json&ak=E4805d16520de693a3fe707cdc962045&callback=showLocation
		$map = Yii::$app->params['map'];
		$url = $map['url'].$map['geocoder'];
		$data = [
			'address'=>$position,
			'output'=>'json',
			'ak'=>$map['ak'],
		];
		$url=$url.'?'.http_build_query($data);
		return common::doCurl($url);
	}

	public static function getStaticImg($position,$width=300,$height=200){
		//http://api.map.baidu.com/staticimage/v2?ak=E4805d16520de693a3fe707cdc962045&mcode=666666&center=116.403874,39.914888&width=300&height=200&zoom=11
		$map = Yii::$app->params['map'];
		$url = $map['url'].$map['staticimage'];
		$data = [
			'ak'=>$map['ak'],
			'center'=>$position,
			'width'=>$width,
			'height'=>$height
		];
		$url = $url.'?'.http_build_query($data);
		return common::doCurl($url);
	}
}