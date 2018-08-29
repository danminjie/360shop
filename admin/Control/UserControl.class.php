<?php
	//会员类
	class UserControl{
		function huishou(){
			$m = new Model('user');
			if(isset($_GET['biaoshi']) && $_GET['biaoshi'] == 'h'){
				//后期需要加入条件
				// echo 66666;
				// die();
				$search = $this->searchUser(1);
			}else{
				$search = ' huishou = 1 ';
			}
			$p = new Page($m->where($search)->total(),8);
			// echo $p->limit();
			$result = $m->where($search)->limit($p->limit())->select();
			// echo $m->sql;
			include './View/user_huishou.html';
		}
		//加入回收站
		function in_huishou(){
			$m = new Model('user');
			//自制参数，让huishou字段 =1
			$_POST['huishou'] = 1;
			//判断是否加入成功
			if($m->where('id='.$_GET['id'])->update($_POST)){
				echo '<script>alert("移入成功");location="./index.php?m=user&a=huishou"</script>';
			}else{
				echo '<script>alert("移入失败，我也不知道为啥");location="./index.php?m=user&a=huishou"</script>';
			}
		}
		//移出回收站
		function out_huishou(){
			$m = new Model('user');
			//自制参数，让huishou字段 =0
			$_POST['huishou'] = 0;
			// var_dump($_GET['id']);
			// var_dump($_POST);
			// 判断是否移出成功
			if($m->where('id='.$_GET['id'])->update($_POST)){
				echo '<script>alert("移出成功");location="./index.php?m=user&a=show"</script>';
			}else{
				echo '<script>alert("移出失败，我也不知道为啥");location="./index.php?m=user&a=huishou"</script>';
			}
		}
		//删除会员方法
		function del(){
			//附表中有图片
			//查询附表图片名称
			$m1 = new Model('user_info');
			$re = $m1 -> where('uid='.$_GET['id'])->find();
			if($re){
				$path = '../public/upload/pic/'.$re['pic'];
				//echo $path;
				//删除图片
				unlink($path);
				//先删除附表
				$m1->where('uid='.$_GET['id'])->delete();
			}
			//删除主表
			
			$m = new Model('user');
			//删除u会员
			if($m->where('id='.$_GET['id'])->delete()){
				if ($_GET['biaoshi'] == 'huishou') {
					//如果从回收站删除跳转到回收站
					echo '<script>alert("删除成功");location="./index.php?m=user&a=huishou"</script>';
				}else{
					echo '<script>alert("删除成功");location="./index.php?m=user&a=show"</script>';
				}
				
			}else{
				if ($_GET['biaoshi'] == 'huishou') {
					//如果从回收站删除跳转到回收站
					echo '<script>alert("删除成功");location="./index.php?m=user&a=huishou"</script>';
				}else{
					echo '<script>alert("删除失败");location="./index.php?m=user&a=show"</script>';
				}
				
			}
		}
		//编辑会员的方法
		function update(){
			$m = new Model('user');
			//先查询会员信息默认显示
			$result = $m->where('id='.$_GET['id'])->find();
			//var_dump($result);
			//判断下权限
			$xz = $pu = $vip = $jin = $chao = '';
			switch($result['state']){
				case 0;
					$pu = 'selected';
					break;
				case 1:
					$vip = 'selected';
					break;
				case 2:
					$jin = 'selected';
					break;
				case 3:
					$chao = 'selected';
					break;
				default:
					$xz = 'selected';
			}
			include './View/user_update.html';
		}
		function do_update(){
			//1.验证用户名
				$yz = new YanZheng;
				//1.验证用户名是否符合要求
				//1.1定义要求
				$pattern = '/^[a-zA-Z]{5,13}$/';
				//1.2判断
				if(!$yz->userPattern($pattern,$_POST['username'])){
					echo '<script>alert("用户名不合法");location="./index.php?m=user&a=add&id='.$_POST['id'].'"</script>';
					die();
				}
			//2.验证密码是否一致
				if(!empty($_POST['pwd']) && !empty($_POST['repwd'])){
					//用户需要更改密码
					if(!$yz->repwd($_POST['pwd'],$_POST['repwd'])){
					echo '<script>alert("两次密码不一致");location="./index.php?m=user&a=add&id='.$_POST['id'].'"</script>';
					die();
					}else{
						//加密密码
						$_POST['pwd'] = md5($_POST['pwd']);
					}
				}else{
					//用户不需要更改密码
					unset($_POST['pwd']);
					unset($_POST['repwd']);

				}
			//var_dump($_POST);

			//3.判断是否选择权限
			if($_POST['state'] == 'xz'){
				echo '<script>alert("请选择会员权限");location="./index.php?m=user&a=add"</script>';
				die();
			}
			$m = new Model('user');
			//执行修改判断是否成功
			if($m->where('id='.$_POST['id'])->update($_POST)){
				echo '<script>alert("修改成功");location="./index.php?m=user&a=show"</script>';
				//echo '<script>alert("修改成功");location="./index.php?m=user&a=update&id='.$_POST['id'].'"</script>';
			}else{
				echo '<script>alert("修改失败");location="./index.php?m=user&a=update&id='.$_POST['id'].'"</script>';
			}
		}
		protected function searchUser($where=0){
			// var_dump($_GET);
			//帮忙拼接条件语句username like %da% AND state  = 0
			//定义一个所有搜索条件的数组变量
			$wherelist = array();
			if(!empty($_GET['username'])){
				$wherelist[] = "username LIKE '%{$_GET['username']}%'";
			}
			//判断是否选择权限
			if(isset($_GET['state']) && $_GET['state'] != 'xz'){
				$wherelist[] = " state = ".$_GET['state'];
			}
			//判断性别搜索
			if(isset($_GET['sex']) && $_GET['sex'] != 'bxz'){
				//在附表
				$wherelist[] = "id IN(SELECT uid FROM user_info WHERE sex={$_GET['sex']})";
			}
			//判断年龄区间
			if(!empty($_GET['age1']) && !empty($_GET['age2']) && $_GET['age1'] < $_GET['age2']){
				$wherelist[] = "id IN(SELECT uid FROM user_info WHERE age BETWEEN {$_GET['age1']} AND {$_GET['age2']})";
			}
			//判断是否在回收站执行搜索
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
		//显示会员
		function show(){
			$m = new Model('user');
			//查询是否加入标识
			if(isset($_GET['biaoshi']) && $_GET['biaoshi'] == 's'){
				//后期需要加入条件
				$search = $this->searchUser();
			}else{
				$search = ' huishou = 0 ';
			}
			// var_dump($search);
			//加入分页样式
			//获得总条数
			$p = new Page($m->where($search)->total(),8);
			// echo $p->limit();
			$result = $m->where($search)->order(' id DESC ')->limit($p->limit())->select();
			// echo $m->sql;
			include './View/right.html';
		}
		//添加会员
		function add(){
			//echo '添加会员	';
			//new数据库对象
			include './View/form.html';
		}
		//执行会员添加方法
		function do_add(){
			// var_dump($_POST);
			// echo $_POST['username'];
			//创建验证方法
			$yz = new YanZheng;
			//验证用户名是否符合要求
			//定义要求
			$pattern = '/^[a-zA-Z]{5,13}$/';
			//1.2判断加验证
			if(!$yz->userPattern($pattern,$_POST['username'])){
				echo '<script>alert("用户名不合法");location="./index.php?m=user&a=add"</script>';
				die();
			}
			//验证密码是否一致
			if (!$yz->repwd($_POST['pwd'],$_POST['repwd'])) {
				echo '<script>alert("两次密码不一致");location="./index.php?m=user&a=add"</script>';
					die();
			}else{
				$_POST['pwd'] = md5($_POST['pwd']);
			}
			//判断是否选择权限
			if ($_POST['state'] == 'xz') {
				echo '<script>alert("请选择会员权限");location="./index.php?m=user&a=add"</script>';
					die();
			}
			//调用数据库操作文件
			$m = new Model('user');
			//查询添加的用户名是否在数据库存在
			$cx = $m->where("username='{$_POST['username']}'")->select();
			// $m->sql;
			// var_dump($cx);
			// exit;
			//如果存在则跳回去重新输入
			if ($cx) {
				echo '<script>alert("用户名重复,请重新输入");location="./index.php?m=user&a=add"</script>';
					die();
			}

			
			//执行添加数据库
			//把添加时间获取当前时间戳
			$_POST['addtime'] = time();
			//判断是否添加成功
			if($m->insert($_POST)){
				echo '<script>alert("添加[ '.$_POST['username'].' ]会员成功");location="./index.php?m=user&a=show"</script>';
			}else{
				echo '<script>alert("添加[ '.$_POST['username'].' ]会员失败!");location="./index.php?m=user&a=add"</script>';
			}
			
			//返回结果
		}
		//会员详细信息处理方法
		function user_info(){
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
				$user_info_str = '修改会员详细信息';
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
				$user_info_str = '添加会员详细信息';
				$method = 'do_user_add';
				$img = '';
				$yimg = '';
			}
			//定义一个爱好数组
			$hobby = array('电影','电脑','写代码','学习','苍老师','武藤兰','小泽玛利亚');
			//查询会员行业表数据库 查询行业
			$m = new Model('user_hangye');
			$hangye = $m->select();
			//var_dump($hangye);
			//echo '查看会员详细信息';
			include './View/user_info.html';
		}
		//修改会员详细信息方法
		function do_user_update(){
			//var_dump($_POST);
			//var_dump($_FILES);
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
				echo '<script>alert("修改成功");location="./index.php?m=user&a=user_info&id='.$_POST['uid'].'&username='.$_POST['username'].'"</script>';
			}else{
				echo '<script>alert("修改失败");location="./index.php?m=user&a=user_info&id='.$_POST['uid'].'&username='.$_POST['username'].'"</script>';
			}
		}
		//私有方法赋值查询会员详细信息
		private function selectUser_info(){
			//实例化数据库对象
			$m = new Model('user_info');
			//根据条件查找单条数据
			return $m->where('uid='.$_GET['id'])->find();
			//var_dump($result);
		}
		//执行添加会员详情信息方法
		function do_user_add(){
			
			// die();
			// var_dump($_FILES);
			//1.进行图片上传
			$up = new Upload('pic','../public/upload/pic');
			$res = $up ->do_upload();
			//判断是否添加成功
			if(is_array($res)){
				$_POST['pic'] = $res['name'];
			}else{
				//var_dump($_GET);
				//echo $res;
				echo '<script>alert("'.$res.'");location="./index.php?m=user&a=user_info&id='.$_POST['uid'].'&username='.$_POST['username'].'"</script>';
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
			//执行添加操作并判断结果
			if($m->insert($_POST)){
				echo '<script>alert("添加成功");location="./index.php?m=user&a=user_info&id='.$_POST['uid'].'&username='.$_POST['username'].'"</script>';
			}else{
				echo '<script>alert("添加失败");location="./index.php?m=user&a=user_info&id='.$_POST['uid'].'&username='.$_POST['username'].'"</script>';
			}
		}
		//显示添加行业信息
		function user_info_hangye(){
			//实例化行业表
			$m = new Model('user_hangye');
			//判断是否有提交数据
			if(!empty($_POST['hname'])){
				//执行添加

				if($m->insert($_POST)){
					echo '<script>alert("添加成功");</script>';
				}else{
					echo '<script>alert("添加失败");</script>';
				}
			}
			//添加分页效果
			$p = new Page($m->total(),5);
			//查询数据 遍历结果
			$result = $m->limit($p->limit())->select();
			//echo '添加行业';
			include './View/user_info_hangye.html';
			//var_dump($_POST);

		}
		//修改行业
		function user_info_hangye_update(){
			//实例化行业表
			$m = new Model('user_hangye');
			//根据传入id查询指定数据
			$result = $m->where('hid='.$_GET['id'])->find();
			// var_dump($result);
			include './View/user_info_hangye_update.html';
		}
		//修改行业
		function user_info_hangye_doupdate(){
			$m = new Model('user_hangye');
			// var_dump($_POST);
			//判断是否修改成功
			if($m->where('hid='.$_POST['id'])->update($_POST)){
				echo '<script>alert("修改成功");location="./index.php?m=user&a=user_info_hangye"</script>';
			}else{
				echo '<script>alert("修改失败");location="./index.php?m=user&a=user_info_hangye_update&id='.$_POST['id'].'"</script>';
			}
		}

}