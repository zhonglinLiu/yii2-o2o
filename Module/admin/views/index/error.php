<p style="font-size:20px;text-align: center; margin-top: 25px;" >-_^哎呀</p>
<p style="font-size:16px;text-align: center;" ><?php echo $msg ?></p>
<P  style="font-size: 18px; text-align: center;"> <span  id="show-time">3</span>秒后跳转<a style="text-decoration: underline;padding: 15px;" href="<?php echo  isset($url) ? $url : $_SERVER['HTTP_REFERER'] ?>">立即跳转</a></P>
<script type="text/javascript">
	var time = parseInt("<?php echo isset($time) ? $time : 3 ?>");
	setInterval(function(){
		if(time>0){
			time--
			console.log(time);
			document.getElementById('show-time').innerHTML = time;
		}else{
			window.location.href = "<?php echo  isset($url) ? $url : $_SERVER['HTTP_REFERER'] ?>";
		}

	},1000);
</script>
