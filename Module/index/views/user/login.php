<?php 
use yii\helpers\Url;
?>
<?php $this->beginBlock('viewCss') ?>
<link rel="stylesheet" href="/index/css/login.css" />
<?php $this->endBlock() ?>

    <div class="wrapper">
        <div class="head">
            <ul>
                <li><a href="index.html"><img src="/index/image/logo.png" alt="logo"></a></li>
                <li class="divider"></li>
                <li>登录</li>
            </ul>
            <div class="login-link">
                <span>还没o2o团购网帐号</span>
                <a href="<?php echo Url::to(['user/register']) ?>">注册</a>
            </div>
        </div>

        <div class="content">
            <div class="wrap">
                <div class="login-logo"></div>
                <div class="login-area">
                    <div class="title">登录</div>
                    <div class="login">
                        <form method="post" id="liuform2">
                            <div class="ordinaryLogin">
                                
                                <p class="pass-form-item">
                                    <label class="pass-label">用户名</label>
                                    <input type="text" name="username" class="pass-text-input"  placeholder="用户名">
                                </p>
                                <p class="pass-form-item">
                                    <label class="pass-label">密码</label>
                                    <input type="password" name="password" class="pass-text-input"   placeholder="密码">
                                </p>
                                
                            </div>
                           <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
                            <div class="commonLogin check_form">
                                <p class="pass-form-item ">
                                    <input type="submit" id="liusubmit2" value="登录" class="pass-button">
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <ul class="first">
               
            </ul>
            <ul class="second">
                
                
            </ul>
        </div>
    </div>
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
    <?php $this->beginBlock('viewJs') ?>
    <script type="text/javascript" src="/js/common.js"></script>
    <script>
    var SCOPE = {
        save_url:'<?php echo Url::to(['user/login']) ?>',
        jump_url:'<?php echo Url::to(['index/index']) ?>'
    }
        $(".pass-sms-btn").click(function(){
            $(".ordinaryLogin").css({display: "none"});
            $(".messageLogin,.question").css({display: "block"});
        });
        $(".pass-sms-link").click(function(){
            $(".messageLogin,.question").css({display: "none"});
            $(".ordinaryLogin").css({display: "block"});
        });

    $().ready(function(){
        $('#liuform2').validate({
            rules:{
                username:"required",
                password:"required",
            },
            submitHandler:function(form){
                $(form).find(':submit').submit(function(){
                    return false
                })
               formSubmit("#liuform2",'');
            }
        })
    })
    </script>
    <?php $this->endBlock() ?>
