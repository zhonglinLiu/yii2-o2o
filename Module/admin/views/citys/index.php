<!--包含头部文件-->
<?php 
use yii\widgets\LinkPager;
use app\common\components\statusWidget;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" onclick="o2o_s_edit('添加生活服务分类','<?php echo yii\helpers\Url::to(['citys/add']) ?>','','300')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r"></span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="40"><input name="" type="checkbox" value=""></th>
					<th width="80">ID</th>
					<th width="100">分类</th>
					<th width="30">排序序号</th>
					<th width="150">新增时间</th>
					<th width="60">发布状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($citys as $v): ?>
				<tr class="text-c">
					<td><input name="" type="checkbox" value=""></td>
					<td><?php echo $v->id ?></td>
					<td><?php echo $v->name ?></td>
					<td class="text-c"> <input class="top-listorder" name="listorder" value="<?php echo $v->listorder ?>" attr-id="<?php echo $v->id ?>" size="3" class="listorder" /></td>
					<td><?php echo date('Y-m-d h:i',$v->create_time) ?></td>
					<td class="td-status"><a href="<?php echo yii\helpers\Url::to(['citys/status','status'=>$v->status==1?2:1,'id'=>$v->id]) ?> " title="点击修改状态">
						<?php $status = statusWidget::begin() ?>
						<?php echo $status->showStatus($v->status) ?>
						<?php statusWidget::end() ?>
						
					</a></td>
					<td class="td-manage">
						<a  href="<?php echo yii\helpers\Url::to(['citys/index','parent_id'=>$v->id]) ?>">获取子栏目</a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('编辑','<?php echo yii\helpers\Url::to(['citys/edit','id'=>$v->id]) ?>','',300)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo yii\helpers\Url::to(['citys/status','id'=>$v->id,'status'=>-1]) ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
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
<?php $this->beginBlock('viewJs') ?>
<script>
var SCOPE = {
    save_url: '<?php echo yii\helpers\Url::to(['citys/listorder']) ?>',
}
$('.top-listorder').hover(
	function(){
		layer.tips('修改我排序', this, {
		  tips: [1, '#0FA6D8'] //还可配置颜色
		});
	},
	function(){

	}

)
		

</script>
<?php $this->endBlock() ?>
