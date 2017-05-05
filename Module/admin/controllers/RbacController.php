<?php 
namespace app\Module\admin\controllers;
use yii\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\Module\admin\models\Rbac;
use app\Module\admin\models\Admin;
class RbacController extends CommonController{
	public $layout = 'layout2';
	protected $actions=[
	 'roles','addrole','permissions','addpermission','assign-item','assignrole','admins'
	 ];
     protected $except=[];
	public function actionAddrole($name = null){
		$auth = Yii::$app->authManager;
		$obj = $auth->getRole($name);
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			if(!is_null($name)){
				$role = null;
				if(!is_null($name)){
					$role = $auth->getRole($name);
				}
				$role->name = $data['name'];
				$role->description = !empty($data['description'])?$data['description']:null;
				$role->ruleName = !empty($data['rule_name'])?$data['rule_name']:null;
				$role->data = !empty($data['data'])?$data['data']:null;
				$auth->update($name,$role);
			}else{
				$role = $auth->createRole(null);
				$role->name = $data['name'];
				$role->description = !empty($data['description'])?$data['description']:null;
				$role->ruleName = !empty($data['rule_name'])?$data['rule_name']:null;
				if($auth->add($role)){
					Yii::$app->session->setFlash('info','添加成功');
				}else{
					Yii::$app->session->setFlash('info','添失败');
				}
			}
				
		}
		return $this->render('addrole',['obj'=>$obj]);
	}

	public function actionRoles(){
		$auth = Yii::$app->authManager;
		$provider = new ActiveDataProvider([
		    'query' => (new Query)->from($auth->itemTable)->where('type=1')->orderBy('created_at desc'),
		    'pagination' => [
		        'pageSize' => 10,
		    ],
		]);
		return $this->render('roles',['dataProvider'=>$provider]);
	}

	public function actionPermissions(){
		$auth = Yii::$app->authManager;
		$provider = new ActiveDataProvider([
		    'query' => (new Query)->from($auth->itemTable)->where('type=2')->orderBy('created_at desc'),
		    'pagination' => [
		        'pageSize' => 10,
		    ],
		]);
		return $this->render('permissions',['dataProvider'=>$provider]);
	}

	public function actionAddpermission($name=null){
		$auth = Yii::$app->authManager;
		$obj = null;
		if(!is_null($name)){
			$obj = $auth->getPermission($name);
		}
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			if(empty($data['name']) || empty($data['description'])){
				return '标识与描述';
			}
			if(!is_null($name)){
				$permission = $auth->getPermission($name);
				$permission->name = $data['name'];
				$permission->description = !empty($data['description'])?$data['description']:null;
				$permission->ruleName = !empty($data['rule_name'])?$data['rule_name']:null;
				$permission->data = !empty($data['data'])?$data['data']:null;
				$auth->update($name,$permission);
			}else{
				if(!isset($data['name']) || $data['name']=='' ){
					Yii::$app->session->setFlash('info','权限名不能为空');
				}else{
					$permission = $auth->createPermission(null);
					$permission->name = $data['name'];
					$permission->description = !empty($data['description'])?$data['description']:null;
					$permission->ruleName = !empty($data['rule_name'])?$data['rule_name']:null;
					if($auth->add($permission)){
						Yii::$app->session->setFlash('info','添加成功');
					}else{
						Yii::$app->session->setFlash('info','添加失败');
					}
				}
			
			}

				
		}
		return $this->render('addpermission',['obj'=>$obj]);
	}

	public function actionAssignItem($name){
		if(empty($name)){
			return '参数错误';
		}
		
		$roles = Rbac::getRoles($name);
		$permissions = Rbac::getPermissions($name);
		$auth = Yii::$app->authManager;
		$role = $auth->getRole($name);
		
		if(Yii::$app->request->isPost){
			$children = Yii::$app->request->post('children');
			if(Rbac::addChild($children,$name)){
				Yii::$app->session->setFlash('info','添加成功');
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
		}
		$children = Rbac::getChildByName($name);
		return $this->render('assignItem',[
			'rolename'=>$role->name,
			'roles'=>$roles,
			'permissions'=>$permissions,
			'children'=>$children,
		]);
	}

	public function actionAdmins(){
		$auth = Yii::$app->authManager;
		$porvider = new ActiveDataProvider([
				'query'=>Admin::find()->where('status <> -1'),
				'pagination'=>[
					'pageSize'=>10,
				]
			]
		);
		return $this->render('admins',['dataProvider'=>$porvider]);
	}

	/*
	添加角色
	 */
	
	public function actionAssignrole($id){
		if(empty($id)){
			return '参数错误';
		}
		$admin = Admin::find()->where(['id'=>intval($id)])->one();
		$roles = Rbac::getRoles();
		$permissions = Rbac::getPermissions();
		$auth = Yii::$app->authManager;
		if(Yii::$app->request->isPost){
			$children = Yii::$app->request->post('children');
			if(Rbac::assignItem($children,$id)){
				Yii::$app->session->setFlash('info','添加成功');
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
		}
		$children = Rbac::getChildByUser($id);
		return $this->render('assignrole',[
			'username'=>$admin->username,
			'roles'=>$roles,
			'permissions'=>$permissions,
			'children'=>$children
			]);
	}

	/*
	删除权限
	 */
	public function actionDeleteitem($name){
		$auth = Yii::$app->authManager;
		$obj = $auth->getPermission($name);
		if(empty($obj)){
			return '参数错误';
		}
		$auth->remove($obj);
		return $this->redirect($_SERVER['HTTP_REFERER']);
	}
}