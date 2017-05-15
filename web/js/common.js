/*页面 全屏-添加*/
function o2o_edit(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*添加或者编辑缩小的屏幕*/
function o2o_s_edit(title,url,w,h){
	layer_show(title,url,w,h);
}
/*-删除*/
function o2o_del(url){
	
	layer.confirm('确认要删除吗？',function(index){
		window.location.href=url;
	});
}
/*
排序
 */
$('input.listorder').blur(function () {
	var $postdate = {};
	$postdate.id = $(this).attr('attr-id');
	$postdate.listorder = $(this).val();
	$postdate._csrf = SCOPE.safe;
	$.post(SCOPE.save_url,$postdate,function (d) {
		console.log(d);
		if(d.code==0){
			dialog.error('修改失败');
		}else if(d.code==-1){
			dialog.error('非法操作');
		}else{
            // dialog.success('修改成功',d.data);
		}
    },'json')
})
/*
2级联动
 */

$('.cityId').change(function () {
	$data = {};
	$data.parent_id = $(this).val();
	$.post(SCOPE.citys_url,$data,function (d) {
		if(d.code==1){
			var html = '<option >--请选择--</option>';
			$(d.data).each(function (index,obj) {
				html+="<option value='"+this.id+"'>"+this.name+"</option>";
            });
            $('.se_city_id').html(html);
		}
    },'json')
})
$('.categoryId').change(function () {
    $data = {};
    $data.parent_id = $(this).val();
    console.log($data);
    $.post(SCOPE.category_url,$data,function (d) {
        if(d.code==1){
            var html = '';
            $(d.data).each(function (index,obj) {
                html+='<input type="checkbox" id="category" value="'+this.id+'" name="se_category_id['+this.id+']" />'+this.name;
                html+='<label for="category" >&nbsp;</label>';
            });
            $('.se_category_id').html(html);
        }else{
            $('.se_category_id').html('');
		}
    },'json')
})

//bis模块登录页
//异步检查用户名是否已被注册
/*$('#username').blur(function () {
	var that = $(this);
	var data = {};
	data.username = $(this).val();
	$.post(SCOPE.check_username,data,function (d) {
		if(d.code==-1){
			dialog.error(d.data);
			that.val('');
		}
    })
})*/
//显示地图
$('#showposition').click(function () {
	var that = $(this);
	var data = {};
	data.position = $('.bis-address').val();
	if(data.position==''){
		dialog.error('位置不能为空');
		return;
	}
	$.post(SCOPE.show_position,data,function (d) {
		console.log(d);
		if(d.code==-1){
			dialog.error(d.data);
			that.val('');
		}else{
			var dom = $("<img src='"+SCOPE.showmap+'?position='+data.position+"' width='300' height='180' />");
			$('#showmap').html(dom);
		}
    },'json')
})
//判断地址是否正确
$('#bis-address').blur(function () {
    var that = $(this);
    var data = {};
    data.position = $(this).val();
    if(data.position==''){
        dialog.error('位置不能为空');
        return;
    }
    $.post(SCOPE.show_position,data,function (d) {
        if(d.code==-1){
            dialog.error(d.data);
            that.val('');
        }
    },'json')
})
/*
显示日历插件
 */
function selecttime(flag){
    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }
}


/*
表单提交
 */
var IS_NULL = false;
$('.check_form').mousedown(function(){
	var data = $('.check_null');
	data.each(function(index,obj){
		if(this.value==''){
			IS_NULL = true;
			console.log(IS_NULL);
			dialog.error($(this).attr('attr-msg'));
			return false;
		}
	})
})


/**
 * 结合 jquery-validation 使用
 * @param  {[type]} selector [description]
 * @param  {[type]} url      [description]
 * @return {[type]}          [description]
 */
function formSubmit(selector,url){
	var arr = $(selector).serializeArray();
	var data = {};
	$(arr).each(function (index,obj) {
		data[this.name] = this.value;
    })
    console.log(data);
    var index = dialog.loading('请稍等');
     $.post(url,data,function (d) {
    	dialog.closed(index);
		if(d.code!=1){
			if(typeof d.data == 'object'){
				var pos = 100;
				for(var k in d.data){
					/*pos+=50;
					dialog.showMsg(d.data[k][0],{offset:pos+'px'});*/
					$('#'+k+'-error').show().text(d.data[k][0]);
					$('#'+k).addClass('error');
				}
				return true;
			}else{
				dialog.error(d.data);
			}
			// 
		}else{
			dialog.success(d.data,SCOPE.jump_url);
		}
    },'json')
     return false;
}


$('#liu-submit').click(function () {
	if(IS_NULL==true){
		IS_NULL = false;
		return false;
	}
	var arr = $('#liu-form').serializeArray();
	var data = {};
	
	$(arr).each(function (index,obj) {
		data[this.name] = this.value;
    })
    // data._scrf = SCOPE.scrf;
	var url = SCOPE.save_url;
    console.log(data);
    $.post(url,data,function (d) {
		if(d.code!=1){
			console.log(d)
			dialog.error(d.data);
		}else{
			dialog.success(d.data,SCOPE.jump_url);
		}
    })
})

$('#liu-submit2').click(function () {
	if(IS_NULL==true){
		IS_NULL = false;
		return false;
	}
	var arr = $('#liu-form2').serializeArray();
	var data = {};
	$(arr).each(function (index,obj) {
		data[this.name] = this.value;
    })
    console.log(data);
    // data._scrf = SCOPE.scrf;
	var url = SCOPE.save_url;
	var index = dialog.loading('请稍等');
    $.post(url,data,function (d) {
    	dialog.closed(index);
		if(d.code!=1){
			if(typeof d.data == 'object'){
				var pos = 100;
				for(var k in d.data){
					pos+=50;
					dialog.showMsg(d.data[k][0],{offset:pos+'px'});
				}
				return true;
			}else{

				dialog.error(d.data);
			}
			// 
		}else{
			dialog.success(d.data,SCOPE.jump_url);
		}
    },'json')
})

