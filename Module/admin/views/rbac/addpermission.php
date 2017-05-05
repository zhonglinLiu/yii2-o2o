<!--包含头部文件-->
<body>
<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
if(Yii::$app->session->hasFlash('info')){
	echo Yii::$app->session->getFlash('info');
}
?>
<div class="page-container">
	<?php 
		ActiveForm::begin([
			'options'=>['class'=>'form form-horizontal form-o2o-add','id'=>'form-o2o-add'],
		])
	?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>权限标识：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!is_null($obj)) echo $obj->name ?>" placeholder="" id="name" name="name">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>权限描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!is_null($obj)) echo $obj->description ?>" placeholder="" id="name" name="description">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>规则名称:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!is_null($obj)) echo $obj->ruleName ?>" placeholder="" id="name" name="rule_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>数据：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<!-- <input type="text" class="input-text" value="" placeholder="" id="name" name="name"> -->
				<textarea class="form-control" rows="3" name="data" ><?php if(!is_null($obj)) echo $obj->data ?></textarea> 
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<?php echo Html::submitButton('<i class="Hui-iconfont">&#xe632;</i> 保存',['class'=>'btn btn-primary radius']) ?>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	<?php ActiveForm::end() ?>
</div>
</div>


