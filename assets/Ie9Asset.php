<?php 

namespace app\assets;

use yii\web\AssetBundle;
class Ie9Asset extends AssetBundle{
	public $basePath = '@webroot';  
    public $baseUrl = '@web';  
    public $cssOptions = ['condition' => 'lte IE9'];
    public $css = [
    	'admin/hui/lib/html5.js',
    	'admin/hui/lib/respond.min.js',
    	'admin/hui/lib/PIE_IE678.js',
    ];
    

}