<?php
	//商品模块
	class PingjiaControl{
		//显示评价
		function show(){
			$order = 'id DESC';
			//查询商品
			$m = new Model('pingjia');
			$p = new Page($m->where()->total(),8);
			$result = $m->where()->order($order)->limit($p->limit())->select();
			// var_dump($res);
			//echo $m->sql;
			include './view/pingjia_list.html';

		}
		//评价详情
		function info(){
			//实例化model类
			$m = new Model('pingjia');
			//根据get传入的id查询指定id的评价详情信息
			$result = $m->where("id='".$_GET['id']."'")->find();
			$time = date("Y-m-d H:i:s",$result['addtime']);
			// var_dump($result);
			include './view/pingjia_info.html';
		}
		//删除评价
		function del(){
			//先将订单用户订单评价状态改为可以评价状态
			$m = new Model('orders');
			$_POST['is_ping'] = 0;
			//执行成功再删除评价表
			if ($m->where('id='.$_GET['orderid'])->update($_POST)) {
				//实例化model类
				$m1 = new Model('pingjia');
				//根据get的id删除指定的评价
				$m1->where('id='.$_GET['id'])->delete();
				echo '<script>alert("删除成功，用户可以再次评价");location="./index.php?m=pingjia&a=show"</script>';
			}else{
				echo '<script>alert("删除失败");location="./index.php?m=pingjia&a=show"</script>';
			}
			// echo $m->sql;

		}
	}