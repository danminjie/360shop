<?php
	class IndexControl{
		//默认显示后台首页
		function show(){
			session_start();
			// echo session_id();
			// var_dump($_SESSION);
			//var_dump($_COOKIE);
			//不是所有人 都可以过来的。
			//1.需要判断是否登录 如果没有登录则无权看本页面
			// var_dump($_POST);
			// 2.需要使用会话  COOKIE
			if(isset($_SESSION['user']['islogin']) && $_SESSION['user']['islogin'] == true && $_SESSION['user']['state'] == 3){
				include './View/main.html';
			}else{
				//没权利访问
				echo '<script>location="./index.php?m=login&a=login"</script>';
			}
			// include './View/main.html';
		}
		//后台首页信息显示
		function index(){
			session_start();
			//获取上次登录时间
			//获取最后一次登录的日志
			$m = new Model('loginlog');
			$username = $_SESSION['user']['username'];
			$result = $m->where("username='".$username."'")->order(' logintime DESC')->limit(1)->select();
			// var_dump($m->sql);
			// var_dump($result);
			// 获取系统设置中的公告信息
			$m1 = new Model('system');
			$res = $m1->where('id=1')->find();
			// var_dump($res);
			include './view/index.html';
		}
		//加载后台top页面
		function top(){
			include './view/top.php';
		}
	}