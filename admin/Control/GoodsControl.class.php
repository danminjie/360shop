<?php
	//商品模块
	class GoodsControl{
		function do_goods_update(){
			// var_dump($_POST);
			// var_dump($_FILES);
			// exit;
			//1.获取要修改的会员详细信息
			//2.判断是否需要修改会员图像
			$bool = false;
			if(!empty($_FILES['pic']['name'])){
				//修改图像
				$up = new Upload('pic','../public/upload/goods');
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
			// var_dump($_POST);
			// exit;
			//3.处理数据
			//4.进行数据修改
			$m = new Model('goods');
			// var_dump($_POST);

			$r = $m->where('id='.$_POST['gid'])->update($_POST);
			// echo $m->sql;exit;
			//5.删除原有图像
			if($bool == true){
				if ($_POST['ypic'] != 'moren.jpg') {
					if (file_exists('../public/upload/goods/'.$_POST['ypic'])) {
						unlink('../public/upload/goods/'.$_POST['ypic']);
					}
					
				}
				
			}
			// echo $m->sql;
			// exit;
			//6.如果成功则返回 (切记 带回数据的id 和 username)
			if($r){
				echo '<script>alert("修改成功");location="./index.php?m=goods&a=goods_info&id='.$_POST['gid'].'"</script>';
			}else{
				echo '<script>alert("修改失败");location="./index.php?m=goods&a=goods_info&id='.$_POST['gid'].'"</script>';
			}
		}
		//编辑商品
		function goods_info(){
			$up = $down = $new = '';
			$m1 = new Model('type');
			$lei = $m1->order('CONCAT(path,id) ASC')->select();
			$t = new Cattree($lei);
			$res = $t->getTree();
			//调用方法查询是否有值
			if (!empty($_GET['id'])) {
				$result = $this->selectUser_info();
				// var_dump($result);
				if($result){
						//定义显示变量
						$goods_info_str = '修改商品';
						$method = 'do_goods_update';
						$img = '<img src="../public/upload/goods/'.$result['pic'].'" width="100" />';
						$yimg = '<input type="hidden" name="ypic" value="'.$result['pic'].'">';
				}

				//判断商品状态
				switch($result['state']){
					case 1:
						$up = 'selected';
						break;
					case 2:
						$down = 'selected';
						break;
					default:
						$new = 'selected';
				}	
			}else{
				$goods_info_str = '添加商品';
				$method = 'do_add';
				$img = '';
				$yimg = '';
			}
			

			
			// var_dump($goods_info_str);
			include './View/goods_info.html';
		}
		//私有方法查询单条数据
		private function selectUser_info(){
			//实例化数据库对象
			$m = new Model('goods');
			return $m->where('id='.$_GET['id'])->find();
			//var_dump($result);
		}
		function huishou(){
			$m = new Model('goods');
			if(isset($_GET['biaoshi']) && $_GET['biaoshi'] == 'h'){
				//后期需要加入条件
				// echo 66666;
				// die();
				$search = $this->searchUser(1);
			}else{
				$search = ' huishou = 1 ';
			}
			$order = '';
			//做一个点击 点击一次从低到高 在点击一次 从高到底
			if(isset($_GET['biaozhi']) && $_GET['biaozhi'] == 'c'){
				$num = 1;
				//判断做计数的文件是否存在
				if(file_exists('./include/huishou.txt')){
					$num = file_get_contents('./include/huishou.txt');
				}else{
					file_put_contents('./include/huishou.txt',$num);
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
				file_put_contents('./include/huishou.txt',$num);
			}
			$p = new Page($m->where($search)->total(),8);
			// echo $p->limit();
			$result = $m->where($search)->order($order)->limit($p->limit())->select();
			$result = $m->where($search)->order($order)->limit($p->limit())->select();
			// echo $m->sql;
			include './View/goods_huishou.html';
		}
		//上架
		function up(){
			$m = new Model('goods');
			
			$_POST['state'] = 1;
			// var_dump($_GET['id']);
			// var_dump($_POST);
			if($m->where('id='.$_GET['id'])->update($_POST)){
				echo '<script>alert("上架成功");location="./index.php?m=goods&a=show"</script>';
			}else{
				echo '<script>alert("上架失败，我也不知道为啥");location="./index.php?m=goods&a=show"</script>';
			}
		}
		//下架
		function down(){
			$m = new Model('goods');
			
			$_POST['state'] = 2;
			// var_dump($_GET['id']);
			// var_dump($_POST);
			if($m->where('id='.$_GET['id'])->update($_POST)){
				echo '<script>alert("下架成功");location="./index.php?m=goods&a=show"</script>';
			}else{
				echo '<script>alert("下架失败，我也不知道为啥");location="./index.php?m=goods&a=show"</script>';
			}
		}
		//加入回收站
		function in_huishou(){
			$m = new Model('goods');
			
			$_POST['huishou'] = 1;
			// var_dump($_GET['id']);
			// var_dump($_POST);
			if($m->where('id='.$_GET['id'])->update($_POST)){
				echo '<script>alert("移入成功");location="./index.php?m=goods&a=huishou"</script>';
			}else{
				echo '<script>alert("移入失败，我也不知道为啥");location="./index.php?m=goods&a=show"</script>';
			}
		}
		//移出回收站
		function out_huishou(){
			$m = new Model('goods');
			
			$_POST['huishou'] = 0;
			// var_dump($_GET['id']);
			// var_dump($_POST);
			if($m->where('id='.$_GET['id'])->update($_POST)){
				echo '<script>alert("移出成功");location="./index.php?m=goods&a=show"</script>';
			}else{
				echo '<script>alert("移出失败，我也不知道为啥");location="./index.php?m=goods&a=huishou"</script>';
			}
		}
		//显示商品
		function show(){
			if(isset($_GET['biaoshi']) && $_GET['biaoshi'] == 's'){
				//后期需要加入条件
				$search = $this->searchUser();
			}else{
				$search = ' huishou = 0 ';
			}
			//查看是否按照点击量排序
			if(isset($_GET['biaozhi']) && $_GET['biaozhi'] == 'a'){
				//需要按照点击量从低到高排序
				$order = 'clicknum ASC';
			}elseif(isset($_GET['biaozhi']) && $_GET['biaozhi'] == 'b'){
				//需要按照点击量从低到高排序
				$order = 'clicknum DESC';
			}else{
				$order = 'id DESC';
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
			// $result = $m->field('goods.id','goods.name','goods.pic','goods.price','goods.store','goods.state','goods.addtime','type.name AS tname')->where('goods.typeid=type.id')->order($order)->r_select('goods','type');
			$p = new Page($m->where($search)->total(),8);
			$result = $m->where($search)->order($order)->limit($p->limit())->select();
			$m1 = new Model('type');
			$lei = $m1->order('CONCAT(path,id) ASC')->select();
			$t = new Cattree($lei);
			$res = $t->getTree();
			// var_dump($res);
			// echo $m->sql;
			// var_dump($result);
			// 商品类别
			//定义商品状态数组
			$state = array('新添加','<font color="green">在售</font>','<font color="red">下架</font>');
			//echo $m->sql;
			include './view/goods_list.html';
		}
		protected function searchUser($where=0){
			// var_dump($_GET);
			//帮忙拼接条件语句username like %da% AND state  = 0
			//定义一个所有搜索条件的数组变量
			$wherelist = array();
			if(!empty($_GET['name'])){
				$wherelist[] = "name LIKE '%{$_GET['name']}%'";
			}
			//判断是否选择权限
			if(isset($_GET['state']) && $_GET['state'] != 'xz'){
				$wherelist[] = " state = ".$_GET['state'];
			}
			//判断性别搜索
			if(isset($_GET['typeid']) && $_GET['typeid'] != 'xz'){
				//在附表
				$wherelist[] = "typeid = ".$_GET['typeid'];
			}
			//判断价格区间
			if(!empty($_GET['jgmin']) && !empty($_GET['jgmax']) && $_GET['jgmin'] < $_GET['jgmax']){
				$wherelist[] = " price BETWEEN {$_GET['jgmin']} AND {$_GET['jgmax']} ";
			}
			if ($where == 1) {
				$wherelist[] = " huishou = 1 ";
			}else{
				$wherelist[] = " huishou = 0 ";
			}
			
			//拼接条件
			if(count($wherelist) > 0){
				return implode(' AND ',$wherelist);
			}else{
				return '';
			}
			// echo $re;
			// var_dump($wherelist);
		}
		// //添加商品
		// function add(){
		// 	//修改和添加都执行到该页面(goods_info.html)
		// 	//获取商品类别
		// 	$m = new Model('type');
		// 	$result = $m->order('CONCAT(path,id) ASC')->select();
		// 	$t = new Cattree($result);
		// 	$res = $t->getTree();
		// 	// var_dump($result);
		// 	include './view/goods_info.html';
		// }
		//执行添加
		function do_add(){
			// var_dump($_POST);
			//判断是否选择商品类别
			if($_POST['typeid'] == 'xz'){
				echo '<script>alert("请选择商品分类");location="./index.php?m=goods&a=goods_info"</script>';
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
				echo '<script>alert("'.$result.'");location="./index.php?m=goods&a=goods_info"</script>';
				die();
			}

			//链接数据库 执行添加商品
			$m = new Model('goods');
			//获取当前时间
			$_POST['addtime'] = time();
			// var_dump($_POST);
			if($m->insert($_POST)){
				echo '<script>alert("添加成功");location="./index.php?m=goods&a=show"</script>';
			}else{
				//echo $m->sql;
				//如果添加失败，删除上传成功的图片
				unlink($result['pathinfo']);
				echo '<script>alert("添加失败");location="./index.php?m=goods&a=goods_info"</script>';
			}
		}
		//删除商品
		function del(){
			//删除商品得把图片删掉
			//查图片名称
			$m1 = new Model('goods');
			$re = $m1 -> where('id='.$_GET['id'])->find();
			if($re){
				$path = '../public/upload/goods/'.$re['pic'];
				//删除图片
				unlink($path);
			}
			//删除商品
			$m = new Model('goods');
			if($m->where('id='.$_GET['id'])->delete()){
				echo '<script>alert("删除成功");location="./index.php?m=goods&a=huishou"</script>';
			}else{
				echo '<script>alert("删除成功");location="./index.php?m=goods&a=huishou"</script>';
			}
		}

	}