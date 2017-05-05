<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use Yii;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RbacController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSetpremission(){
    	$path = dirname(__DIR__).'/Module/admin/controllers';
    	$controllers = glob($path.'/*');
    	$premissions = [];
    	foreach ($controllers as $controller) {
    		preg_match('/([a-zA-Z]+)Controller/', $controller,$matchs);
    		$control = strtolower($matchs[1]);
    		$permissions[] = $control.'/*';
    		$cont = file_get_contents($controller);
    		preg_match_all('/function action([a-zA-Z_]+)/', $cont, $matches);
    		foreach ($matches[1] as $v) {
    			$permissions[] = $control.'/'.strtolower($v);
    		}
    	}
    	$auth = Yii::$app->authManager;
    	try {
    		$trans = Yii::$app->db->beginTransaction();
    		foreach ($permissions as $permission) {
    			if(!$auth->getPermission($permission)){
    				$obj = $auth->createPermission($permission);
    				$obj->description = $permission;
    				$auth->add($obj);
    			}
    		}
    		$trans->commit();
    		echo 'success';
    	} catch (\Exception $e) {
    		$trans->rollback();
    		echo $e->getMessage();
    	}
    	
    	
    }
}
