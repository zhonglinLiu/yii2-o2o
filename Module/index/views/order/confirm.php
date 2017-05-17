<?php 
use yii\helpers\Url;
?>
<!--支付第一步-->
<div class="firstly">
    <div class="bindmobile-wrap">
        采用<span style="color:red">微信支付</span>，购买成功后，团购券将发到您的注册邮箱：<span class="mobile"><?=$email?></span><a class="link"></a>
    </div>

    <table class="table table-goods" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <th class="first">商品</th>
            <th width="120">单价</th>
            <th width="190">数量</th>
            <th width="140">优惠</th>
            <th width="140" class="last">小计</th>
        </tr>
        <tr class="j-row">
            <td class="vtop">
                <div class="title-area" title="【好伦哥】精选自助餐1位！免费WiFi！">
                    <div class="img-wrap">
                        <a href="" target="_blank"><img src="<?php echo $deal->image ?>" width="130" height="79"></a>
                    </div>
                    <div class="title-wrap">
                        <div class="title">
                            <a href="" class="link"><?php echo $deal->name ?></a>
                        </div> 
                        <div class="attrs"></div>
                    </div>
                </div>
            </td>
            <td>￥<span class="font14"><?php echo $deal->origin_price ?></span></td>
            <td class="j-cell">
                <div class="buycount-ctrl">
                    <a class="j-ctrl ctrl minus disabled"><span class="horizontal"></span></a>
                    <input type="text" value="<?php echo $count ?>" maxlength="10">
                    <a class="ctrl j-ctrl plus"><span class="horizontal"></span><span class="vertical"></span></a>
                </div>
                <span class="err-wrap j-err-wrap"></span>
            </td>
            <td class="j-cellActivity">¥<span><?php echo $deal->origin_price-$deal->current_price ?></span><br></td>
            <td class="price font14">¥<span class="j-sumPrice"><?php echo $deal->current_price ?></span></td>
        </tr>
        </tbody>
    </table>



    <div class="final-price-area">应付总额：<span class="sum">￥<span class="price"><?php echo $deal->current_price*$count ?></span></span></div>

    <div class="page-button-wrap o2o_confirm">
        <a href="javascript:;" class="btn btn-primary">确认</a>
    </div>

    <div style="width: 100%;min-width: 1200px;height: 5px;background: #dbdbdb;margin: 50px 0 20px;"></div>
</div>

<!--支付第二步-->
<form action="<?php echo  Url::to(['pay/index']) ?>" method="post" >
<div class="secondly">
    <div class="search">
        <img src="https://passport.baidu.com/export/reg/logo-nuomi.png" />
        <div class="w-order-nav-new">
            <ul class="nav-wrap">
                <li>
                    <div class="no"><span>1</span></div>
                    <span class="text">确认订单</span>
                </li>
                <li class="to-line "></li>
                <li class="current">
                    <div class="no"><span>2</span></div>
                    <span class="text">选择支付方式</span>
                </li>
                <li class="to-line "></li>
                <li class="">
                    <div class="no"><span>3</span></div>
                    <span class="text">购买成功</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="order_infor_module">
        <div class="order_details">
            <table width="100%">
                <tbody>
                <tr>
                    <td class="fl_left ">
                        <ul class="order-list">
                            <li>
                                <span class="order-list-no">订单1:</span>
                                <span class="order-list-name"><?php echo $deal->name ?></span><span class="order-list-number">{$count}份</span>
                            </li>
                        </ul>
                    </td>
                    <td class="fl_right">
                        <dl>
                            <dt>应付金额：</dt>
                            <div class="final-price-area" >应付总额：<span class="sum" style="padding-right: 20px;" >￥<span class="price"><?php echo $deal->current_price*$count ?></span></span></div>
                        </dl>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h1 class="title">选择支付方式</h1>

    <div class="pay">第三方账户支付</div>
    <div class="paychoose">
        <input type="radio" name="pay" value="baidu" checked />百度钱包
        <input type="radio" name="pay" value="zhifubai" />支付宝
        <input type="radio" name="pay" value="weixin" />支付宝扫码

    </div>

    <div class="pay">银行卡直接支付</div>
    <div class="paychoose">
        <input type="radio" name="pay" />农业银行
        <input type="radio"  name="pay"/>招商银行
        <input type="radio" name="pay" />工商银行
    </div>
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken?>">
    <input type="hidden" name="deal_id" value="<?php $deal->id ?>">
    <input type="hidden" name="name" value="<?php $deal->name ?>">
    <input type="hidden" name="out_trade_no" value="" id="out_trade_no">
    <button type="submit" class="pay-now" >立即支付</button>
</div>
</form>
<!--支付第三步-->
<div class="third">
    <div class="search">
        <img src="https://passport.baidu.com/export/reg/logo-nuomi.png" />
        <div class="w-order-nav-new">
            <ul class="nav-wrap">
                <li>
                    <div class="no"><span>1</span></div>
                    <span class="text">确认订单</span>
                </li>
                <li class="to-line "></li>
                <li>
                    <div class="no"><span>2</span></div>
                    <span class="text">选择支付方式</span>
                </li>
                <li class="to-line "></li>
                <li class="current">
                    <div class="no"><span>3</span></div>
                    <span class="text">购买成功</span>
                </li>
            </ul>
        </div>
    </div>

    <div style="width: 980px;height: 300px;margin: 0 auto;text-align: center;line-height: 300px;font-size: 36px;">恭喜，购买成功！</div>
</div>

<div class="footer">
    <ul class="first">

    </ul>
    <ul class="second">

    </ul>
</div>
<?php $this->beginBlock('viewJs') ?>
<script>
    //校验正整数
    function isNaN(number){
        var reg = /^[1-9]\d*$/;
        return reg.test(number);
    }

    function inputChange(num){
        if(!isNaN(num)){
            $(".buycount-ctrl input").val("1");
        }
        else{
            $(".buycount-ctrl input").val(num);
            $(".j-sumPrice").text($("td .font14").text() * num - $(".j-cellActivity span").text());
            $(".sum .price").text($("td .font14").text() * num - $(".j-cellActivity span").text());
            if(num == 1){
                $(".buycount-ctrl a").eq(0).addClass("disabled");
            }
            else{
                $(".buycount-ctrl a").eq(0).removeClass("disabled");
            }
        }
    }

    $(".buycount-ctrl input").keyup(function(){
        var num = $(".buycount-ctrl input").val();
        inputChange(num);
    });
    $(".minus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num--;
        inputChange(num);
    });
    $(".plus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num++;
        inputChange(num);
    });
    $('.o2o_confirm').click(function (d) {
        var postdate = {};
        postdate.count = $('.buycount-ctrl input').val();
        postdate.id = "<?php echo $deal->id ?>";
        postdate._scrf = "<?php echo Yii::$app->request->csrfToken ?>"
        var url = "<?php echo Url::to(['order/confirm']) ?>";
        layer.load();
        $.post(url,postdate,function (d) {
            if(d.code!=1){
                layer.closeAll('loading');
                dialog.error(d.data);
            }else{
                layer.closeAll('loading');
                layer.msg(d.data);
                $('.firstly').remove();
                $('.secondly').fadeIn();
                $('#out_trade_no').val(d.msg);
                /*dialog.success2(d.data,function () {
                    $('.firstly').remove();
                    $('.secondly').fadeIn();
                });*/
            }
        },'json')
    })
</script>
<?php $this->endBlock() ?>