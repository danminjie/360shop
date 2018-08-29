<?php
	//商品模块
	class BuyControl{
		//显示商品
		function show(){
			session_start();

			//判断是否登录
			if(isset($_SESSION['suser']['islogin']) && $_SESSION['suser']['islogin'] == true && $_SESSION['suser']['state'] == 1){
				//获取session里面的指定id数据
				$res = $_SESSION['cart'][$_GET['id']];
				include './view/order_buy.html';
			}else{
				//没登录
				echo '<script>alert("不好意思,没登录，不能随意购买,快点确定去登录！！！");location="./index.php?m=logreg&a=login"</script>';
			}
		}
		function buy(){
			$_POST['addtime'] = time();
			//实例化model类
			$m = new Model('orders');
			$orderid = $m->insert($_POST);
			// echo $m->sql;
			// exit;
			if (!empty($orderid)) {
				echo '<script>alert("恭喜你，购买成功，这单免费，快去检查吧");location="./index.php?m=user&a=order"</script>';
			}else{
				echo '<script>alert("购买失败重新来");location=location=history.go(-2);</script>';
			}
		}

	}