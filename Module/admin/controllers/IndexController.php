<?php

namespace app\Module\admin\controllers;

use yii\web\Controller;

use Yii;

/**
 * Default controller for the `index` module
 */
class IndexController extends CommonController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = 'layout2';
    protected $actions=[
        'index','welcome'
    ];
    protected $except=[];
    public function actionIndex()
    {
        
        return $this->render('index');
    }
    public function actionWelcome(){
    	return 'welcome to o2o';
    }

   

    
}
