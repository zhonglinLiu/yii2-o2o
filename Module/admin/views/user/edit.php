<!--包含头部文件-->
<?php 
use yii\helpers\Url;
?>

<body>
<div class="page-container">
	<form class="form form-horizontal form-o2o-add" id="liu-form2" method="post" action="">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>管理员名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text check_null" attr-msg='用户名不能为空' value="<?php echo $user->username ?>" placeholder="必填" id="name" name="username">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text check_null" attr-msg='邮箱不能为空' value="<?php echo $user->email ?>" placeholder="必填" id="name" name="email">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>电话：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  value="<?php echo $user->mobile ?>"  id="mobile" name="mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" id="password"  value="" name="password">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text repass" value="" attr-msg='确认密码不能为空' placeholder="必填" id="name" name="repass">
			</div>
		</div>
		<input type="hidden" name="id" value="<?php echo $user->id ?>">
		<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>" >
		<div class="row cl check_form">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  type="button" id="liu-submit2" class="btn btn-primary radius" ><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
</div>
<!--包含头部文件-->
<?php $this->beginBlock('viewJs'); ?>
<script type="text/javascript">
	
	$('.repass').blur(function(){
		if(this.value!=$('.password').val()){
			dialog.tip('密码与确认密码不一致',this);
		}
	})
	var SCOPE = {
		save_url:"<?php echo Url::to(['user/edit']) ?>",
		jump_url:'',
	}
	
</script>
<?php $this->endBlock(); ?>