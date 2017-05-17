<!--包含头部文件-->
<?php 
use yii\helpers\Url;
?>
<div class="cl pd-5 bg-1 bk-gray mt-20"> 添加分店信息</div>
<article class="page-container">
	<form class="form form-horizontal" id="liuform2">
	基本信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分店名称：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->name ?>" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">银行账号:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->bank_info ?>" placeholder="" id="bank_info" name="bank_info">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
			<div class="formControls col-xs-8 col-sm-2"> 
				<span class="select-box">
				<select id="city_id" name="city_id" class="select cityId">
					<option value="" >--请选择--</option>
					<?php foreach($citys as $v): ?>
					<option value="<?php echo $v->id ?>" <?php if($model->city_id==$v->id) echo 'selected' ?> ><?php echo $v->name ?></option>
					<?php endforeach; ?>
				</select>
				</span>
			</div>
			<div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="se_city_id" class="select se_city_id">
					<option value="">--请选择--</option>
				</select>
				</span> 
			</div>
		</div>
	
		<div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >
                <?php if($model->logo!=''): ?>
                	<img style="" id="upload_org_code_img" src="<?php echo $model->logo ?>" width="150" height="150">
                <?php else: ?>
                <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
            <?php endif; ?>
                <input id="file_upload_image" name="logo" type="hidden" multiple="true" value="<?php echo $model->logo ?>">
              </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">门店介绍：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="editor"  type="text/plain" name="content" style="width:80%;height:300px;"><?php echo $model->content ?></script> 
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
			<div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select id="category_id" name="category_id" class="select categoryId">
					<option value="">--请选择--</option>
					<?php foreach($cates as $v): ?>
					<option value="<?php echo $v->id ?>" <?php if($model->category_id==$v->id) echo 'selected' ?> ><?php echo $v->name ?></option>
					<?php endforeach; ?>
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">所属子类：</label>
			<div class="formControls col-xs-8 col-sm-3 skin-minimal">
				<div class="check-box se_category_id">

				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">地址：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text"  class="input-text" value="<?php echo $model->address ?>" placeholder="" id="bis-address" name="address" required>
			</div>
			<br>
			<div style="margin-left:200px" data-vertical="col-xs-8 col-sm-3" id="showmap">

			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">电话:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->tel ?>" placeholder="" id="tel" name="tel">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">联系人:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->contact ?>" placeholder="" id="contact" name="contact">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">营业时间:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->open_time ?>" placeholder="" id="open_time" name="open_time">
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit" id="liusubmit2"><i class="Hui-iconfont">&#xe632;</i> 申请</button>	
			</div>
		</div>
		<input type="hidden" name="id" value="<?php echo $model->id ?>">
		<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
	</form>
</article>
    <!--包含尾部文件-->
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<?php $this->beginBlock('viewJs'); ?>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>

<script>
    var SCOPE = {
    citys_url : '<?php echo yii\helpers\Url::to(['/api/citys/get-citys-by-pid']) ?>',
	category_url:'<?php echo yii\helpers\Url::to(['/api/category/get-category-by-pid']) ?>',
    ajax_upload_swf:"/assets/js/uploadify/uploadify.swf",
    ajax_upload_image_url:"<?php echo yii\helpers\Url::to(['/api/image/upload-image']) ?>",
	check_username:'<?php echo yii\helpers\Url::to(['/api/bis-account/checkname']) ?>',
	show_position:'<?php echo yii\helpers\Url::to(['/api/bis-account/showposition']) ?>',
}
</script>
<script>
var css = document.createElement("link")
console.log($('script'));
$(function(){
	var ue = UE.getEditor('editor');
});
$().ready(function(){
	$('#liuform2').validate({
		rules:{
			name:"required",
			bank_info:{
				required:true,
				number:true
			},
			city_id:{
				required:true,
				number:true
			},
			category_id:{
				required:true,
				number:true,
			},
			tel:{
				required:true,
				number:true,
			},
			contact:"required",
			open_time:"required",



		},
		submitHandler:function(form){
			$(form).find(':submit').submit(function(){return false})
			formSubmit("#liuform2",'');
		}
	})
})

</script>

<?php $this->endBlock() ;?>
</body>
</html>