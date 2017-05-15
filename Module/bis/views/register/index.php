<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>


<div class="cl pd-5 bg-1 bk-gray mt-20"> <h1>商户入驻申请</h1></div>
<article class="page-container">
	<form class="form form-horizontal" id="liuform2">
	基本信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商户名称：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
			<div class="formControls col-xs-8 col-sm-2"> 
				<span class="select-box">
				<select id="city_id" name="city_id" class="select cityId" required>
					<option value="" >--请选择--</option>
					<?php foreach($citys as $v): ?>
					<option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
					<?php endforeach;?>
				</select>
				</span>
			</div>
			<div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select id="se_city_id" name="se_city_id" class="select se_city_id">
					<option >--请选择--</option>
				</select>
				</span> 
			</div>
		</div>
		
		<div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
                <input id="file_upload_image" name="logo" type="hidden" multiple="true" value="">
              </div>
        </div>
        <div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">营业执照：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload_other"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img_other" src="" width="150" height="150">
                <input id="file_upload_image_other" name="licence_logo" type="hidden" multiple="true" value="">
              </div>
        </div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">商户介绍：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor1"  type="text/plain" name="description" style="width:80%;height:300px;"></script> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">银行账号:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="bank_info" name="bank_info">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">开户行名称:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="bank_name" name="bank_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">开户行姓名:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="bank_user" name="bank_user">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">法人:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="faren" name="faren">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">法人电话:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="faren_tel" name="faren_tel">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="email" name="email">
			</div>
		</div>
		总店信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">电话:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="tel" name="tel">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">联系人:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="contact" name="contact">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
			<div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select id="category_id" name="category_id" class="select categoryId" required>
					<option value="" >--请选择--</option>
					<?php foreach($cates as $v): ?>
					<option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
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
			<label class="form-label col-xs-4 col-sm-2">商户地址：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text bis-address" value="" placeholder="" id="address" name="address">
			</div>
			<a id="showposition"  class="btn btn-default radius ml-10 maptag">标注</a>
			<br>
			<div style="margin-left:200px" data-vertical="col-xs-8 col-sm-3" id="showmap">

			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">营业时间:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" onfocus="selecttime(1)" class="input-text" value="" placeholder="" id="open_time" name="open_time">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">门店简介：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor"  type="text/plain" name="content" style="width:80%;height:300px;"></script> 
			</div>
		</div>

		账号信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">用户名:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="username" name="username">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">密码:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="password" class="input-text" value="" placeholder="" id="password" name="password">
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" id="liusubmit2" type="submit"><i class="Hui-iconfont">&#xe632;</i> 申请</button>	
			</div>
		</div>
		<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
	</form>
</article>

<?php $this->beginBlock('viewJs'); ?>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/admin/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
<?php $this->registerJsFile('@web/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js',['depends'=>'\yii\web\JqueryAsset']) ?>
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
			name:{
				required:true,
				minlength:2,
			},
			city_id:{
				required:true,
				number:true,
			},
			bank_info:"required",
			bank_name:"required",
			bank_user:"required",
			faren:"required",
			faren_tel:"required",
			email:{
				required:true,
				email:true,
			},
			tel:{
				required:true,
				mobile:true,
			},
			contact:"required",
			address:"required",
			open_time:{
				required:true,
				dateISO:true,
			},
			username:{
				required:true,
				minlength:2,
			},
			password:{
				required:true,
				minlength:6,
			},
			file_upload_image:"required",


		},
		submitHandler:function(form){
			$(form).find(':submit').submit(function(){return false});
			formSubmit('#liusubmit2','');
		}
	})
})

</script>

<?php $this->endBlock(); ?>