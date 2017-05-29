<!--包含头部文件-->
<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<body>
<style type="text/css">
	.form-group{
		width:100%;
	}
</style>
<div class="page-container">
<p style="text-align: center;color:red">
	
	<?php 
		if(Yii::$app->session->hasFlash('info')){
			echo Yii::$app->session->getFlash('info');
			Yii::$app->session->removeFlash('info');
		}

	?>
</p>
	<?php $form = ActiveForm::begin([
		'options'=>['class'=>'form form-horizontal'],
		'id' => 'form-id',
		'fieldConfig'=>[
			'template'=>'{error}{input}',
		]
	]) ?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>城市名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php echo $form->field($model,'name')->textInput(['class'=>'form-control','placeholder'=>'必填'])->label(false) ?>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>城市英文名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php echo $form->field($model,'uname')->textInput(['class'=>'form-control','placeholder'=>'选填'])->label(false) ?>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php echo $form->field($model,'parent_id')->dropDownList($select,['class'=>'form-control']) ?>
			</div>
		</div>
		<?php echo  $form->field($model,'id')->hiddenInput() ?>
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

