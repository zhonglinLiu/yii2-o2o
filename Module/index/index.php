<?php

namespace app\Module\index;
use Yii;
/**
 * index module definition class
 */
class index extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\Module\index\controllers';

    /**
     * @inheritdoc
     */
    // public $defaultRoute = 'index';
    public function init()
    {
        parent::init();
        Yii::configure($this,require(__DIR__.'/config.php'));
        
        // custom initialization code goes here
    }
}
