<?php
	//登录注册类
	class LogregControl{
		//前台登录
		function login(){
			include './view/login.html';
			include './view/footer.html';
		}
		function do_login(){
			// var_dump($_POST);
			session_start();
			//实例化model类
			$m = new Model('user');
			//将传入的密码加密
			$pwd = md5($_POST['pwd']);
			//将session的验证码转小写
			$ycode = strtolower($_SESSION['code']);
			//将用户输入的验证码转小写
			$ncode = strtolower($_POST['code']);
			// echo $m->sql;
			// 判断验证码是否一致
			if ($ycode == $ncode) {
				//验证码一致，判断用户账号密码是否一致
				$jieguo = $m -> where(" username = '{$_POST['username']}' AND pwd = '$pwd' AND huishou=0 ")->select();
				// var_dump($jieguo);
				// exit;
				if ($jieguo) {
					//账号密码一致登录成功同时写入session中记录
					$_SESSION['suser']['islogin'] = true;
					$_SESSION['suser']['username'] = $_POST['username'];
					$_SESSION['suser']['state'] = 1;
					$_SESSION['suser']['id'] = $jieguo[0]['id'];
					// echo '<script>alert("登录成功");location="'.$_SERVER['HTTP_REFERER'].'"</script>';
					echo '<script>alert("登录成功");location=history.go(-2);</script>';
				}else{
					//登录失败
					echo '<script>alert("不好意思，用户名或者密码错误，请重新输入");location="./index.php?m=logreg&a=login"</script>';
				}
			}else{
				//验证码不一致
				echo '<script>alert("验证码错误，眼瞎啊?看不见啊?这么大个图");location="./index.php?m=logreg&a=login"</script>';
			}
		}
		//首页注册操作
		function reg(){
			include './view/reg.html';
		}
		//执行注册操作、
		function do_reg(){
			session_start();
			//实例化model类
			$m = new Model('user');
			//将session的验证码转小写
			$ycode = strtolower($_SESSION['code']);
			//将用户输入的验证码转小写
			$ncode = strtolower($_POST['code']);
			// 判断验证码是否一致
			if ($ycode == $ncode) {
				//验证码一致，判断用户账号密码是否一致
				$cx = $m->where("username='{$_POST['username']}'")->select();
				//创建验证方法
				$yz = new YanZheng;
				//验证用户名是否符合要求
				//定义要求
				$pattern = '/^[a-zA-Z]{5,13}$/';
				//1.2判断
				if(!$yz->userPattern($pattern,$_POST['username'])){
					echo '<script>alert("用户名不合法");location="./index.php?m=logreg&a=reg"</script>';
					die();
				}
				//验证密码是否一致
				if (!$yz->repwd($_POST['pwd'],$_POST['repwd'])) {
					echo '<script>alert("两次密码不一致");location="./index.php?m=logreg&a=reg"</script>';
						die();
				}else{
					$_POST['pwd'] = md5($_POST['pwd']);
				}
				//如果存在则跳回去重新输入
				if ($cx) {
					echo '<script>alert("用户名重复,请重新输入");location="./index.php?m=logreg&a=reg"</script>';
						die();
				}
				// var_dump($_POST);
				$_POST['addtime'] = time();
				$result = $m->insert($_POST);
				if ($result) {
					$_SESSION['suser']['islogin'] = true;
					$_SESSION['suser']['username'] = $_POST['username'];
					$_SESSION['suser']['state'] = 1;
					$_SESSION['suser']['id'] = $result;
					echo '<script>alert("注册成功");location="./index.php?m=index&a=show";</script>';
				}else{
					//登录失败
					echo '<script>alert("注册失败，请重新注册");location="./index.php?m=logreg&a=login"</script>';
				}
			}else{
				//验证码不一致
				echo '<script>alert("验证码错误，眼瞎啊?看不见啊?这么大个图");location="./index.php?m=logreg&a=reg"</script>';
			}
		}
		//首页退出操作
		function logout(){
			session_start();
			// var_dump($_SESSION);
			// exit;
			// //退出登录操作
			//1.使客户端COOKIE过期，让SESSIONID失效
			setcookie(session_name(),'',time()-1,'/');
			//2.清除当前页面SESSION数组中的值
			unset($_SESSION['suser']);
			//3.摧毁服务器的session文件
			
			session_destroy();
			echo '<script>location="./index.php?m=index&a=show"</script>';
			// header('location:index.php?m=login&a=login');
		}
}