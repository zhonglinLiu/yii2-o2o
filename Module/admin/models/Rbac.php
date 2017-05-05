<?php 
namespace app\Module\admin\models;
use yii\base\Model;
use Yii;
class Rbac extends Model{
	public static function getRoles($name=null){
		$auth = Yii::$app->authManager;
		$roles = $auth->getRoles();
		$arr = [];
		foreach ($roles as $role) {
			if($role->name!=$name){
				$arr[$role->name] = $role->description;
			}
		}
		return $arr;
	}

	public static function getPermissions($name=null){
		
		$auth = Yii::$app->authManager;
		$permissions = $auth->getPermissions();
		$arr = [];
		foreach ($permissions as $permission) {
			$arr[$permission->name] = $permission->description;
		}
		return $arr;
	}

	public static function addChild($children,$parent){
		$auth = Yii::$app->authManager;
		$role = $auth->getRole($parent);
		if(empty($role)){
			return false;
		}
		
		$trans = Yii::$app->db->beginTransaction();
		try {
			$auth->removeChildren($role);
			foreach ($children as $child) {
				$obj = empty($auth->getRole($child)) ? $auth->getPermission($child):$auth->getRole($child);
				$auth->addChild($role,$obj);
			}
			$trans->commit();
			return true;
		} catch (\Exception $e) {
			$trans->rollback();
			return false;
		}
		
	}

	public static function getChildByName($name){
		if(empty($name)){
			return false;
		}
		$auth = Yii::$app->authManager;
		$children = $auth->getChildren($name);
		if(empty($children)){
			return false;
		}
		$arr = [];
		$arr['roles'] = [];
		$arr['permissions'] = [];
		foreach ($children as $child) {
			if($child->type==1){
				$arr['roles'][]=$child->name;
			}else{
				$arr['permissions'][]=$child->name;
			}
		}
		return $arr;
	}

	/*
	通过用户获取角色和权限
	 */
	public static function getChildByUser($userid){
		if(empty($userid)){
			return false;
		}
		$arr = [];
		$arr['roles'] = [];
		$arr['permissions'] = [];
		$auth = Yii::$app->authManager;
		$roles = $auth->getRolesByUser($userid);
		$permissions = $auth->getPermissionsByUser($userid);
		foreach ($permissions as $permission) {
			$arr['permissions'][] = $permission->name;
		}
		foreach ($roles as $role) {
			$arr['roles'] = $role->name;
		}
		return $arr;
	}

	/*
	授权
	 */
	public static function assignItem($children,$userid){
		if(empty($children) || empty($userid)){
			return false;
		}
		$trans = Yii::$app->db->beginTransaction();
		$auth = Yii::$app->authManager;
		try {
			$auth->revokeAll($userid);
			foreach ($children as $child) {
				$role = !empty($auth->getRole($child)) ? $auth->getRole($child) : $auth->getPermission($child);
				if(!empty($role)){
					$auth->assign($role,$userid);
				}
			}
			$trans->commit();
			return true;
		} catch (\Exception $e) {
			echo $e->getMessage();
			$trans->rollback();
			return false;
		}
	}
}