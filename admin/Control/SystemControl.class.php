<?php
	class SystemControl{
		//系统设置
		function set(){
			//指定system表里面的一条数据作为系统设置
			//每次修改就改这条数据
			$m = new Model('system');
			$result = $m->where('id=1')->find();
			
				//echo '修改';
				//做修改时头像显示
			$huandeng = '<img src="../public/upload/sys/'.$result['huandeng'].'" width="100" />';
			$hengfu = '<img src="../public/upload/sys/'.$result['hengfu'].'" width="100" />';
			$yhimg = '<input type="hidden" name="yhuandeng" value="'.$result['huandeng'].'">';
			$yfimg = '<input type="hidden" name="yhengfu" value="'.$result['hengfu'].'">';
			include './view/system.html';
		}
		//修改系统设置的方法
		function updatesys(){
			// var_dump($_POST);
			var_dump($_FILES);
			//1.获取要修改系统信息
			//2.判断是否需要修改幻灯
			$huandeng = false;
			if(!empty($_FILES['huandeng']['name'])){
				//修改图像
				$up = new Upload('huandeng','../public/upload/sys');
				$res = $up->do_upload();
				if(is_array($res)){
					//拼接图片新名称
					$_POST['huandeng'] = $res['name'];
					$huandeng = true;
				}else{
					//图片名称没有更改
					$_POST['huandeng'] = $_POST['yhuandeng'];
				}
			}else{
				//图片名称没有更改
				$_POST['huandeng'] = $_POST['yhuandeng'];
			}
			// exit;
			//判断是否需要修横幅
			$hengfu = false;
			if(!empty($_FILES['hengfu']['name'])){
				//修改图像
				$up = new Upload('hengfu','../public/upload/sys');
				$ress = $up->do_upload();
				if(is_array($res)){
					//拼接图片新名称
					$_POST['hengfu'] = $ress['name'];
					$hengfu = true;
				}else{
					//图片名称没有更改
					$_POST['hengfu'] = $_POST['yhengfu'];
				}
			}else{
				//图片名称没有更改
				$_POST['hengfu'] = $_POST['yhengfu'];
			}

			//4.进行数据修改
			$m = new Model('system');
			$r = $m->where('id=1')->update($_POST);
			//5.删除原有图像
			if($huandeng == true){
				if ($_POST['yhuandeng'] != 'moren.jpg') {
					unlink('../public/upload/sys/'.$_POST['yhuandeng']);
				}
				
			}
			if($hengfu == true){
				if ($_POST['yhengfu'] != 'moren.jpg') {
					unlink('../public/upload/sys/'.$_POST['yhengfu']);
				}
				
			}
			// var_dump($_POST);
			// echo $m->sql;
			// exit;
			//6.如果成功则返回 (切记 带回数据的id 和 username)
			// echo $m->sql;
			// exit;
			if($r){
				echo '<script>alert("修改成功");location="./index.php?m=system&a=set&id=1"</script>';
			}else{
				echo '<script>alert("修改失败");location="./index.php?m=system&a=set&id=1"</script>';
				unlink('../public/upload/sys/'.$res['name']);
				unlink('../public/upload/sys/'.$ress['name']);
			}
		}
	}