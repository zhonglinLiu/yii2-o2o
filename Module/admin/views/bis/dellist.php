<!--包含头部文件-->
<?php 
use yii\widgets\LinkPager;
use yii\helpers\Html;
use app\common\components\statusWidget;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 商户入驻申请 </nav>
<div class="page-container">


	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
			<tr class="text-c">
				<th width="80">ID</th>
				<th width="100">商户名称</th>
				<th width="30">法人</th>
				<th width="150">联系电话</th>
				<th width="60">申请时间</th>
				<th width="60">状态</th>
				<th width="100">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($biss as $v): ?>
			<tr class="text-c">
				<td><?php echo $v->id ?></td>
				<td><?php echo $v->name ?></td>
				<td class="text-c"><?php echo $v->faren ?></td>
				<td class="text-c"><?php echo $v->faren_tel ?></td>
				<td><?php echo date('Y-m-d h:i',$v->create_time) ?></td>
				<td class="td-status"><a href="<?php echo yii\helpers\Url::to(['bis/status','status'=>$v->status==1?2:1,'id'=>$v->id]) ?>" title="点击修改状态">
					<?php $status = statusWidget::begin() ?>
					<?php echo $status->showStatus($v->status) ?>
					<?php statusWidget::end() ?>
					
				</a></td>

				<td class="td-manage">
					<a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('商户详情','<?php echo yii\helpers\Url::to(['bis/detail','id'=>$v->id]) ?>','',300)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
					<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo yii\helpers\Url::to(['bis/status','status'=>-1,'id'=>$v->id]) ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo yii\helpers\Url::to(['bis/status','status'=>2,'id'=>$v->id]) ?>')" href="javascript:;" title="驳回"><i class="Hui-iconfont">驳回申请</i></a>
				</td>
				
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="o2o-pager">
	<?php echo LinkPager::widget(['pagination' => $pager]) ?>
</div>
</div>
<!--包含头部文件-->
<?php echo $this->render('../layouts/footer.php') ?>
