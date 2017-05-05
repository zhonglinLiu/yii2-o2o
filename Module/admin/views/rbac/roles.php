<?php
use yii\widgets\LinkPager; 
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权限管理 <span class="c-gray en">&gt;</span> 角色列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" onclick="o2o_s_edit('添加角色','<?php echo yii\helpers\Url::to(['rbac/addrole']) ?>','','300')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a></span> <span class="r"></span> </div>
	<div class="mt-20">
		<div class="row-fluid table">
                    <?php 
                       echo GridView::widget([
                            'dataProvider'=>$dataProvider,
                            'columns' => [
                                [
                                    'class' => 'yii\grid\SerialColumn',
                                ],
                                'description:text:名称',
                                'name:text:标识',
                                'rule_name:text:规则名称',
                                'created_at:datetime:创建时间',
                                'updated_at:datetime:更新时间',
                                [
                                    'class'=>'yii\grid\ActionColumn',
                                    'header'=>'操作',
                                    'template'=>'{assign} {update} {delete}',
                                    'buttons' => [
                                        'assign'=>function($url,$model,$key){
                                            return Html::a('分配权限',['assign-item','name'=>$model['name']]);
                                        },
                                        'update'=>function($url,$model,$key){
                                            return Html::a('更新',['addrole','name'=>$model['name']]);
                                        },
                                        'delete'=>function($url,$model,$key){
                                            return Html::a('删除',['deleterole','name'=>$model['name']]);
                                        }
                                    ]
                                ]
                            ],
                            'layout'=>"\n{items}\n{summary}<div class='pagination pull-right o2o-pager' >{pager}</div>"
                            
                        ])
                    ?>
                </div>
	</div>
</div>


<!--包含头部文件-->
<?php $this->beginBlock('viewJs') ?>
<script>
var SCOPE = {
    save_url: '<?php echo yii\helpers\Url::to(['category/listorder']) ?>',
    safe : "<?php echo Yii::$app->request->csrfToken ?>",
}

</script>
<?php $this->endBlock() ?>
