<!--包含头部文件-->
<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use app\common\components\statusWidget;
?>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 会员列表 </nav>
<div class="page-container">
<div class="cl pd-5 bg-1 bk-gray mt-20">
	<form action="<?php echo Url::to('/admin/user/index') ?>" method="post">
	<div class="text-c">
		 
		 注册时间范围：
		<input type="text" name="register_start_time" value="<?php if(isset($data['register_start_time'])) echo Html::encode($data['register_start_time']) ?>" class="input-text" id="countTimestart" onfocus="selecttime(1)"  style="width:120px;" >
			-
		<input type="text" name="register_end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php if(isset($data['register_end_time'])) echo Html::encode($data['register_end_time']) ?>"  style="width:120px;">
		 上次登录时间范围：
		<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php if(isset($data['start_time'])) echo Html::encode($data['start_time']) ?>" style="width:120px;" >
			-
		<input type="text" name="end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php if(isset($data['end_time'])) echo Html::encode($data['end_time']) ?>"  style="width:120px;">
		<input type="text" name="username" value="<?php if(isset($data['username'])) echo Html::encode($data['username']) ?>" id="" placeholder="姓名" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索
		</button>
	</div>
	<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken?>">
	</form>
</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="20">ID</th>
					<th width="100">姓名</th>
					<th width="40">邮箱</th>
					<th width="40">电话</th>
					<th width="40">上次登录ip</th>
					<th width="80">上次登录时间</th>
					<th width="80">排序</th>
					<th width="60">状态</th>
					<th width="40">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $v): ?>
				<tr class="text-c">
					<td><?=$v->id?></td>
					<td><?=$v->username?></td>
					<td>
						<?=$v->email?>
					</td>
					<td><?=$v->mobile?></td>
					<td><?=$v->last_login_ip?></td>
					<td><?=date('Y-m-d h:i',$v->last_login_time)?></td>
					<td class="text-c"> <input name="listorder" value="<?php echo $v->listorder ?>" attr-id="{$v.id}" size="3" class="listorder" /></td>
					<td><a href="<?php echo Url::to(['/admin/user/status','status'=>$v->status==1?2:1,'id'=>$v->id]) ?>" >
						<?php 
							$widget = statusWidget::begin();
							$widget->showStatus($v->status);
							statusWidget::end();
						?>

					</a></td>
					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('用户详情','<?php echo Url::to(['/admin/user/detail','id'=>$v->id]) ?>')" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo Url::to(['user/status','id'=>$v->id]) ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
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
<?=$this->registerJsFile('@web/admin/hui/lib/My97DatePicker/WdatePicker.js')?>
<!-- <script src="/__STATIC__/admin/hui/lib/My97DatePicker/WdatePicker.js"></script> -->
