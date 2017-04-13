<?php 
use yii\helpers\Url;
?>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 分类管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo yii\helpers\Url::to(['category/index']) ?>" data-title="生活服务分类" href="javascript:void(0)">生活服务分类</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-city">
			<dt><i class="Hui-iconfont">&#xe616;</i> 城市管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo yii\helpers\Url::to(['citys/index']) ?>" data-title="城市分类" href="javascript:void(0)">城市分类</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-area">
			<dt><i class="Hui-iconfont">&#xe616;</i> 商圈管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="{:url('area/index')}" data-title="商圈分类" href="javascript:void(0)">商圈分类</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-bis">
			<dt><i class="Hui-iconfont">&#xe613;</i> 商家管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo yii\helpers\Url::to(['bis/index','status'=>1]) ?>" data-title="商家列表" href="javascript:void(0)">商户列表</a></li>
					<li><a _href="<?php echo yii\helpers\Url::to(['bis/index','status'=>0]) ?>" data-title="商家入驻申请" href="javascript:void(0)">商家入驻申请</a></li>
					<li><a _href="<?php echo yii\helpers\Url::to(['bis/index','status'=>-1]) ?>" data-title="删除的商户" href="javascript:void(0)">删除的商户</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-store">
			<dt><i class="Hui-iconfont">&#xe613;</i> 门店管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo Url::to(['bis-location/index','status'=>1]) ?>" data-title="门店列表" href="javascript:void(0)">门店列表</a></li>
					<li><a _href="<?php echo Url::to(['bis-location/index','status'=>0]) ?>" data-title="门店入驻申请" href="javascript:void(0)">门店入驻申请</a></li>
					<li><a _href="<?php echo Url::to(['bis-location/index','status'=>-1]) ?>" data-title="删除的门店" href="javascript:void(0)">删除的门店</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 团购商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo Url::to(['deal/index','status'=>0]) ?>" data-title="商家团购提交" href="javascript:void(0)">商家团购提交</a></li>
					<li><a _href="<?php echo Url::to(['deal/index','status'=>1]) ?>" data-title="团购列表" href="javascript:void(0)">团购列表</a></li>
					<li><a _href="<?php echo Url::to(['deal/index','status'=>2]) ?>" data-title="团购停用列表" href="javascript:void(0)">团购停用列表</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-pos">
			<dt><i class="Hui-iconfont">&#xe620;</i> 推荐位管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo Url::to(['featured/add']) ?>" data-title="添加推荐位内容" href="javascript:void(0)">添加推荐位内容</a></li>
					<li><a _href="<?php echo Url::to(['featured/index']) ?>" data-title="推荐位列表" href="javascript:void(0)">推荐位列表</a></li>
					
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo Url::to(['user/index']) ?>" data-title="会员列表" href="javascript:;">会员列表</a></li>
					<li><a _href="" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
				
				</ul>
			</dd>
		</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="" data-title="订单列表" href="javascript:void(0)">订单列表</a></li>
					<li><a _href="" data-title="删除的订单" href="javascript:void(0)">删除的订单</a></li>
					
				</ul>
			</dd>
		</dl>
		
	</div>
</aside>