<!--包含头部文件-->
<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\common\components\statusWidget;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 管理员管理 </nav>
<div class="page-container">
<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a onclick="o2o_s_edit('添加管理员','<?php echo Url::to(['manager/add']) ?>','','300')" class="btn btn-primary radius"  href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span> <span class="r"></span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th width="100">名称</th>
					<th width="60">申请时间</th>
					<th width="60">是否为总店</th>
					<th width="60">状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($account as $v): ?>
				<tr class="text-c">
					<td><?php echo $v->id ?></td>
					<td><?= $v->username ?></td>
					<td><?=date('Y-m-d h:i:s',$v->create_time)?></td>
					<td>
						<?php if($v->is_main==1):?>
							<span>是</span>
						<?php else: ?>
							<span>否</span>
						<?php endif; ?>
					</td>
					<td>
					<a href="<?php echo Url::to(['manager/status','status'=>$v->status==1?2:1,'id'=>$v->id]) ?>">
					<?php $widget = statusWidget::begin() ?>
						<?php echo $widget->showStatus($v->status) ?>
					<?php statusWidget::end() ?>
					</td>
					</a>
					<td class="td-manage"><a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('修改管理员','<?php echo Url::to(['manager/edit','id'=>$v->id]) ?>','','300')" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="o2o-pager">
	<?php echo LinkPager::widget(['pagination'=>$pager]) ?>
</div>
<!--包含头部文件-->

