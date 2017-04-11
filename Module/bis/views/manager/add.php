<!--包含头部文件-->
<?php 
use yii\helpers\Url;
?>
<body>
<div class="page-container">
	<form class="form form-horizontal form-o2o-add" id="liu-form2"  >
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>管理员名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text check_null" attr-msg='用户名不能为空' value="<?php echo $model->username ?>" placeholder="必填" id="name" name="username">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text check_null password" attr-msg='密码不能为空' value="" placeholder="必填" id="name" name="password">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="repass" class="input-text repass" value="" attr-msg='确认密码不能为空' placeholder="必填" id="name" name="repass">
			</div>
		</div>
		
		
		<div class="row cl ">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  type="button" id="liu-submit2" class="btn btn-primary radius check_form" ><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				
				<button  class="btn btn-default radius"   type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
		<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken?>">
		<input type="hidden" name="id" value="<?php echo $model->id ?>">
	</form>
</div>
</div>
<!--包含头部文件-->
<?php $this->beginBlock('viewJs') ?>
<script type="text/javascript">
	$('.repass').blur(function(){
		if(this.value!=$('.password').val()){
			dialog.tip('密码与确认密码不一致',this);
		}
	})
var SCOPE = {
	save_url:'<?php echo Url::to(['manager/add']) ?>',
	jump_url:'',
}
</script>
<?php $this->endBlock() ?>
