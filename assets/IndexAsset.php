<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';  
    public $baseUrl = '@web';  
    //全局CSS  
   /* public $css = [  
        'index/css/base.css',
        'index/css/common.css', 
        'index/css/'.Yii::$app->controller->id.'.css' ,
    ];  
    //全局JS  
    public $js = [  
         'index/js/html5shiv.js',
         'index/js/respond.min.js',
         'index/js/jquery-1.11.3.min.js',
         'js/dialog/layer.js',
         'js/dialog.js'
    ]; */
    //依赖关系  
    public $depends = [  
       '\yii\web\JqueryAsset'
    ];  
  
     //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {  
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'app\assets\IndexAsset']);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {  
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'app\assets\IndexAsset']);  
    }  

     public function registerAssetFiles($view){
        $release = '123';
        $controller = Yii::$app->controller->id;

        $this->css = [
            'index/css/base.css',
            'index/css/common.css', 
            'index/css/'.$controller.'.css' ,
        ];
        $this->js = [
            'index/js/html5shiv.js',
             'index/js/respond.min.js',
             'js/dialog/layer.js',
             'js/dialog.js'
        ];
        parent::registerAssetFiles($view);

    }
 }
   

