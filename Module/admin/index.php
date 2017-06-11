<?php

namespace app\Module\admin;
use Yii;
/**
 * index module definition class
 */

class index extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $defaultRoute = 'index';
    public $controllerNamespace = 'app\Module\admin\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::configure($this,require(__DIR__.'/config.php'));
        // custom initialization code goes here
    }
}
