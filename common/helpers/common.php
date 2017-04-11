<?php 
namespace app\common\helpers;
class common{
	public static function showLocations($location_ids){
		if(preg_match('/,/', $location_ids)){
			return count(explode(',',$location_ids));
		}
		return 1;
	}
}