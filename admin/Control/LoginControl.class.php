<?php
	class LoginControl{
		//默认显示后台登录页
		function login(){
			include './View/login.html';
		}

		//处理登录
		function do_login(){
			session_start();
			// var_dump($_SESSION['code']);
			// var_dump($_POST);
			$m = new Model('user');
			// SELECT * FROM user WHERE username = '{$_POST['username']}' && pwd=md5({$_POST['pwd']}) 
			$pwd = md5($_POST['pwd']);
			$ycode = strtolower($_SESSION['code']);
			$ncode = strtolower($_POST['code']);
			// echo $m->sql;
			if ($ycode == $ncode) {
				if ($m -> where(" username = '{$_POST['username']}' AND pwd = '$pwd' AND state = 3 ")->select()) {
					$_SESSION['user']['islogin'] = true;
					$_SESSION['user']['username'] = $_POST['username'];
					$_SESSION['user']['state'] = 3;
					$log = new Model('loginlog');

					$loginlog = array(
								'username' => $_SESSION['user']['username'],
								'logintime' => time(),
								'ip' => $_SERVER['REMOTE_ADDR']
						);
					$log->insert($loginlog);
					echo '<script>alert("登录成功");location="./index.php?m=index&a=show"</script>';
				}else{
					echo '<script>alert("用户名或密码错误，请重新登录，谢谢配合");location="./index.php?m=login&a=login"</script>';
				}
			}else{
				echo '<script>alert("验证码错误，眼瞎啊?看不见啊?这么大个图");location="./index.php?m=login&a=login"</script>';
			}
			
			
		}
		//退出登录
		function logout(){
			session_start();
			// var_dump($_SESSION);
			// //退出登录操作
			// echo session_name();
			// 退出操作
			//1.使客户端COOKIE过期，让SESSIONID失效
			setcookie(session_name(),'',time()-1,'/');
			//2.清除当前页面SESSION数组中的值
			unset($_SESSION['user']);
			//3.摧毁服务器的session文件
			session_destroy();
			echo '<script>parent.location.reload();</script>';
			// header('location:index.php?m=login&a=login');
		}

		//登录日志管理
		function login_log(){
			$m = new Model('loginlog');
			$p = new Page($m->where()->total(),8);
			// echo $p->limit();
			$result = $m->where()->order('id DESC ')->limit($p->limit())->select();
			include './view/login_log.html';
		}
		//删除登录日志
		function log_del(){
			$m = new Model('loginlog');
			if ($m->where('id='.$_GET['id'])->delete()) {
				echo '<script>alert("删除成功，后悔别找我！！！！");location="./index.php?m=login&a=login_log"</script>';
			}else{
				echo '<script>alert("删除失败");location="./index.php?m=login&a=login_log"</script>';
			}
		}
	}