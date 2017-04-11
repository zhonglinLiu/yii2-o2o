<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\common\components\statusWidget;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 团购商品列表 </nav>
<div class="page-container">
<div class="cl pd-5 bg-1 bk-gray mt-20">
	<form action="{:url('deal/apply')}" method="post">
	<div class="text-c">
		 <span class="select-box inline">
			<select name="category_id" class="select">
				<option value="0">全部分类</option>
				<?php foreach($cates as $v):  ?>
				<option value="<?php echo $v->id ?>" {if condition="$v.id eq $category_id"}selected{/if} ><?php echo $v->name ?></option>
				<?php endforeach; ?>
			</select>
		</span>
		<span class="select-box inline">
			<select name="city_id" class="select">
				<option value="0">全部城市</option>
				<?php foreach($citys as $v): ?>
					<option value="<?php echo $v->id ?>" {if condition="$v.id eq $city_id" }selected{/if} ><?php echo $v->name ?></option>
				<?php endforeach; ?>
			</select>
		</span> 日期范围：
		<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="" style="width:120px;" >
			-
		<input type="text" name="end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value=""  style="width:120px;">
		<input type="text" name="name" value="" id="" placeholder=" 商品名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索
		</button>
	</div>
	</form>
</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="20">ID</th>
					<th width="100">商品名称</th>
					<th width="40">栏目分类</th>
					<th width="40">城市</th>
					<th width="40">购买件数</th>
					<th width="80">开始-结束时间</th>
					<th width="80">创建时间</th>
					<th width="60">状态</th>
					<th width="40">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($deals as $v): ?>
				<tr class="text-c">
					<td><?php echo $v->id ?></td>
					<td><?php echo $v->name ?></td>
					<td>
						<?php echo $v->category->name ?>
					</td>
					<td><?php echo $v->citys->name ?></td>
					<td><?php echo $v->total_count ?></td>
					<td><?php echo date('Y-m-d h:i',$v->start_time) ?>-<?php echo date('Y-m-d h:i',$v->end_time) ?></td>
					<td><?php echo date('Y-m-d h:i',$v->create_time) ?></td>
					<td><a href="<?php echo Url::to(['deal/status','status'=>$v->status==1?2:1,'id'=>$v->id]) ?>" >
						<?php $status = statusWidget::begin() ?>
						<?php echo $status->showStatus($v->status) ?>
						<?php statusWidget::end() ?>
						
					</a></td>
					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('团购详情','<?php echo Url::to(['deal/detail','id'=>$v->id]) ?>')" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_del('?php echo Url::to(['deal/status','id'=>$v->id,'status'=>-1]) ?>')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6e2;</i></a>
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


