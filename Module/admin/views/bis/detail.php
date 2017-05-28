<!--包含头部文件-->

<div class="cl pd-5 bg-1 bk-gray mt-20"> <h1>商户入驻申请详情</h1></div>
<article class="page-container">
    <form class="form form-horizontal"  method="post" action="{:url('register/add')}">
        基本信息：
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商户名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $bis->name ?>" placeholder="" id="" name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="city_id" class="select cityId">
					<option value="0">--请选择--</option>
                    <?php foreach($citys as $v): ?>
					<option value="<?php echo $v->id ?>" <?php if($v->id == $bis->city_id) echo 'selected' ?> > <?php echo $v->name ?> </option>
					<?php endforeach; ?>
				</select>
				</span>
            </div>
            <?php if(!empty($se_city->id) ): ?>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">

				<select name="se_city_id" class="select se_city_id">
					<option value="<?php echo $se_city->id ?>"><?php echo $se_city->name ?></option>
				</select>

				</span>
            </div>
            <?php endif?>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img id="upload_org_code_img" src="<?php echo $bis->logo ?>" width="150" height="150">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">营业执照：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img  id="upload_org_code_img_other" src="<?php echo $bis->licence_logo ?>" width="150" height="150">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商户介绍：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor1"  type="text/plain" name="description" style="width:80%;height:300px;"><?php echo $bis->description ?></script>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">银行账号:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $bis->bank_info?>" placeholder="" id="" name="bank_info">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">开户行名称:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text"  class="input-text" value="<?php echo $bis->bank_name ?>" placeholder="" id="" name="bank_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">开户行姓名:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $bis->bank_user ?>" placeholder="" id="" name="bank_user">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">法人:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $bis->faren ?>" placeholder="" id="" name="faren">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">法人电话:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $bis->faren_tel ?>" placeholder="" id="" name="faren_tel">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $bis->email ?>" placeholder="" id="" name="email">
            </div>
        </div>
        总店信息：
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">电话:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $location->tel ?>" placeholder="" id="" name="tel">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">联系人:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $location->contact ?>" placeholder="" id="" name="contact">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
            <div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="category_id" class="select categoryId">
					<option value="0">--请选择--</option>
                    <?php foreach($cates as $v): ?>
					<option value="<?php echo $v->id ?>" <?php if($location->category_id == $v->id) echo 'selected' ?>  ><?php echo $v->name ?></option>
					<?php endforeach; ?>
				</select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所属子类：</label>
            <div class="formControls col-xs-8 col-sm-3 skin-minimal">
                <div class="check-box se_category_id">
                    <?php foreach($se_cates as $v): ?>
                    <span><?php echo $v->name ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商户地址：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $location->address ?>" placeholder="" id="bis-address" name="address">
            </div>
            <a id="showposition"  class="btn btn-default radius ml-10 maptag">标注</a>
            <br>
            <div style="margin-left:200px" data-vertical="col-xs-8 col-sm-3" id="showmap">

            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">营业时间:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $location->open_time ?>" placeholder="" id="" name="open_time">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">门店简介：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor"  type="text/plain" name="content" style="width:80%;height:300px;"><?php echo $location->content ?></script>
            </div>
        </div>

        账号信息：
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">用户名:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $account->username ?>" placeholder="" id="username" name="username">
            </div>
        </div>


    </form>
</article>

<!--包含尾部文件-->

<?php $this->registerJsFile('@web/admin/hui/lib/ueditor/1.4.3/ueditor.config.js',['depend'=>'\yii\web\JqueryAsset']) ?>
<?php $this->registerJsFile('@web/admin/hui/lib/ueditor/1.4.3/ueditor.all.min.js',['depend'=>'\yii\web\JqueryAsset']) ?>
<?php $this->registerJsFile('@web/admin/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js',['depend'=>'\yii\web\JqueryAsset']) ?>
<!--分配编辑器-->
<?php $this->beginBlock('viewJs')?>
<script>
    $(function(){
        var ue = UE.getEditor('editor');
        var ue1 = UE.getEditor('editor1');
    });
    var SCOPE = {
        citys_url : '<?php echo yii\helpers\Url::to(["api/citys/getCitysByPid"]) ?>',
        category_url:'<?php echo yii\helpers\Url::to(['api/category/getCategoryByPid']) ?>',
        ajax_upload_swf:"assets/js/uploadify/uploadify.swf",
        ajax_upload_image_url:"<?php echo yii\helpers\Url::to(['api/image/uploadImage']) ?>",
        check_username:'<?php echo yii\helpers\Url::to(['api/BisAccount/checkname']) ?>',
        show_position:'<?php echo yii\helpers\Url::to(['api/BisAccount/showposition']) ?>',
        showmap:'<?php echo yii\helpers\Url::to(['api/BisAccount/showmap']) ?>',
    }
</script>
<?php $this->endBlock() ?>
</body>
</html>