<?php

namespace app\Module\admin;

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

        // custom initialization code goes here
    }
}
