<?php
use yii\widgets\LinkPager; 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<style type="text/css">
    .mylabel label{
        margin-right: 15px;
    }
</style>
<body>
<?php 
if(Yii::$app->session->hasFlash('info')){
    echo "<p style='text-align:center color:red'>".Yii::$app->session->getFlash('info')."</p>";
}
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权限管理 <span class="c-gray en">&gt;</span> 管理员授权 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

	<div class="mt-20">
		<?php $form = ActiveForm::begin([
            'options'=>['class'=>'new_user_form inline-input'],
            'fieldConfig'=>['template'=>'{error}<div class="span12 field-box">{input}</div>'],
        ]) ?>
        <div class="span6 field-box mylabel" >
        <?php echo Html::label('管理员:',null,['class'=>'span2']).Html::encode($username) ?>
        <br>
        <?php echo Html::label('角色:',null,['class'=>'span2']).Html::checkBoxList('children',$children['roles'],$roles) ?>
        <?php echo Html::label('权限:',null,['class'=>'span2']).Html::checkBoxList('children',$children['permissions'],$permissions) ?>
        <?php echo Html::submitButton('保存',['class'=>'btn btn-primary radius']) ?>
        </div>
        <?php ActiveForm::end() ?>
	</div>
</div>

