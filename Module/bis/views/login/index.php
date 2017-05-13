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
    <?php $form = ActiveForm::begin([
      'options'=>['class'=>'form form-horizontal','id'=>'liu-form2']
    ])?>
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

        <div class="formControls col-xs-8 col-xs-offset-3">

          <input name="" type="button" id="liu-submit2" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
          <a href="<?php echo Url::to(['register/index']) ?>"  ><input name="" type="button" class="btn btn-success radius size-L" value="&nbsp;申请&nbsp;&nbsp;&nbsp;&nbsp;入驻&nbsp;"></a>
        </div>
      </div>
    <?php ActiveForm::end() ?>
  </div>
</div>
<div class="footer">Copyright tp5打造本地生活服务系统</div>
<!--包含尾部文件-->
<script type="text/javascript">
  var SCOPE = {
    save_url:'<?php echo yii\helpers\Url::to(['login/index']) ?>',
    jump_url:'<?php echo yii\helpers\Url::to(['index/index']) ?>'
  }
</script>
