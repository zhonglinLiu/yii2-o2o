<!--包含头部文件-->
<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 商户入驻申请 </nav>
<div class="page-container">
<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius"  href="<?php echo Url::to(['location/add']) ?>"><i class="Hui-iconfont">&#xe600;</i> 添加分店</a></span> <span class="r"></span> </div>
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
				<?php foreach($locs as $v): ?>
				<tr class="text-c">
					<td><?php echo $v->id ?></td>
					<td><?php echo $v->name ?></td>
					<td><?php echo date('Y-m-d h:i',$v->create_time) ?></td>
					<td>
					<?php if($v->is_main==1):?>
						是
					<?php else:?>
						否
					<?php endif; ?>
					</td>
					<td class="td-status"><?php echo $this->render('../layouts/status.php',['status'=>$v->status]) ?></td>
					<td class="td-manage"><a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('编辑','<?php echo yii\helpers\Url::to(['location/add','id'=>$v->id]) ?>','',300)" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>


<div class="o2o-pager">
	<?php echo LinkPager::widget(['pagination' => $pager]) ?>
</div>
<!--包含头部文件-->

