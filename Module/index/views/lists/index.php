<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<?php $this->render('../layouts/nav.php') ?>
<div class="page-body">
    <div class="filter-bg">
        <div class="filter-wrap">
            <div class="w-filter-ab-test">
                <div class="w-filter-top-nav clearfix" style="margin:12px">


                </div>

                <div class="filter-wrapper">
                    <div class="normal-filter ">
                        <div class="w-filter-normal-ab  filter-list-ab">
                            <h5 class="filter-label-ab">分类</h5>
                            <span class="filter-all-ab">
                                    <a class="w-filter-item-ab  item-all-auto-ab" href="<?php echo Url::to(['lists/index']) ?>" ><span class="item-content ">全部</span></a>
                                </span>
                            <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                    <a class="w-filter-item-ab"><span class="item-content">今日新单</span></a>
                                    <?php foreach($this->params['cates'] as $key => $cate): ?>
                                    <a class="w-filter-item-ab" href="<?php echo Url::to(['lists/index','id'=>$key]) ?>" ><span class="item-content <?php if($key==$cateid) echo 'filter-active-all-ab' ?>  "><?php echo $cate->name ?></span></a>
                                   <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="filter-wrapper">
                    <div class="normal-filter ">
                        <div class="w-filter-normal-ab  filter-list-ab">
                            <h5 class="filter-label-ab">子分类</h5>
                            <span class="filter-all-ab">

                                </span>
                            <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                    <a class="w-filter-item-ab"><span class="item-content">今日新单</span></a>
                                    <?php if(isset($this->params['catesChild'][$cateid])): ?>
                                    <?php foreach($this->params['catesChild'][$cateid] as $v): ?>
                                    <a class="w-filter-item-ab" href="<?php echo Url::to(['lists/index','sec_id'=>$v->id]) ?>"><span class="item-content <?php if($v->id==$secid) echo 'filter-active-all-ab' ?>  "><?php echo $v->name ?></span></a>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="w-sort-bar">
                <div class="bar-area" style="position: relative; left: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; top: 0px;">
                        <span class="sort-area">
                            <a href="<?php echo Url::to(['lists/index','order'=>'order_default','id'=>$cateid]) ?>"  class="sort-default sort-default-active">默认</a>
                            <a href="<?php echo Url::to(['lists/index','order'=>'order_sale','id'=>$cateid]) ?>" class="sort-item sort-down sort-default-active" title="点击按销量降序排序">销量↓</a>
                            <a href="<?php echo Url::to(['lists/index','order'=>'order_price','id'=>$cateid]) ?>"   class="sort-item price-default price sort-default-active" title="点击按价格降序排序">价格↓</a>

                            <a href="<?php echo Url::to(['lists/index','order'=>'order_time','id'=>$cateid]) ?>"  class="sort-item sort-up sort-default-active" title="发布时间由近到远">最新发布↑</a>
                        </span>

                </div>
            </div>
            <ul class="itemlist eight-row-height">
                <?php foreach($deals as $v): ?>
                <li class="j-card">
                    <a>
                        <div class="imgbox">
                            <ul class="marketing-label-container">
                                <li class="marketing-label marketing-free-appoint"></li>
                            </ul>
                            <div class="range-area">
                                <div class="range-bg"></div>
                                <div class="range-inner">
                                    <span class="white-locate"></span>
                                    安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                </div>
                            </div>
                            <div class="borderbox">
                                <img src="<?php echo $v->image ?>" />
                            </div>
                        </div>
                    </a>
                    <div class="contentbox">
                        <a href="<?php echo Url::to(['detail/index',['id'=>$v->id]]) ?>" target="_blank">
                            <div class="header">
                                <h4 class="title ">【<?php echo count(explode(',',$v->location_ids)) ?>店通用】<?php echo $v->name ?></h4>
                                <div class="collected">精选</div>
                            </div>
                        </a>
                        <div class="add-info"></div>
                        <div class="pinfo">
                            <span class="price"><span class="moneyico">¥</span><?php echo $v->current_price ?></span>
                            <span class="ori-price">价值<span class="price-line">¥<span><?php echo $v->origin_price?></span></span></span>
                        </div>
                        <div class="footer">
                            <span class="comment">4.6分</span><span class="sold">已售<?php echo $v->buy_count ?></span>
                            <div class="bottom-border"></div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<div class="o2o-pager">
    <?php echo LinkPager::widget(['pagination' => $pager]) ?>
</div>
    <div class="content-wrap">共<span style="color: #ff4883"><?php echo count($deals) ?></span>条</div>
</div>

<div class="footer-content">
    <div class="copyright-info">

    </div>
</div>
<?php $this->beginBlock('viewJs') ?>
<script>
    $(".tab-item-wrap").click(function(){
        var index = $(".tab-item-wrap").index(this);
        $(".tab-item-wrap").removeClass("selected");
        $(".district-cont-wrap").css({display: "none"});
        $(this).addClass("selected");
        $(".district-cont-wrap").eq(index).css({display: "block"});
    });

    $(".sort-area a").click(function(){
        $(".sort-area a").removeClass("sort-default-active").css({color: "#666"});
        $(this).addClass("sort-default-active").css({color: "#ff4883"});
    });
</script>
<?php $this->endBlock() ?>
</body>
</html>