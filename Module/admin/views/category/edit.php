<!--包含头部文件-->
<body>
<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
if(Yii::$app->session->hasFlash('info')){
	echo Yii::$app->session->getFlash('info');
}
?>
<style type="text/css">
	.form-group{
		width: 100%;
	}
</style>
<div class="page-container">
	<?php 
		$form = ActiveForm::begin([
			'options'=>['class'=>'form form-horizontal form-o2o-add','id'=>'form-o2o-add']
		])
	?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>生活服务分类名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<!-- <input type="text" class="input-text" value="" placeholder="" id="name" name="name"> -->
				<?php echo $form->field($model,'name')->textInput(['class'=>'form-control'])->label(false) ?>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php echo $form->field($model,'parent_id')->dropDownList($select,['class'=>'form-control'])->label(false) ?>
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
<!--包含头部文件-->
