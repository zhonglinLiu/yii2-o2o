<?php 
use yii\captcha\Captcha;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
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
            <form method="post" id="liu-form2">
                <p class="pass-form-item">
                    <label class="pass-label">用户名</label>
                    <input type="text" name="username" class="pass-text-input check-null" placeholder="请设置用户名">
                </p>
                <p class="pass-form-item">
                    <label class="pass-label">邮箱号</label>
                    <input type="text" name="email" class="pass-text-input check-null" placeholder="可用于接受团购券账号和密码便于消费">
                </p>
                
                <p class="pass-form-item">
                    <label class="pass-label">密码</label>
                    <input type="password" name="password" class="pass-text-input check-null password" >
                </p>
                <p class="pass-form-item">
                    <label class="pass-label">确认密码</label>
                    <input type="password" name="repass" class="pass-text-input repass" >
                </p>
                <p class="pass-form-item">
                    <label class="pass-label">验证码</label>
                    <input type="text" name="verifyCode" class="pass-text-input " placeholder="请输入验证码">
                </p>
                <div>
                    <?php 
    echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'user/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer;margin-left:25px;'],'template'=>'{image}']);?>
                
                </div>
                
                <p class="pass-form-item check-form">
                    <input type="button" id="liu-submit2" value="注册" class="pass-button">
                </p>
            </form>
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
$('input.repass').blur(function(){
    if(this.value!=$('input.password').val()){
        dialog.tip('密码与确认密码不一致',this);
    }
})
</script>
<script type="text/javascript" src='/js/common.js' ></script>
<?php $this->endBlock() ?>