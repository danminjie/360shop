<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="./include/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="./include/js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>


</head>

<body style="background:url(./include/images/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="./index.php" target="_parent"><img src="./include/images/logo.png" title="系统首页" /></a>
    </div>
        
    <ul class="nav">
    
    
    </ul>
            
    <div class="topright">    
    <ul>
    <?php session_start(); 
    ?>
    <li>欢迎您:【<?=$_SESSION['user']['username']?>】</a></li>
    <li><a href="./index.php?m=login&a=logout" >退出</a></li>
    </ul>
     
    <div class="user">
    </div>    
    
    </div>
</body>
</html>
