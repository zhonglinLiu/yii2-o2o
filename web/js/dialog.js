var dialog = {
    // 错误弹出层
    error: function(message) {
        layer.open({
            content:message,
            icon:2,
            title : '错误提示',
        });
    },

    //成功弹出层
    success : function(message,url) {
        if(arguments.length==1){
            url ='';
        }
        layer.open({
            content : message,
            icon : 1,
            yes : function(){
                location.href=url;
            },
        });
    },

    //成功弹出层 自定义成功后的回调
    success2 : function(message,callback) {
        layer.open({
            content : message,
            icon : 1,
            yes : function(index){
                callback && callback();
                layer.close(index);
            },
        });
    },

    // 确认弹出层
    confirm : function(message, url) {
        layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                location.href=url;
            },
        });
    },

    //无需跳转到指定页面的确认弹出层
    toconfirm : function(message) {
        layer.open({
            content : message,
            icon:3,
            btn : ['确定'],
        });
    },

    showMsg: function(msg,options,callback){
        var opt = {
            tipsMore:true,
            time: 3000,
            type:1,
            offset:'100px',
        };
        opt = $.extend({},opt,options);
        var index = layer.msg(msg,opt,function(callback){
                callback && callback();
            }
        );
        return index;
    },

    loading:function($msg,callback){
        var index = layer.msg($msg, {
            icon: 16
            ,shade: 0.01
        });
        return index;
    },
    closed:function(index){
        layer.close(index);
    },
     //tip
    tip : function(msg,ele,pos,background){
        if(arguments.length<2) return false;
        if(arguments.length=2){
            var pos = 4;
            var background = '#78BA32';
        }
        if(arguments.length=3){
            var background = '#78BA32';
        }
        layer.tips(msg, ele, {
          tips: [pos, background]
        });
    }

        
}

