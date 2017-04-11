<?php
use app\assets\IndexAsset;
IndexAsset::register($this);
use yii\helpers\Url;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $this->params['title'] ?></title>
    <?php $this->head() ?>
    <?php if(isset($this->blocks['viewCss'])):?>
    <?php echo $this->blocks['viewCss'] ?>
	<?php endif; ?>
</head>
<?php $this->beginBody() ?>
<body>
<div class="header-bar">
    <div class="header-inner">
        <ul class="father">
            <li><a><?php echo $this->params['uname'] ?></a></li>
            <li>|</li>
            <li class="city">
                <a>切换城市<span class="arrow-down-logo"></span></a>
                <div class="city-drop-down">
                    <h3>热门城市</h3>
                    <ul class="son">
                        <?php foreach($this->params['citys'] as $city ): ?>
                        <li><a href="<?php echo Url::to(['index/index','city_id'=>$city['id'],'uname'=>$city['uname']]) ?>"><?php echo $city['name'] ?></a></li>
                            <?php if(!isset($this->params['cityChilds'][$city['id']])) continue; ?>
                            <?php foreach($this->params['cityChilds'][$city['id']] as $v ): ?>
                                <li><a href="<?php echo Url::to(['index/index','city_id'=>$v['id'],'uname'=>$v['uname']]) ?>"><?php echo $v['name'] ?></a></li>
                            <?php endforeach; ?>
                        <br/>
                        <br/>
                        <br/>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </li>
            <li> <a href="<?php echo Url::to(['/bis/login/index']) ?>">商户中心</a> </li>
            <?php if(isset(Yii::$app->session['user'])): ?>
            <li><a href="<?php echo Url::to(['user/logout']) ?>">退出登录</a></li>
            <li>欢迎您,<a href="javascript:;" >{$user->username}</a></li>
            <?php else: ?>
            <li><a href="<?php echo Url::to(['user/register']) ?>">注册</a></li>

            <li><a href="<?php echo Url::to(['user/login']) ?>">登录</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
    <?php if(isset($this->blocks['nav'])): ?>
    <?php $this->blocks['nav']?>
    <?php endif; ?>
	<?php echo $content; ?>
</body>
<?php $this->endBody() ?>
</html>
<?php if (isset($this->blocks['viewJs'])): ?>
    <?= $this->blocks['viewJs'] ?>

    
<?php endif; ?>
<?php $this->endPage() ?>