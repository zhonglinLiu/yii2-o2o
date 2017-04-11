<!--包含头部文件-->

<div class="cl pd-5 bg-1 bk-gray mt-20">
<h1></h1>
<?php
switch ($status) {
	case 0:
		echo '<h1> 入驻申请正在审核</h1> ';
		break;
	case -1:
		echo '<h1> 入驻申请被删除 </h1>';
		break;
	case 1:
		echo '<h1> 入驻申请审核成功 </h1>';
		break;
	default:
		echo '<h1>不存在该入驻申请情况</h1>';
		break;
}

?>
</div>

</body>
</html>