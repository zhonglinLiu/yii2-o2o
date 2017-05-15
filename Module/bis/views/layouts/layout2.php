<?php 
use app\assets\HuiAsset;
HuiAsset::register($this);
// Yii::$app->getView()->registerJs('路径','依赖');

?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html>
<head>

<?php $this->registerMetaTag(['charset'=>'utf-8']) ?>
<?php $this->registerMetaTag(['name'=>'renderer','content'=>'webkit|ie-comp|ie-stand']) ?>
<?php $this->registerMetaTag(['http-equiv'=>'X-UA-Compatible','content'=>'IE=edge,chrome=1']) ?>
<?php $this->registerMetaTag( ['name'=>'viewport','content'=>'width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no'])?>
<?php $this->registerMetaTag(['http-equiv'=>'Cache-Control','content'=>'no-siteapp']) ?>
<?php $this->registerMetaTag(['name'=>'keywords','content'=>'tp5打造o2o平台系统']) ?>
<?php $this->registerMetaTag(['name'=>'description','content'=>'o2o平台']) ?>

<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />


<?php $this->head() ?>

<title>o2o平台</title>

</head>
<?php $this->beginBody() ?>


<?php echo $content; ?>




<?php $this->endBody() ?>
<?php if (isset($this->blocks['viewJs'])): ?>
    <?= $this->blocks['viewJs'] ?>

    
<?php endif; ?>

</body>
<?php 

$this->registerJsFile('/js/uploadify/jquery.uploadify.js');
$this->registerJsFile('/js/image.js');
?>
</html>
<?php $this->endPage() ?>