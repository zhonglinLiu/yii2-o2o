/**
 * 图片上传功能
 */
$(function() {
    if(typeof SCOPE =='undefined'){
        return;
    }
    $('#file_upload').uploadify({
        'swf'      : SCOPE.ajax_upload_swf,
        'uploader' : SCOPE.ajax_upload_image_url,
        'buttonText': '上传图片',
        'fileTypeDesc': 'Image Files',
        'fileObjName' : 'imgFile',
        //允许上传的文件后缀
        'fileTypeExts': '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(imgFile,data,response) {
            // response true ,false
            if(response) {
                var obj = JSON.parse(data); //由JSON字符串转换为JSON对象

                console.log(data);
                console.log(imgFile);
                $('#' + imgFile.id).find('.data').html(' 上传完毕');

                $("#upload_org_code_img").attr("src",obj.data);
                $("#file_upload_image").attr('value',obj.data);
                $("#upload_org_code_img").show();
            }else{
                dialog.error('上传失败');
            }
        },
    });

    $('#file_upload_other').uploadify({
        'swf'      : SCOPE.ajax_upload_swf,
        'uploader' : SCOPE.ajax_upload_image_url,
        'buttonText': '上传图片',
        'fileTypeDesc': 'Image Files',
        'fileObjName' : 'imgFile',
        //允许上传的文件后缀
        'fileTypeExts': '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(imgFile,data,response) {
            // response true ,false
            if(response) {
                var obj = JSON.parse(data); //由JSON字符串转换为JSON对象

                console.log(data);
                console.log(imgFile);
                $('#' + imgFile.id).find('.data').html(' 上传完毕');

                $("#upload_org_code_img_other").attr("src",obj.data);
                $("#file_upload_image_other").attr('value',obj.data);
                $("#upload_org_code_img_other").show();
            }else{
                dialog.error('上传失败');
            }
        },
    });
});