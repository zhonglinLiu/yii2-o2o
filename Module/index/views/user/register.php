<?php 
use yii\captcha\Captcha;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $this->registerCssFile('@web/index/css/user1.css') ?>
<style type="text/css">
    .has-error{
        position: relative;
    }
    .help-block{
        color: red;
        position: absolute;
        right: 15px;
        top:10px;
    }
</style>
    <div class="wrapper">
        <div class="head">
            <ul>  
                <li><a href="index.html"><img src="/index/image/logo.png" alt="logo"></a></li>
                <li class="divider"></li>
                <li><a href="index.html"></a></li>
            </ul>
            <div class="login-link">
                <span>我已注册，现在就</span>
                <a href="<?php echo Url::to(['user/login']) ?>">登录</a>
            </div>
        </div>



        
        <div class="content">
        <?php 
            if(Yii::$app->session->hasFlash('info')){
                echo Yii::$app->session->getFlash('info');
            }

        ?>
            <?php $form = ActiveForm::begin([
                'options'=>['id'=>'liuform2'],
            ]) ?>
            <p class="pass-form-item">
                <?php echo $form->field($model,'username')->textInput(['class'=>'pass-text-input','placeholder'=>'请设置用户名'])->label('用户名',['class'=>'pass-label']) ?>
            </p>
            <p class="pass-form-item">
                <?php echo $form->field($model,'email')->textInput(['class'=>'pass-text-input','placeholder'=>'可用于接受团购券账号和密码便于消费'])->label('邮箱号',['class'=>'pass-label']) ?>
            </p>
             <p class="pass-form-item">
                <?php echo $form->field($model,'password')->textInput(['class'=>'pass-text-input'])->label('密码',['class'=>'pass-label']) ?>
            </p>
            <p class="pass-form-item">
                <?php echo $form->field($model,'repass')->textInput(['class'=>'pass-text-input'])->label('确认密码',['class'=>'pass-label']) ?>
            </p>
            <p class="pass-form-item">
                <?= $form->field($model,'verifyCode')->widget(yii\captcha\Captcha::className(),[
                'captchaAction'=>'/index/user/captcha',
                'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer'],
                'template' => "{input}{image}",
                'options'=>['class'=>'pass-text-input']
            ])->label('验证码',['class'=>'pass-label']);?>
            </p>
                
             <p class="pass-form-item check-form">
                <?php echo Html::submitButton('注册',['class'=>'pass-button']) ?>
            </p>

            <?php ActiveForm::end() ?>
        </div>
        
        
        <div class="foot">
            <div>
                <div>2016&nbsp;©Baidu</div>
            </div>
        </div>
    </div>
<?php $this->beginBlock('viewJs') ?>
<script type="text/javascript">
    var SCOPE = {
    save_url: "<?php echo Url::to(['user/register']) ?>",
    jump_url: "<?php echo Url::to(['user/login']) ?>"
}

</script>
<?php $this->endBlock() ?>