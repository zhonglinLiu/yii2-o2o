<!--包含头部文件-->
<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\common\components\statusWidget;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 门店入驻申请 </nav>
<div class="page-container">


	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
			<tr class="text-c">
				<th width="80">ID</th>
				<th width="100">门店名称</th>
				<th width="100">所属商户</th>
				<th width="60">旗舰店</th>
				<th width="100">联系人</th>
				<th width="150">联系电话</th>
				<th width="60">申请时间</th>
				<th width="60">状态</th>
				<th width="100">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($locations as $v): ?>
			<tr class="text-c">
				<td><?php echo $v->id ?></td>
				<td><?php echo $v->name ?></td>
				<td><a href="javascript:;" onClick="o2o_s_edit('门店详情','<?php echo yii\helpers\Url::to(['bis-location/detail','id'=>$v->id]) ?>','',300)"><?php echo $v->bis->name?></a></td>
				<td>
					<?php
						if($v->is_main==1)
							echo '是';
						else
							echo '否';
					?>
				</td>
				<td class="text-c"><?php echo $v->contact ?></td>
				<td class="text-c"><?php echo $v->tel ?></td>
				<td><?php echo $v->create_time ?></td>
				<?php if($status==0): ?>
				<td class="td-status"><a href="<?php echo Url::to(['bis-location/status','status'=>$v->status==1?0:1,'id'=>$v->id]) ?>" title="点击修改状态"><?php echo $this->render('../layouts/status.php',['status'=>$v->status]) ?></a></td>
				<?php else:?>
					<td><?php $statusWidget = statusWidget::begin() ?>
					<?php echo $statusWidget->showStatus($v->status) ?>
					<?php statusWidget::end() ?></td>
				<?php endif;?>
				<td class="td-manage">
					<a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('门店详情','<?php echo Url::to(['bis-location/detail','id'=>$v->id]) ?>','',300)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
					<?php if($status==0 || $status==1): ?>
					<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo Url::to(['bis-location/staus','status'=>-1,'id'=>$v->id]) ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					<?php endif; ?>
					<?php if($status==0): ?>
					<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo Url::to(['bis-location/staus','status'=>2,'id'=>$v->id]) ?>')" href="javascript:;" title="驳回"><i class="Hui-iconfont">驳回申请</i></a>
					<?php endif; ?>
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
