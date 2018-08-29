<?php
	class CartControl{
		//添加购物车
		function addCart(){
			session_start();
			//将当前商品添加到session中(session就是我们的购物车)
			if(isset($_GET['id'])){
				//查询指定的商品
				try{
					$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
					$pdo = new PDO($dsn,DB_USER,DB_PWD);
					$pdo->exec('SET NAMES utf8');
					//准备查询执行商品的SQL语句
					$sql = "SELECT * FROM ".DB_PREFIX."goods WHERE id=?";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(1,$_GET['id'],PDO::PARAM_INT);
					$stmt->execute();
					//获取查询到的数据
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					//var_dump($row);
					//修改购买数量
					$row['num'] = 1;

					//var_dump($_SESSION);
					if(isset($_SESSION['cart'][$row['id']])){
						//修改数量
						$_SESSION['cart'][$row['id']]['num'] += 1;
					}else{
						//将当前得到的商品数据放入到session中保存
						$_SESSION['cart'][$row['id']] = $row;
					}
					// unset($_SESSION['cart'][3]);
					// var_dump($_SESSION);
					include './view/Cart.html';

				}catch(PDOException $e){
					$e->getMessage();
				}
			}
		}
		//查看购物车
		function show(){
			session_start();
			// var_dump($_SESSION);
			//调用公共的头
			//查看购物车
			include './view/Cart.html';
		}
		//修改购物车
		function  updateCart(){
			session_start();
			if(isset($_GET['id']) && isset($_GET['num'])){
				$_SESSION['cart'][$_GET['id']]['num'] += $_GET['num'];
				//验证最小值
				if($_SESSION['cart'][$_GET['id']]['num'] <= 1){
					$_SESSION['cart'][$_GET['id']]['num'] = 1;
				}
			}
			header('location:./index.php?m=cart&a=show');
		}
		//删除购车
		function  delCart(){
			session_start();
			if(isset($_GET['id'])){
				//删除商品
				unset($_SESSION['cart'][$_GET['id']]);
				echo '<script>alert("删除成功");location="./index.php?m=cart&a=show"</script>';
			}else{
				//清空购物车
				$_SESSION['cart'] = array();
				echo '<script>alert("清空成功");location="./index.php?m=cart&a=show"</script>';
			}
			
		}
	}