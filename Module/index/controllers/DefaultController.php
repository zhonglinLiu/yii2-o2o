<?php

namespace app\Module\index\controllers;

use yii\web\Controller;
use yii\di\Container;
use yii\di\ServiceLocator;
use Yii;
use yii\base\Component;
use yii\base\Behavior;

/**
 * Default controller for the `index` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        ////依赖注入，让两个类解耦，并自动处理依赖关系
        /*$container = new Container;
        $container->set('app\Module\index\controllers\driver','app\Module\index\controllers\manDriver');
        $car = $container->get('app\Module\index\controllers\car');
        $car->run();*/
        //服务定位器
        /*Yii::$container->set('app\Module\index\controllers\driver','app\Module\index\controllers\manDriver');
        $sl = new ServiceLocator;
        $sl->set('car',[
        	'class'=>'app\Module\index\controllers\car',
        	]);
        $car = $sl->get('car');
        $car->run();*/

        //Yii::$app是一个服务定位器会加重web.php中的配置，把里面的配置注册成服务
        Yii::$container->set('app\Module\index\controllers\driver','app\Module\index\controllers\manDriver');
        Yii::$app->car->run();
        return;
    }

    //测试行为，为类或对象添加新的属性或方法
    public function actionBeh(){
        $dog = new dog();
        $dog->eat();
    }

    //测试控制器是否可以使用行为的属性或方法
    public function behaviors(){
        return [
            behController::className(),
        ];
    }
    public function actionBehCont(){
        Yii::beginProfile('pro1');//检测在其之间的程序运行时间
        $this->showController();
        Yii::beginProfile('pro1');
    }

    public function actionWeb(){
        
    }
}

//依赖注入，让两个类解耦，并自动处理依赖关系
/**
 * 司机接口类
 */
interface driver{
	public function drive();
}

/**
 * 男性司机类
 */
class manDriver implements driver {
	public function drive(){
		echo 'i am a old man';
	}
}
/**
 * 車类
 */
class car{
	private $driver;
	public function __construct(driver $driver){
		$this->driver = $driver;
	}

	public function run(){
		$this->driver->drive();
	}
}


//行为 为类或实例添加新的属性或方法

class Behavior1 extends Behavior{
    protected $height = '50cm';
    public function eat(){
        echo 'i can eating';
    }
}
//dog想使用行为里面的方法或属性需要继承Component
class dog extends Component{
    public function behaviors(){
        return [
            Behavior1::className(),
        ];
    }
}
//为控制器提高行为属性和方法，测试
class behController extends Behavior{
    protected $test = 'controller';
    public function showController(){
        echo 'i am a action from behaviors';
    }
}


//结论1
/*******************************************************/
/******控制器，模型可以直接使用行为的属性和方法*********/
/******一般的类需要继承Component才能使用行为的属性和方法*/
/****定义一个行为类需要继承Behavior*********************/
/**行为类的作用是让需要某些方法的类更方便的从行为类那里获取，提高了代码的扩展性***/
/********************************************************/

//结论二
/*依赖注入为两个关联的类解耦*/
/*yii\di\Container会自动处理依赖关联*/
/*服务定位器根据输入的参数把相应的类注册成服务*/
/*服务定位器调用yii\di\Container处理类的依赖关系*/
/*Yii::$app 是几个服务定位器它会加载web.php里的配置把相应的类注册成服务
如 Yii::$app->session;Yii::$app->cache;Yii::$app->redis;Yii::$app->mailer等等
*/
