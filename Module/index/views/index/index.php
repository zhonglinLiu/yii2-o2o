<?php 
use yii\helpers\Url;
use app\common\helpers\common
?>
<?php echo $this->render('../layouts/nav.php') ?>
    <div class="container">
        <div class="top-container">
            <div class="mid-area">
                <div class="slide-holder" id="slide-holder">
                    <a href="#" class="slide-prev"><i class="slide-arrow-left"></i></a>
                    <a href="#" class="slide-next"><i class="slide-arrow-right"></i></a>

                    <ul class="slideshow">
                        <?php foreach($this->params['tops'] as $v): ?>
                        <li><a href="<?php echo $v['url'] ?>" class="item-large"><img class="ad-pic" src="<?php echo $v['image'] ?>" /></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="list-container">
                    
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="right-ad">
                <ul class="slidepic">
                    <?php foreach($this->params['right'] as $v): ?>
                    <li><a href="<?php echo $v['url'] ?>"><img src="<?php echo $v['image'] ?>" /></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
        </div>
        <div class="content-container">
            <div class="no-recom-container">
                <div class="floor-content-start">
                    <?php foreach($detailCate as $k => $v): ?>
                    <div class="floor-content">

                        <div class="floor-header">
                            <h3><?php echo $v['name'] ?></h3>
                            <ul class="reco-words">
                                <?php foreach($this->params['catesChild'][$k] as $v2): ?>
                                <li><a href="<?php echo Url::to(['lists/index','cid'=>$v2['id']]) ?>" target="_blank"><?php echo $v2['name'] ?></a></li>
                                <?php endforeach;?>
                                <li><a class="no-right-border no-right-padding" href="<?php echo Url::to(['lists/index','id'=>$v['id']]) ?>" target="_blank">全部<span class="all-cate-arrow"></span></a></li>
                            </ul>
                        </div>
                        <ul class="itemlist eight-row-height">
                            <?php foreach($deals[$k] as $v): ?>
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

                                            </div>
                                        </div>
                                        <div class="borderbox">
                                            <img src="{$v.image}" />
                                        </div>
                                    </div>
                                </a>
                                <div class="contentbox">
                                    <a href="<?php echo Url::to(['detail/index','id'=>$v['id']]) ?>" target="_blank">
                                        <div class="header">
                                            <h4 class="title ">【<?php echo common::showLocations($v['location_ids']) ?>店通用】<?php echo $v['name'] ?></h4>
                                        </div>
                                    </a>
                                    <div class="add-info"></div>
                                    <div class="pinfo">
                                        <span class="price"><span class="moneyico">¥</span><?php echo $v['origin_price'] ?></span>
                                        <span class="ori-price">价值<span class="price-line">¥<span><?php echo $v['current_price'] ?></span></span></span>
                                    </div>
                                    <div class="footer">
                                        <span class="comment">4.6分</span><span class="sold">已售<?php echo $v['buy_count'] ?></span>
                                        <div class="bottom-border"></div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-content">
        <div class="copyright-info">
            
        </div>
    </div>
<?php $this->beginBlock('viewJs') ?>
    <script>
        var width = 800 * $("#slide-holder ul li").length;
        $("#slide-holder ul").css({width: width + "px"});

        //轮播图自动轮播
        var time = setInterval(moveleft,5000);

        //轮播图左移
        function moveleft(){
            $("#slide-holder ul").animate({marginLeft: "-737px"},600, function () {
                $("#slide-holder ul li").eq(0).appendTo($("#slide-holder ul"));
                $("#slide-holder ul").css("marginLeft","0px");
            });
        }

        //轮播图右移
        function moveright(){
            $("#slide-holder ul").css({marginLeft: "-737px"});
            $("#slide-holder ul li").eq(($("#slide-holder ul li").length)-1).prependTo($("#slide-holder ul"));
            $("#slide-holder ul").animate({marginLeft: "0px"},600);
        }

        //右滑箭头点击事件
        $(".slide-next").click(function () {
            clearInterval(time);
            moveright();
            time = setInterval(moveleft,5000);
        });

        //左滑箭头点击事件
        $(".slide-prev").click(function () {
            clearInterval(time);
            moveleft();
            time = setInterval(moveleft,5000);
        });
    </script>
<?php $this->endBlock()?>
</body>
</html>