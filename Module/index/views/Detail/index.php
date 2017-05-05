<?php 
use yii\helpers\Url;
?>
<div class="p-detail">
    <div class="p-bread-crumb">
        <div class="w-bread-crumb">
            <ul class="crumb-list">
                <li class="crumb"><a>团购</a><span class="ico-gt">&gt;</span></li>
                <li class="crumb"><a><?php echo $cate->name ?></a><span class="ico-gt">&gt;</span></li>
                <li class="crumb crumb-last"><a><?php echo $deal->name ?></a></li>
            </ul>
        </div>
    </div>
    <div class="static-hook-real static-hook-id-5"></div>
    <div class="p-item-info">
        <div class="w-item-info">
            <h2><?php echo $bis->name ?></h2>
            <div class="item-title">
                <span class="text-main"><?php echo $deal->name ?></span>
            </div>
            <div class="ii-images static-hook-real static-hook-id-6">
                <div class="w-item-images">
                    <div class="images-board">
                        <div class="item-status ">
                            <span class="ico-status ico-jingxuan"></span>
                        </div>
                        <img src="<?php echo $deal->image ?>" class="item-img-large" />
                    </div>
                    <ul class="images-list clearfix">
                        <li class="images images-last">
                            <img src="<?php echo $deal->image ?>" />
                        </li>
                    </ul>
                    <div class="erweima-share-collect">
                        <ul class="item-option clearfix">
                            <li class=" ">

                                <div class="collect-success">

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ii-intro">
                <div class="w-item-intro">
                    <div class="price-area-wrap static-hook-real static-hook-id-8">
                        <div class="price-area has-promotion-icon">
                            <div class="pic-price-area">
                                <span class="unit">¥</span>
                                <span class="priceNum"><?php echo $deal->current_price ?></span>
                            </div>

                            <div class="market-price-area">
                                <div class="price">¥<?php echo $deal->origin_price ?></div>
                                <div class="name">价值</div>
                            </div>


                        </div>
                    </div>
                    <div class="static-hook-real static-hook-id-9">
                        <a class="link jingxuan-box" alt="更多精选品牌特惠">
                            <?php if($countDown!==''): ?>
                            <div class="box">
                                <div class="jx-update" id="j-jxUpdateTime">
                                    <span>距离开始时间还有</span>
                                    <span class="jx-timerbox"><?php echo $countDown ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </a>
                    </div>
                    <ul class="ugc-strategy-area static-hook-real static-hook-id-10">
                        <li class="item-bought">
                            <div class="sl-wrap">
                                <div class="sl-wrap-cnt">
                                    <div class="item-bought-num"><span class="intro-strong"><?php echo $deal->buy_count ?></span>人已团购</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="buy-panel-wrap">
                        <div class="buy-panel">
                            <div class="validdate-buycount-area static-hook-real static-hook-id-11">
                                <div class="item-countdown-row">
                                    <span class="name">有效期</span>
                                    <span class="value"><?php echo date('Y-m-d h:i',$deal->end_time) ?></span>
                                </div>
                                <div class="item-buycount-row j-item-buycount-row">
                                    <div class="name">数&nbsp;&nbsp;&nbsp;量</div>
                                    <div class="buycount-ctrl">
                                        <a href="javascript:;" class="j-ctrl ctrl minus disabled"><span class="horizontal"></span></a>
                                        <input type="text" value="1" maxlength="10" autocomplete="off">
                                        <a href="javascript:;" class="ctrl j-ctrl plus "><span class="horizontal"></span><span class="vertical"></span></a>
                                    </div>
                                    <div class="text-wrap">
                                        <span class="left-budget">优惠价剩余20份</span>
                                        <span class="err-wrap j-err-wrap"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item-buy-area">
                                <div style="float:left" class="static-hook-real static-hook-id-12">
                                    <?php if($countDown!=''): ?>
                                    <a href="javascript:;" style="background: #c0c0c0;border:1px solid #c0c0c0" class="btn-buy btn-buy-qrnew j-btn-buy btn-hit">立即抢购</a>
                                    <?php else:?>
                                    <a href="javascript:;" class="btn-buy btn-buy-qrnew j-btn-buy btn-hit pay_o2o">立即抢购</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-item-info-more">
        <div class="iim-wrapper">
            <div class="spec-nav ">
                <div class="nav-bar"></div>
                <div class="w-spec-nav" style="position: static; top: auto; z-index: auto;">
                    <ul class="sn-list">
                        <li class="spec-nav-current">
                            <i></i><a><span>本单详情</span></a>
                        </li>
                        <li class="">
                            <i></i><a><span>消费提示</span></a>
                        </li>
                        <li class="">
                            <i></i><a><span>商家介绍</span></a>
                        </li>
                    </ul>

                </div>
            </div>
            <ul class="j-info-all">
                <li class="tab">
                    <div class="ia-shop-branch">
                        <div class="w-shop-branch">
                            <h3 class="w-section-header">分店信息</h3>
                            <div class="branch-content">
                                <div class="shop-map">
                                    <div class="w-map">
                                        <img src="<?php echo Url::to(['/api/map/get-static-map','position'=>$mainLoc->ypoint.','.$mainLoc->xpoint])?>" />
                                        <a class="map-zoom">
                                            <span>查看完整地图</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="branch-detail">
                                    <div>
                                        <!-- <div class="w-area-filter">
                                            <label>筛选：</label>
                                            <select name="city" class="af-content"><option value="100010000" selected="">北京市</option></select>
                                            <select name="district" class="af-content">
                                                <option selected="">全部城区</option>
                                                <option value="307">朝阳区</option>
                                                <option value="392">海淀区</option>
                                                <option value="395">丰台区</option>
                                                <option value="408">通州区</option>
                                                <option value="6547">平谷区</option>
                                            </select>
                                        </div> -->
                                        <div class="branch-list-content">
                                            <div class="w-branch-list">
                                                <ul class="branch-list-content">
                                                    <?php foreach($locations as $v): ?>
                                                    <li class="branch branch-open">
                                                        <a href="<?php echo Url::to(['location/index','id'=>$v->id]) ?>" target="_blank" class="branch-name"><?=$v->address?>店</a>
                                                        <p class="branch-tel"><?=$v->tel?></p>
                                                        <p class="map-travel">
                                                            <a href="javascript:;" class="map">
                                                                <span class="icon"></span>
                                                                <span class="text">查询地图</span>
                                                            </a>
                                                            <a href="javascript:;" class="travel">
                                                                <span class="icon"></span>
                                                                <span class="text">公交/驾车去这里</span>
                                                            </a>
                                                        </p>
                                                    </li>
                                                   <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ifram"><?=$deal->description?></div>
                </li>
                <li class="tab"><div class="ifram"><?=$deal->notes?></div></li>
                <li class="tab"><div class="ifram"><?php echo $bis->description ?></div></li>
            </ul>
        </div>
    </div>
</div>

<div class="footer-content">
    <div class="copyright-info">
        <div class="site-info">

        </div>
        <div class="icons">

        </div>
        <div style="width:200px;margin:0 auto; padding:20px 0;">

        </div>
    </div>
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



    $(".sn-list li").click(function(){
        var index = $(".sn-list li").index(this)
        $(".sn-list li").removeClass("spec-nav-current");
        $(".j-info-all .tab").css({display: "none"});
        $(this).addClass("spec-nav-current");
        $(".j-info-all .tab").eq(index).css({display: "block"});
    });

    $(".branch").mouseenter(function(){
        $(".branch").removeClass("branch-open").addClass("branch-close");
        $(this).removeClass("branch-close").addClass("branch-open");
    });
    $(".pay_o2o").click(function () {
        var count = $('.buycount-ctrl input').val();
        var id = "<?php echo $deal->id ?>";
        var url = "<?php echo Url::to(['order/index'])?>"+'?id='+id+'&count='+count;
        window.open(url);
    })
</script>
<?php $this->endBlock() ?>
