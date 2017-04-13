<?php

namespace app\Module\admin\controllers;

use yii\web\Controller;

use Yii;

/**
 * Default controller for the `index` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = 'layout2';
    public function actionIndex()
    {
        $redis = Yii::$app->redis;
        $redis->select(0);
        $redis->set('name','liuzhonglin');
        return $this->render('index');
    }
    public function actionWelcome(){
    	return 'welcome to o2o';
    }

   

    
}
