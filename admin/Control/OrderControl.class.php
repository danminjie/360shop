<?php
	//商品模块
	class OrderControl{
		//显示订单
		function show(){
			$order = 'id DESC';
			//查询商品
			$m = new Model('orders');
			$p = new Page($m->where()->total(),8);
			$result = $m->where()->order($order)->limit($p->limit())->select();
			$state = array(
		            '<font color="red">正在出库</font>',
		            '<font color="red">已发货</font>',
		            '<font color="red">确认收货</font>',
		            '<font color="green" size="5">已完成</font>',);
			// var_dump($res);
			//echo $m->sql;
			include './view/order_list.html';

		}
		//发货
		function zhuangtai(){
			$m = new Model('orders');
			$status = $_GET['status'];
			$_POST['status'] = $status;
			// var_dump($_GET['id']);
			// var_dump($_POST);
			// exit;
			if($m->where('id='.$_GET['id'])->update($_POST)){
				if ($status == 1) {
					echo '<script>alert("已发货");location="./index.php?m=order&a=show"</script>';
				}elseif ($status == 3) {
					echo '<script>alert("订单处理成功");location="./index.php?m=order&a=show"</script>';
				}else{
					echo '<script>alert("处理成功");location="./index.php?m=order&a=show"</script>';					
				}
				
			}else{
				if ($status == 1) {
					echo '<script>alert("发货失败");location="./index.php?m=order&a=show"</script>';
				}elseif ($status == 3) {
					echo '<script>alert("订单处理失败");location="./index.php?m=order&a=show"</script>';
				}else{
					echo '<script>alert("处理失败");location="./index.php?m=order&a=show"</script>';					
				}
			}
		}

		//订单详情
		function order_info(){
			$m = new Model('orders');
			//根据条件查询指定id的订单详情
			$result = $m->where("id='".$_GET['id']."'")->find();
			$time = date('Y-m-d H:i:s',$result['addtime']);
			// var_dump($result);
			include './view/order_info.html';
		}
	}