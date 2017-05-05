<?php
use yii\widgets\LinkPager; 
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权限管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" onclick="o2o_s_edit('添加管理员','<?php echo yii\helpers\Url::to(['rbac/addrole']) ?>','','300')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span> <span class="r"></span> </div>
	<div class="mt-20">
		<div class="row-fluid table">
                    <?php 
                       echo GridView::widget([
                            'dataProvider'=>$dataProvider,
                            'columns' => [
                                [
                                    'class' => 'yii\grid\SerialColumn',
                                ],
                                'id:text:序号',
                                'username:text:用户名',
                                'last_login_ip:text:上次登录ip',
                                'last_login_time:datetime:上次登录时间',
                                'email:text:邮箱',
                                'mobile:text:手机号',
                                'create_time:datetime:创建时间',
                                [
                                    'class'=>'yii\grid\ActionColumn',
                                    'header'=>'操作',
                                    'template'=>'{assignrole} {update} {delete}',
                                    'buttons' => [
                                        'assignrole'=>function($url,$model,$key){
                                            return Html::a('添加角色',['assignrole','id'=>$model['id']]);
                                        },
                                        'update'=>function($url,$model,$key){
                                            return Html::a('更新',['editadmin','id'=>$model['id']]);
                                        },
                                        'delete'=>function($url,$model,$key){
                                            return Html::a('删除',['deladmin','id'=>$model['id']]);
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
