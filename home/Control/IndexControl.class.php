<?php
	class IndexControl{
		//默认显示后台首页
		function show(){
			session_start();
			//遍历商品展示
			try{
				//链接数据库
				$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
				$pdo  = new PDO($dsn,DB_USER,DB_PWD);
				//设置报错模式（有错误 抛出错误到catch中）/
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$pdo->exec('SET NAMES '.CHARSET);
				//var_dump($_GET);
				//查询分类部分
				//准备预处理对象
				
				//查询横幅与幻灯片
				$hd = "SELECT * FROM ".DB_PREFIX." system WHERE id=1";
				//echo $sql;
				$stmt_hd = $pdo->prepare($hd);
				//发送
				$stmt_hd->execute();
				//获取数据
				$hd = $stmt_hd->fetchAll(PDO::FETCH_ASSOC);
				// var_dump($hd);

				//查询顶级分类
				$typetop = "SELECT * FROM ".DB_PREFIX." type ORDER BY CONCAT(path,id) ASC";
				//echo $sql;
				$stmt_type = $pdo->prepare($typetop);
				//发送
				$stmt_type->execute();
				//获取数据
				$typetop = $stmt_type->fetchAll(PDO::FETCH_ASSOC);


				//查询子级
				$typeson = "SELECT * FROM ".DB_PREFIX." type WHERE pid!=0 ORDER BY CONCAT(path,id) ASC	 limit 8";
				//echo $sql;
				$stmt_type_son = $pdo->prepare($typeson);
				//发送
				$stmt_type_son->execute();
				//获取数据
				$typeson = $stmt_type_son->fetchAll(PDO::FETCH_ASSOC);
				// var_dump($types);
				

				//查询商品部分
				//没有传入查询条件 查询所有
				$sql = "SELECT * FROM ".DB_PREFIX.'goods WHERE state!=:state';
				$stmt = $pdo->prepare($sql);
				$state = 2;
				$stmt->bindParam(':state',$state,PDO::PARAM_INT);
				$stmt->execute();
				//获取查询到的所有数据
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


				//查询顶级下面所有
				$sqlx = "SELECT * FROM ".DB_PREFIX.'goods WHERE state!=:state AND (typeid IN(SELECT id FROM type WHERE pid=:id) or typeid=:id)';
					$stmtx = $pdo->prepare($sqlx);
					$stmtx->bindParam(':id',$_GET['id'],PDO::PARAM_INT);

				// var_dump($result);
			}catch(PDOExcaption $e){
				$error = $e->getMessage();
				file_put_contents('./include/error/error.log',$error);
			}
			include './view/header.html';
			include './view/index.html';
			include './view/footer.html';
		}
		//搜索功能
		function search(){
			session_start();
			// var_dump($_POST);
			$m = new Model('goods');
			$result = $m->where("name like '%".$_POST['name'].'%'."'")->select();
			// echo $m->sql;
			// var_dump($result);
			include './view/search.html';
			include './view/footer.html';
		}
	}