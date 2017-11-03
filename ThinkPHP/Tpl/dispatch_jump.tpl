<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="ADMIN_TPL_CSS/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<title>跳转提示</title>
</head>
<body>
<script src="ADMIN_TPL_JS/jquery.min-v=2.1.4.js"></script>
<script src="ADMIN_TPL_JS/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
		var mess = "<?php echo($message); ?>";
		var err = "<?php echo($error); ?>";
		var jumpurl = "<?php echo($jumpUrl); ?>";
		var waitSecond = "<?php echo($waitSecond); ?>";
		<?php if(isset($message)) {?>
		swal({
			title: mess,
			text: '页面自动跳转中... 等待时间:' + waitSecond + '秒',
			type: 'success',
			timer: waitSecond*1000,
			showConfirmButton: false
		},function(){
			self.location.href=jumpurl;
		});		
		<?php }else{?>
		swal({
			title: err,
			text: '页面自动跳转中... 等待时间:' + waitSecond + '秒',
			type: 'error',
			timer: waitSecond*1000,
			showConfirmButton: false
		},function(){
			self.location.href=jumpurl;
		});
		<?php }?>
});
</script>
</body>
</html>
