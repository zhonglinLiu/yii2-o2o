<!--包含头部文件-->
<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\common\components\statusWidget;
?>
<body>
<nav class="breadcrumb"></nav>
<div class="page-container">
  <div class="text-c"> 
  <form method="post" action="<?php echo Url::to(['featured/index']) ?>">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>选择推荐类别：</label>
      <div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
        <select name="type" class="select">
        <?php foreach($featured_type as $k => $v): ?>
          <option value="<?php echo $k ?>" <?php if( isset($selected_type['type']) && $selected_type['type']==$k) echo 'selected' ?> ><?php echo $v ?></option>
         <?php endforeach; ?>
        </select>
        </span>
      </div>
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont"></i> 搜索</button>
  </form>
  </div>
  
  <div class="mt-20">
    <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="40">ID</th>
          <th width="150">标题</th>
          <th width="100">地址</th>
          <th width="150">新增时间</th>
          <th width="30">发布状态</th>
          <th width="30">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($featured as $v): ?>
        <tr class="text-c">
          <td><?php echo $v->id ?></td>
          <td><a href="<?php echo $v->url ?>" target="_blank"><?php echo $v->title ?></a></td>
          <td class="text-c"><?php echo $v->url ?></td>
          <td><?php echo date('Y-m-d h:i',$v->create_time) ?></td>
          <td class="td-status"><a href="<?php echo Url::to(['featured/status','status'=>$v->status==1?2:1,'id'=>$v->id]) ?>" title="点击修改状态">
          <?php $widget = statusWidget::begin() ?>
          <?php echo $widget->showStatus($v->status) ?>
          <?php statusWidget::end() ?>
          </a></td>
          <td class="td-manage"> <a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo Url::to(['featured/status','status'=>-1,'id'=>$v->id]) ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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

