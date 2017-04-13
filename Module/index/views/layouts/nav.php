
<?php 
use yii\helpers\Url;
?>
    <div class="search">
        <img src="/index/image/logo.png" />
        
    </div>

    <div class="nav-bar-header">
        <div class="nav-inner">
            <ul class="nav-list">
                <li class="nav-item">
                    <span class="item">全部分类</span>
                    <div class="left-menu">
                        <?php foreach($this->params['cates'] as $k => $cate): ?>
                        <div class="level-item">
                            <div class="first-level">
                                <dl>
                                    <dt class="title"><a href="<?php echo Url::to(['lists/index','id'=>$k]) ?>" target="_blank"><?php echo $cate->name ?></a></dt>
                                    <?php foreach($this->params['catesChild'][$k] as $key=> $v): ?>
                                        <?php if($key>=2) break; ?>
                                    <dd><a href="<?php echo Url::to(['lists/index','id'=>$v->id]) ?>" target="_blank" class=""><?php echo $v->name ?></a></dd>
                                    <?php endforeach; ?>
                                </dl>
                            </div>
                            <div class="second-level">
                                <div class="section">
                                    <div class="section-item clearfix no-top-border">
                                        <h3>热门分类</h3>
                                        <ul>
                                            <?php foreach($this->params['catesChild'][$k] as $v): ?>
                                            <li><a href="<?php echo Url::to(['lists/index','sec_id'=>$v->id]) ?>" target="_blank" class=""><?php echo $v->name ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </li>
                <li class="nav-item"><a class="item first active">首页</a></li>
                <?php foreach($this->params['cates'] as $k => $cate): ?>
                <li class="nav-item"><a href="javascript;" class="item"><?=$cate->name?></a></li>
                <?php endforeach; ?>
                <!-- <li class="nav-item"><a class="item" >商户</a></li> -->
            </ul>
        </div>
    </div>