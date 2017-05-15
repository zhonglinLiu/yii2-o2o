<!--包含头部文件-->
<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"><h1 style="text-align:center">商户登录系统</h1></div>
<div class="loginWraper">

  <div class="loginBox">
    <form class="form form-horizontal" id="liuform2">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="username" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      
      <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
      <div class="row cl">

        <div class="formControls col-xs-8 col-xs-offset-3">

          <input name="" type="submit" id="liusubmit2" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
          <a href="<?php echo Url::to(['register/index']) ?>"  ><input name="" type="button" class="btn btn-success radius size-L" value="&nbsp;申请&nbsp;&nbsp;&nbsp;&nbsp;入驻&nbsp;"></a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright tp5打造本地生活服务系统</div>
<!--包含尾部文件-->
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<script type="text/javascript">
  var SCOPE = {
    save_url:'<?php echo yii\helpers\Url::to(['login/index']) ?>',
    jump_url:'<?php echo yii\helpers\Url::to(['index/index']) ?>'
  }
</script>
<?php $this->beginBlock('viewJs') ?>
<script type="text/javascript">
$("#liuform2").validate({
    rules:{
            username:{
                required:true,
                minlength:2,
                maxlength:16
            },
            password:{
                required:true,
            }
            
            
        },
        
        onkeyup:false,
        focusCleanup:true,
        onfocusout:false,
        success:"valid",
        invalidHandler : function(){
              return false;
        },
        submitHandler:function(form){
          $(form).find(':submit').submit(function(){return false})
          formSubmit("#liuform2",'');

        }
})
</script>
<?php $this->endBlock() ?>
