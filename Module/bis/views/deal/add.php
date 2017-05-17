<!--包含头部文件-->
<?php 
use yii\helpers\Url;
?>
<div class="cl pd-5 bg-1 bk-gray mt-20"> 添加团购商品信息</div>
<article class="page-container">
	<form class="form form-horizontal" id="liuform2"  >
	基本信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>团购名称：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->name ?>" placeholder="" id="name" name="name">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
			<div class="formControls col-xs-8 col-sm-2"> 
				<span class="select-box">
				<select id="city_id" name="city_id" class="select cityId">
					<option value="">--请选择--</option>
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
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
			<div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select id="category_id" name="category_id" class="select categoryId" required>
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
			<label class="form-label col-xs-9 col-sm-2">支持门店：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box">
				<?php foreach($stores as $v): ?>
				<input name="location_ids[<?php echo $v->id ?>]" type="checkbox" id="location_ids[<?php echo $v->id ?>]" value="<?php echo $v->id ?>" /><?php echo $v->name ?>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	
		<div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >
                <?php if($model->image!=''): ?>
                	<img  id="upload_org_code_img" src="<?php echo $model->image ?>" width="150" height="150">
                <?php else: ?>
                	<img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
                <?php endif; ?>
                <input id="file_upload_image" name="image" type="hidden" multiple="true" value="<?php echo $model->image ?>">
              </div>
        </div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购开始时间：</label>
			<div class="formControls col-xs-8 col-sm-3">
				
				<input type="text" name="start_time" class="input-text" id="start_time" onfocus="selecttime(1)" value="<?php echo date('Y-m-d h:i',$model->start_time) ?>"  > 

			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购结束时间:</label>
			<div class="formControls col-xs-8 col-sm-3">
				
				<input type="text" name="end_time" class="input-text" id="end_time" onfocus="selecttime(1)" value="<?php echo date('Y-m-d h:i',$model->end_time) ?>"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">库存数:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->total_count  ?>" placeholder="" id="total_count" name="total_count">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">原价:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->origin_price ?>" placeholder="" id="origin_price" name="origin_price">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购价:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $model->current_price ?>" placeholder="" id="current_price" name="current_price">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">消费券生效时间：</label>
			<div class="formControls col-xs-8 col-sm-3">
				
				<input type="text" name="coupons_begin_time" class="input-text" id="coupons_begin_time" onfocus="selecttime(1)" value="<?php echo date('Y-m-d h:i',$model->coupons_begin_time)  ?>"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">消费券结束时间:</label>
			<div class="formControls col-xs-8 col-sm-3">
				
				<input type="text" name="coupons_end_time" class="input-text" id="coupons_end_time" onfocus="selecttime(1)" value="<?php echo date('Y-m-d h:i',$model->coupons_end_time)  ?>"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="editor"  type="text/plain" name="description" style="width:80%;height:300px;"><?php echo $model->description ?></script> 
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">购买须知：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="editor1"  type="text/plain" name="notes" style="width:80%;height:300px;"><?php echo $model->notes ?></script> 
			</div>
		</div>

		<div class="row cl check_form">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" id="liusubmit2" type="submit"><i class="Hui-iconfont">&#xe632;</i> 申请</button>
			</div>
		</div>
		<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
		<input type="hidden" name="id" value="<?php echo $model->id ?>">
	</form>
</article>

<!--包含头部文件-->
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<?php $this->beginBlock('viewJs'); ?>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script>
$(function(){
	var ue = UE.getEditor('editor');
	var ue1 = UE.getEditor('editor1');
});
var SCOPE = {
    citys_url : '<?php echo yii\helpers\Url::to(['/api/citys/get-citys-by-pid']) ?>',
	category_url:'<?php echo yii\helpers\Url::to(['/api/category/get-category-by-pid']) ?>',
    ajax_upload_swf:"/assets/js/uploadify/uploadify.swf",
    ajax_upload_image_url:"<?php echo yii\helpers\Url::to(['/api/image/upload-image']) ?>",
	check_username:'<?php echo yii\helpers\Url::to(['/api/bis-account/checkname']) ?>',
	show_position:'<?php echo yii\helpers\Url::to(['/api/bis-account/showposition']) ?>',
    showmap:'<?php echo yii\helpers\Url::to(['/api/bis-account/showmap']) ?>',
    csrf: '<?php echo Yii::$app->request->csrfToken ?>',
    jump_url:'<?php echo yii\helpers\Url::to(['register/waiting']) ?>'
}
$().ready(function(){
	$('#liuform2').validate({
		rules:{
			name:'required',
			city_id:{
				required:true,
				digits:true,
			},
			start_time:{
				required:true,
			},
			end_time:{
				required:true,
			},
			total_count:{
				required:true,
				digits:true,
			},
			origin_price:{
				required:true,
				number:true,
			},
			current_price:{
				required:true,
				number:true,
			},
			coupons_begin_time:{
				required:true,
			},
			coupons_end_time:{
				required:true,
			}

		},
		submitHandler:function(from){
			$(from).find(':submit').submit(function(){return false});
			formSubmit("#liuform2",'');
		}
	})
})

</script>

<?php $this->endBlock(); ?>
</script>
</body>
</html>