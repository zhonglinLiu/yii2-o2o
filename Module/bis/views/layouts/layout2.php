<?php 
use app\assets\HuiAsset;
HuiAsset::register($this);
// Yii::$app->getView()->registerJs('路径','依赖');

?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="admin/hui/lib/html5.js"></script>
<script type="text/javascript" src="admin/hui/lib/respond.min.js"></script>
<script type="text/javascript" src="admin/hui/lib/PIE_IE678.js"></script>
<![endif]-->

<?php $this->head() ?>

<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>o2o平台</title>
<meta name="keywords" content="tp5打造o2o平台系统">
<meta name="description" content="o2o平台">
</head>
<?php $this->beginBody() ?>
<!--包含头部文件-->

<?php echo $content; ?>




<!--分配编辑器-->
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