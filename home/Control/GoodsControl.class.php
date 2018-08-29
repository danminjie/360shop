<?php
	//商品模块
	class GoodsControl{
		//显示商品
		function show(){
			//查看是否按照点击量排序
			if(isset($_GET['biaozhi']) && $_GET['biaozhi'] == 'a'){
				//需要按照点击量从低到高排序
				$order = 'clicknum ASC';
			}elseif(isset($_GET['biaozhi']) && $_GET['biaozhi'] == 'b'){
				//需要按照点击量从低到高排序
				$order = 'clicknum DESC';
			}else{
				$order = '';
			}
			//做一个点击 点击一次从低到高 在点击一次 从高到底
			if(isset($_GET['biaozhi']) && $_GET['biaozhi'] == 'c'){
				$num = 1;
				//判断做计数的文件是否存在
				if(file_exists('./include/num.txt')){
					$num = file_get_contents('./include/num.txt');
				}else{
					file_put_contents('./include/num.txt',$num);
				}
				//判断$num 是奇数还是偶数
				if($num % 2 == 0){
					$order = 'clicknum ASC';
				}else{
					$order = 'clicknum DESC';
				}
				//改变$num
				$num ++;
				//将$num 在写会文件做保存
				file_put_contents('./include/num.txt',$num);
			}

			//查询商品
			$m = new Model('goods');
			$result = $m->field('goods.id','goods.name','goods.pic','goods.price','goods.store','goods.state','goods.addtime','type.name AS tname')->where('goods.typeid=type.id')->order($order)->r_select('goods','type');
			//var_dump($result);
			//定义商品状态数组
			$state = array('新添加','<font color="green">在售</font>','<font color="red">下架</font>');
			//echo $m->sql;
			include './view/goods/goods_list.html';
		}
		//添加商品
		function add(){
			//修改和添加都执行到该页面(goods_info.html)
			//获取商品类别
			$m = new Model('type');
			$result = $m->order('CONCAT(path,id) ASC')->select();
			include './view/goods/goods_info.html';
		}
		//执行添加
		function do_add(){
			var_dump($_POST);
			//判断是否选择商品类别
			if($_POST['typeid'] == 'xz'){
				echo '<script>alert("请选择商品分类");location="./view/goods/goods_info.html"</script>';
				die();
			}
			//var_dump($_FILES);
			//执行文件上传
			$upload = new Upload('pic','../public/upload/goods',5000000);
			$result = $upload->do_upload();
			//var_dump($result);
			if(is_array($result)){
				$_POST['pic'] = $result['name'];
			}else{
				echo '<script>alert("'.$result.'");location="./view/goods/goods_info.html"</script>';
				die();
			}

			//链接数据库 执行添加商品
			$m = new Model('goods');
			//获取当前时间
			$_POST['addtime'] = time();
			if($m->insert($_POST)){
				echo '<script>alert("添加商品成功");location="./view/goods/goods_list.html"</script>';
			}else{
				//echo $m->sql;
				//如果添加失败，删除上传成功的图片
				unlink($result['pathinfo']);
				echo '<script>alert("添加失败");location="./view/goods/goods_info.html"</script>';
			}
		}

	}