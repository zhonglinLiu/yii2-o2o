<!--包含头部文件-->

<body>
<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
if(Yii::$app->session->hasFlash('info')){
	echo Yii::$app->session->getFlash('info');
}?>
<div class="page-container">
	<?php 
		ActiveForm::begin([
			'options'=>['class'=>'form form-horizontal form-o2o-add','id'=>'form-o2o-add']
		])
	?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>生活服务分类名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $cate->name ?>" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
				<select name="parent_id" class="select">
					<option value="0">一级分类</option>
					<?php foreach($cates as $v): ?>
					<option value="<?php echo $v->id ?>" <?php if($v->id==$cate->parent_id) echo 'selected' ?> ><?php echo $v->name ?></option>
					<?php endforeach; ?>
				</select>
				</span>
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<?php echo Html::submitButton('<i class="Hui-iconfont">&#xe632;</i> 保存',['class'=>'btn btn-primary radius']) ?>
				
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
		<input type="hidden" name="id" value="<?php echo $cate->id ?>" />
	<?php ActiveForm::end() ?>
</div>
</div>
<!--包含头部文件-->

