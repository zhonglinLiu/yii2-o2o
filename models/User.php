<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use Yii;
class User extends ActiveRecord implements \yii\web\IdentityInterface{
    public $verifyCode;
    public $repass;
    public static function tableName(){
       return "{{%user}}";
    }

   
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules(){
        return [
            ['username','required','message'=>'用户名不能为空','on'=>['login','register']],
            ['username','unique','message'=>'该用户已被注册','on'=>['register']],
            ['password','required','message'=>'密码不能为空','on'=>['login','register']],
            ['password','validateLogin','message'=>'账号或密码错误','on'=>['login']],
            // ['verifyCode','captcha','message'=>'验证码错误','on'=>['register']],
            ['email','unique','message'=>'该邮箱已被注册','on'=>['register']],
            ['email','required','message'=>'邮箱不能为空','on'=>['register']],
            ['email','email','message'=>'请正确填写email','on'=>['register']],
            ['status','default','value'=>1,'on'=>['register']],
            ['repass', 'compare', 'compareAttribute' => 'password', 'operator' => '==','on'=>['register']],
        ];
    }

    public function validateLogin(){
        if(!$this->hasErrors()){
            $user = $this->find()->where(['username'=>$this->username])->one();
            if(empty($user)) return $this->addError('username','用户不存在');
            if($user->password!=md5($this->password.$user->code)){
                return $this->addError('username','用户名或密码错误');
            }
            Yii::$app->user->login($user,3600);
            return;
        }
           
    }

    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密码'
        ];
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null){

    }
    public function getId(){
        return $this->id;
    }
     public function getAuthKey(){

     }
     public function validateAuthKey($authKey){
        
     }
   
}