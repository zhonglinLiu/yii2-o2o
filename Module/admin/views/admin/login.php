<!--包含头部文件-->
<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style type="text/css">
    .form-group{width: 100%}
</style>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"><h1 style="text-align:center">嘘!后台登录</h1></div>
<div class="loginWraper">

    <div id="loginform" class="loginBox">
        
        <form class="form form-horizontal" id="liuform2" method="post"  >
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
               
               
           <input type="hidden" id="_csrf" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
           <div class="row cl">
               
               <div class="formControls col-xs-8 col-xs-offset-3">
               
                   <input name="" id="liusubmit2" type="submit"  class="btn btn-success radius size-L submit" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                   <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
               </div>
           </div>
           
               </form>
    </div>
</div>
<div class="footer">Copyright tp5打造本地生活服务系统</div>


<!-- <?php $this->registerJsFile('@web/js/jquery.validation/1.14.0/jquery.validate.js',['depends'=>'\yii\web\JqueryAsset']) ?> -->
<?php $this->beginBlock('viewJs'); ?>
<script>
var SCOPE = {
    save_url:'<?php echo Url::to(['admin/login']) ?>',
    jump_url:'<?php echo Url::to(['index/index']) ?>'
}
$().ready(function(){
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
                $(form).find(':submit').submit(function(){
                    return false
                });
               formSubmit("#liuform2",'');
            }
    })

})


</script>
<?php $this->endBlock() ?>
