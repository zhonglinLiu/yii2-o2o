<?php

namespace app\Module\bis\controllers;

use yii\web\Controller;
use app\models\Category;
use app\models\Citys;
use app\models\Bis;
use app\models\BisAccount;
use app\models\BisLocation;
use yii\helpers\Myhelper;
use Yii;
/**
 * Default controller for the `index` module
 */
class RegisterController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = 'layout1';
    public function actionIndex()
    {
        if(Yii::$app->request->isPost){

            $post = Yii::$app->request->post();
            if(!empty($post['se_city_id']) ){
                $post['city_path'] = $post['city_id'].','.$post['se_city_id'];
            }
            $post['create_time'] = time();
            $post['update_time'] = time();
            if(!empty($post['se_category_id']) && is_array($post['se_category_id'])){
                $post['category_path'] = implode(',',$post['se_category_id']);
            }
            $rel = json_decode(Myhelper::getCoorByAddress($post['address']));
            if($rel->status!=0){
                return Myhelper::result(-1,'请正确填写地址');
            }
            if(!empty($rel->result) && $rel->result->precise!=1){
                return Myhelper::result(-1,'请填写详细地址');
            }
            $post['xpoint'] = $rel->result->location->lat;
            $post['ypoint'] = $rel->result->location->lng;
            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();  //开启事务
            try {
                $bismodel = new Bis();
                $bismodel->scenario = 'add';
                $bismodel->setAttributes($post);
                if($bismodel->validate()){
                    if(!$bismodel->save(false)){
                        throw new \Exception(json_encode("申请失败1"), 1);
                    }
                }else{
                    throw new \Exception(json_encode($bismodel->getErrors()));
                }
                $account = new BisAccount();
                $account->scenario = 'add';
                $post['code'] = mt_rand(1000,9999);
                if($post['password']==''){
                    throw new \Exception(json_encode('密码不能为空'), 1);
                    
                }
                $post['password'] = md5($post['password'].$post['code']);
                $post['bis_id'] = $bismodel->id;
                $post['is_main'] = 1;
                $account->setAttributes($post);

                if($account->validate()){
                    if(!$account->save(false)){
                        throw new \Exception(json_encode("申请失败2"), 1);
                    }
                }else{
                    // print_r($account->getErrors());
                    throw new \Exception(json_encode($account->getErrors()), 1);
                    
                }
                $location = new BisLocation();
                $location->scenario = 'add';
                $location->setAttributes($post);
                if($location->validate()){
                    if(!$location->save(false)){
                        throw new \Exception(json_encode('申请失败3'), 1);   
                    }
                    
                }else{
                    throw new \Exception(json_encode($location->getErrors()), 1);
                }
                $url = Yii::$app->request->hostInfo.'/'.'index.php?r=bis/register/waiting&id='.$post['bis_id'];
                $msg = '您的申请已成功提交,点击下面链接查看审核状态<br><a href="'.$url.'" >点我</a>';
                $rel = Myhelper::setEmail($post['email'],'xx商城注册',$msg);
                if($rel==false){
                    throw new \Exception(json_encode('邮件发送失败'), 1);
                    
                }
                $transaction->commit();
                return Myhelper::result(1,'申请成功,请注意查收邮件');
            } catch (\Exception $e) {
                return Myhelper::result(-1,json_decode($e->getMessage()));
                $transaction->rollBack();
            }
        }else{
            $cityModel = new Citys;
            $cateModel = new Category;
            $citys = $cityModel->getTopCitys();
            $cates = $cateModel->getTopCates();
            return $this->render('index',['citys'=>$citys,'cates'=>$cates]);
        }
            
    }

    public function actionWaiting(){
        $id = Yii::$app->request->get('id');
        if(empty($id)){
            return;
        }
        $bis = Bis::find()->where('id=:id',[':id'=>$id])->one();
        if($bis->status==1){
            return $this->render('/layouts/error',['msg'=>'入驻申请审核通过','url'=>\yii\helpers\Url::to(['/bis/login/index'])]);
        }
        return $this->render('waiting',['status'=>$bis->status]);

    }
}
