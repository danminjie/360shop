<?php
	//前台会员类
	class UserControl{
		//订单列表
		function order(){
			session_start();
			//实例化model类得到订单数据库
			$m = new model('orders');
			//把session里的 会员id赋值给uid
			$uid = $_SESSION['suser']['id'];
			// var_dump($uid);
			//判断当前需要查询的订单状态
			$where = '';
			$yf = $wf = $ys = $wc = '0';
			$classall = $classwf = $classyf = $classys = $classwc = '';
			if (($m->where("uid='".$uid."' AND status='0'")->select()) != false) {
				$wf = count($m->where("uid='".$uid."' AND status='0'")->select());
			}else{
				$wf = 0;
			}
			if (($m->where("uid='".$uid."' AND status='1'")->select()) != false) {
				$yf = count($m->where("uid='".$uid."' AND status='1'")->select());
			}else{
				$yf = 0;
			}
			if (($m->where("uid='".$uid."' AND status='2'")->select()) != false) {
				$ys = count($m->where("uid='".$uid."' AND status='2'")->select());
			}else{
				$ys = 0;
			}
			if (($m->where("uid='".$uid."' AND status='3'")->select()) != false) {
				$wc = count($m->where("uid='".$uid."' AND status='3'")->select());
			}else{
				$wc = 0;
			}
			// var_dump($wc);
			// echo $m->sql;
			if(isset($_GET['biaoshi'])){
				if ($_GET['biaoshi'] == 'wf') {
					$where = " status='0";
					$classwf = 'order_current_title';
				}elseif ($_GET['biaoshi'] == 'yf') {
					$where = " status='1";
					$classyf = 'order_current_title';
				}elseif ($_GET['biaoshi'] == 'ys') {
					$where = " status='2";
					$classys = 'order_current_title';
				}else{
					$where = " status='3";
					$classwc = 'order_current_title';
				}
			}else{
				$where = " status!='999";
				$classall = 'order_current_title';
			}
			//查询当前会员id的订单
			$result = $m->where("uid='".$uid."' AND ".$where."'")->order(' id DESC ')->select();
			// echo $m->sql;
			include './view/order_list.html';
			include './view/footer.html';
		}
		//订单详情
		function showorder(){
			session_start();
			//实例化订单
			$m = new Model('orders');
			//查询指定id的订单
			$result = $m->where("id='".$_GET['id']."'")->find();
			// echo $m->sql;
			//实例化model得到产品操作类
			$m1 = new Model('goods');
			$goods = $m1->where("id='".$result['goodsid']."'")->find();
			// echo $m1->sql;
			// var_dump($goods);
			$state = array(
		            '<font color="red">正在出库</font>',
		            '<font color="red">已发货</font>',
		            '<font color="red">确认收货</font>',
		            '<font color="green" size="4">已完成</font>');
			// var_dump($result);
			include './view/order_show.html';
			include './view/footer.html';
		}
		//用户收货
		function zhuangtai(){
			$m = new Model('orders');
			$status = $_GET['status'];
			$_POST['status'] = $status;
			// var_dump($_GET['id']);
			// var_dump($_POST);
			// exit;
			if($m->where('id='.$_GET['id'])->update($_POST)){
				echo '<script>alert("确认收货");location="./index.php?m=user&a=showorder&id='.$_GET['id'].'"</script>';
			}else{
				echo '<script>alert("确认收货失败，我也不知道为啥");location="./index.php?m=user&a=showorder"</script>';
			}
		}
		//用户评价
		function pingorder(){
			session_start();
			//实例化订单
			$m = new Model('orders');
			//根据订单ID查询到产品id
			$goodsid = $m->where('id='.$_GET['id'])->find();
			//实例化产品
			$m = new Model('goods');
			//根据订单ID里面的产品ID找到产品信息
			$result = $m->where('id='.$goodsid['goodsid'])->find();
			// var_dump($result);
			include './view/order_pingjia.html';
			include './view/footer.html';
		}
		//会员密码修改
		function update(){
			session_start();
			$m = new Model('user');
			$result = $m->where('id='.$_SESSION['suser']['id'])->find();
			// var_dump($result);
			include './view/user_update.html';
			include './view/footer.html';
		}
		//修改密码
		function do_update(){
			// var_dump($_POST);
			// exit;
			//判断是否需要修改密码
			if(!empty($_POST['pwd']) && !empty($_POST['repwd'])){
				//用户需要更改密码
				if($_POST['pwd'] != $_POST['repwd']){
				echo '<script>alert("两次密码不一致");location="./index.php?m=user&a=update&"</script>';
				die();
				}else{
					//加密密码
					$_POST['pwd'] = md5($_POST['pwd']);
					$m = new Model('user');
					if($m->where("id='".$_POST['uid']."'")->update($_POST)){
						echo '<script>alert("密码修改成功");location="./index.php?m=user&a=update&"</script>';
					}else{
						echo '<script>alert("密码修改失败");location="./index.php?m=user&a=update&"</script>';
					}
				}
			}else{
				//用户不需要更改密码
				echo '<script>alert("不修改密码，不需要提交");location="./index.php?m=user&a=update&"</script>';

			}
			//var_dump($_POST);
		}
		//执行评价记录添加
		function do_pingjia(){
			//实例化model类得到评价表操作
			$m = new Model('pingjia');
			//评价时间获取当前时间
			$_POST['addtime'] = time();
			$_POST['orderid'] = $_POST['id'];
			// var_dump($_POST);
			// exit;
			//判断是否添加成功
			if ($m->insert($_POST)) {
				//添加成功同时将订单表的是否评价状态改为已评价
				$m1 = new Model('orders');
				$_POST['is_ping'] = 1;
				$m1->where('id='.$_POST['id'])->update($_POST);
				echo '<script>alert("评价成功");location="./index.php?m=user&a=order"</script>';
			}else{
				// $m->sql;
				echo '<script>alert("评价失败请重新评价");location="./index.php?m=user&a=order"</script>';
			}
			// var_dump($_POST);
		}
		function info(){
			// var_dump($_POST);
			// var_dump($_GET);
			//查询数据库会员附表中是否有传入当前的id数据
			$result = $this->selectUser_info();
			//定义判断空变量
			$nv = $nan = $baomi  = '';
			$dazhuan = $benke = $yan = $xxz = '';
			$yxz = $y1 = $y2 = $y3 = $y4  = '';
			$hxz = $dan = $yi = $li = $sang = '';
			//如果该变量有数据 则 显示修改  如果该变量没有数据 则是添加
			if($result){
				//定义显示变量
				$method = 'do_user_update';
				//性别判断
				switch($result['sex']){
					case 0:
						$nv = 'checked';
						break;
					case 1:
						$nan = 'checked';
						break;
					case 2:
						$baomi = 'checked';
					default:
						$nan = 'checked';
				}
				//判断学历
				switch($result['xueli']){
					case 0;
						$dazhuan = 'selected';
						break;
					case 1:
						$benke = 'selected';
						break;
					case 2:
						$yan = 'selected';
						break;
					default:
						$xxz = 'selected';
				}
				//判断月收入
				switch($result['ysr']){
					case 0:
						$y1 = 'selected';
						break;
					case 1:
						$y2 = 'selected';
						break;
					case 2:
						$y3 = 'selected';
						break;
					case 3:
						$y4 = 'selected';
						break;
					default:
						$yxz = 'selected';
				}
				//婚姻判断
				switch($result['hunfou']){
					case 0:
						$dan = 'selected';
						break;
					case 1:
						$yi = 'selected';
						break;
					case 2:
						$li = 'selected';
						break;
					case 3:
						$sang = 'selected';
						break;
					default:
						$hxz = 'selected';
				}
				//var_dump($result['hobby']);
				//将从数据库中得到的爱好数组下标再次转换成数组
				$result['hobby'] = explode(',',$result['hobby']);
				//var_dump($result);
				//echo '修改';
				//做修改时头像显示
				$img = '<img src="../public/upload/pic/'.$result['pic'].'" width="100" />';
				$yimg = '<input type="hidden" name="ypic" value="'.$result['pic'].'">';
			}else{
				$method = 'do_user_add';
				$img = '';
				$yimg = '';
			}
			//定义一个爱好数组
			$hobby = array('吃','喝','玩','乐','紫藤','美女','苍老师');
			//查询会员行业表数据库 查询行业
			$m = new Model('user_hangye');
			$hangye = $m->select();
			//var_dump($hangye);
			//echo '查看会员详细信息';
			include './View/user_info.html';
			include './View/footer.html';
		}
		//修改会员详细信息方法
		function do_user_update(){
			//1.获取要修改的会员详细信息
			//2.判断是否需要修改会员图像
			$bool = false;
			if(!empty($_FILES['pic']['name'])){
				//修改图像
				$up = new Upload('pic','../public/upload/pic');
				$res = $up->do_upload();
				if(is_array($res)){
					//拼接图片新名称
					$_POST['pic'] = $res['name'];
					$bool = true;
				}else{
					//图片名称没有更改
					$_POST['pic'] = $_POST['ypic'];
				}
			}else{
				//图片名称没有更改
				$_POST['pic'] = $_POST['ypic'];
			}
			//var_dump($_POST);
			//3.处理数据
			$_POST['hobby']  = implode(',',$_POST['hobby']);
			//4.进行数据修改
			$m = new Model('user_info');
			$r = $m->where('uid='.$_POST['uid'])->update($_POST);
			// echo $m->sql;//exit;
			//5.删除原有图像
			if($bool == true){
				if ($_POST['ypic'] != 'moren.jpg') {
					unlink('../public/upload/pic/'.$_POST['ypic']);
				}
				
			}
			//6.如果成功则返回 (切记 带回数据的id 和 username)
			if($r){
				echo '<script>alert("修改成功");location="./index.php?m=user&a=info&username='.$_POST['username'].'"</script>';
			}else{
				echo '<script>alert("修改失败");location="./index.php?m=user&a=info&username='.$_POST['username'].'"</script>';
			}
		}
		//私有方法赋值查询会员详细信息
		private function selectUser_info(){
			session_start();
			//实例化数据库对象
			$m = new Model('user_info');
			return $m->where('uid='.$_SESSION['suser']['id'])->find();
			//var_dump($result);
		}
		//执行添加会员详情信息方法
		function do_user_add(){
			
			// die();
			// var_dump($_FILES);
			//1.进行图片上传
			$up = new Upload('pic','../public/upload/pic');
			$res = $up ->do_upload();
			if(is_array($res)){
				$_POST['pic'] = $res['name'];
			}else{
				//var_dump($_GET);
				//echo $res;
				echo '<script>alert("'.$res.'");location="./index.php?m=user&a=info&username='.$_POST['username'].'"</script>';
				//$_POST['pic'] = 'a.jpg';
			}

			//2.处理数据
			//var_dump($_POST);
			//将爱好拼接成字符串
			$_POST['hobby'] = implode(',',$_POST['hobby']);
			// var_dump($_POST);
			// die();
			//3.添加数据
			$m = new Model('user_info');
			if($m->insert($_POST)){
				echo '<script>alert("添加成功");location="./index.php?m=user&a=info&username='.$_POST['username'].'"</script>';
			}else{
				echo '<script>alert("添加失败");location="./index.php?m=user&a=info&username='.$_POST['username'].'"</script>';
			}
		}
}