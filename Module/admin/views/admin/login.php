<!--包含头部文件-->
<?php 
use yii\helpers\Url;
?>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"><h1 style="text-align:center">嘘!后台登录</h1></div>
<div class="loginWraper">

    <div id="loginform" class="loginBox">

        <form class="form form-horizontal" id="liu-form2" >
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3">验证码</label>
                <div class="formControls col-xs-8">
                    <input type="text" name="verifyCode" class="input-text size-L" placeholder="请输入验证码">
                    <br/>
                </div>

            </div>



            <div class="row cl">

                <div class="formControls col-xs-8 col-xs-offset-3">

                    <input name="" id="liu-submit2" type="button" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
            <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
        </form>
    </div>
</div>
<div class="footer">Copyright tp5打造本地生活服务系统</div>
<!--包含尾部文件-->
<?php $this->beginBlock('viewJs'); ?>
<script>
var SCOPE = {
    save_url:'<?php echo Url::to(['admin/login']) ?>',
    jump_url:'<?php echo Url::to(['index/index']) ?>'
}
</script>
<?php $this->endBlock() ?>
