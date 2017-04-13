<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HuiAsset extends AssetBundle
{
    public $basePath = '@webroot';  
    public $baseUrl = '@web';  
    //全局CSS  
    public $css = [  
        '/admin/hui/static/h-ui/css/H-ui.min.css',
        'admin/hui/static/h-ui.admin/css/H-ui.admin.css',
        'admin/hui/lib/Hui-iconfont/1.0.7/iconfont.css',
        'admin/hui/lib/icheck/icheck.css',
        ['admin/hui/static/h-ui.admin/skin/default/skin.css','id'=>'skin'],
        'admin/hui/static/h-ui.admin/css/style.css',
        'admin/css/common.css',
        'js/uploadify/uploadify.css'
    ];  
    //全局JS  
    public $js = [  
         'admin/hui/lib/jquery/1.9.1/jquery.min.js',
         'admin/hui/lib/layer/2.1/layer.js',
         'admin/hui/lib/My97DatePicker/WdatePicker.js',
         'admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js',
         'admin/hui/lib/jquery.validation/1.14.0/validate-methods.js',
         'admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js',
         'admin/hui/static/h-ui/js/H-ui.js',
         'admin/hui/static/h-ui.admin/js/H-ui.admin.js',
         'js/common.js',
         'js/uploadify/jquery.uploadify.js',
         'js/image.js',
         'js/dialog.js',
         ['admin/hui/lib/html5.js','condition'=>'let IE9','position'=>\yii\web\View::POS_HEAD],
         ['admin/hui/lib/respond.min.js','condition'=>'let IE9','position'=>\yii\web\View::POS_HEAD],
         ['admin/hui/lib/PIE_IE678.js','condition'=>'let IE9','position'=>\yii\web\View::POS_HEAD],
         ['http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js','condition'=>'let IE6','position'=>\yii\web\View::POS_HEAD],

    ]; 
    //依赖关系  
    public $depends = [  
       
    ];  

    public $jsOptions = [
        
    ];

    /*public function registerAssetFiles($view){
        $release = '123';
        $this->css = [
            'js/uploadify/uploadify.css?v='.$release;
        ];
        $this->js = [

        ];
        parent::registerAssetFiles($view);

    }*/
  
     //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {  
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'app\assets\HuiAsset']);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {  
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'app\assets\HuiAsset']);  
    }  
 }
   

