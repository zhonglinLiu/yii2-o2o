<!--包含头部文件-->
<?php 
use yii\helpers\Url;
?>
<body>
<div class="cl pd-5 bg-1 bk-gray mt-20"> 添加推荐位信息</div>
<article class="page-container">
	<form class="form form-horizontal" id="liu-form2" method="post" action="">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标题：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" attr-msg='标题不能为空' value="" placeholder="" id="" name="title">
			</div>
		</div>
		
		<div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">推荐图：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
                <input id="file_upload_image" attr-msg='请上传图片' name="image" type="hidden" multiple="true" value="">
              </div>
        </div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
			<div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="type" class="select">
					
					<?php foreach($featured_type as $k => $v): ?>
					<option value="<?php echo $k ?>"><?php echo $v ?></option>
					<?php endforeach;?>
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">url：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" attr-msg='请填写url' value="" placeholder="" id="" name="url">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">描述：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" attr-msg='请填写描述信息' value="" placeholder="" id="" name="description">
			</div>
		</div>
		
		<div class="row cl check_form">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" id="liu-submit2" type="button"><i class="Hui-iconfont">&#xe632;</i> 添加</button>	
			</div>
		</div>
		<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
	</form>
</article>


<?php $this->beginBlock('viewJs') ?>
<script>
var SCOPE = {
	save_url:'<?php echo Url::to(['featured/add']) ?>',
    ajax_upload_swf:"/js/uploadify/uploadify.swf",
    ajax_upload_image_url:"<?php echo Url::to(['api/image/upload-image']) ?>",

}
</script>
<?php $this->endBlock() ?>
<!--包含头部文件-->

