<?php
	class TypeControl{
		function show(){
			//实例化model类
			$m = new Model('type');
			//实例化分页类
			$p = new Page($m->total(),10);
			//查询分类并返回一个数组
			$result = $m->where()->select();
			//调用无限分类的类 来处理数据
			$t = new Cattree($result);
			$res = $t->getTree();
			//var_dump($res);
			include('./View/type_list.html');
		}
		function add(){
			//实例化model类
			$m = new Model('type');
			//先查询所有的分类给下拉使用
			$result = $m->select();
			//调用无限分类的类处理数据
			$t = new Cattree($result);
			$res = $t->getTree();
			include ('./View/type_add.html');
		}
		function do_add(){
			//实例化model类
			$m = new Model('type');
			//手动添加 path 等于pid后面加逗号
			$_POST['path'] = $_POST['pid'].',';
			//判断添加的是否是顶级分类
			if ($_POST['pid'] != '0') {
				//不是顶级分类，获取父类id
				$_POST['pid'] = ltrim(strrchr($_POST['pid'],','),',');
			}else{
				//是顶级分类直接让pid等于0
				$_POST['pid'] = '0';
			}
			// var_dump($_POST);
			// $m->insert($_POST);
			// echo $m->sql;
			// exit;
			//执行添加操作并判断
			if($m->insert($_POST)){
				echo '<script>alert("添加成功");location="./index.php?m=type&a=show"</script>';
			}else{
				echo '<script>alert("添加失败");location="./index.php?m=type&a=add"</script>';

			}
		}
		function update(){
			//实例化model类
			$m = new Model('type');
			//查询分类，条件是传入的id
			$result = $m->where('id='.$_GET['id'])->select();
			//单独查询顶级分类
			$lei = $m->where('pid=0')->select();
			//实例化无限分类
			$t = new Cattree($lei);
			//调用无限分类的类 来处理数据
			$res = $t->getTree();
			include ('./View/type_update.html');
		}
		function do_update(){
			$m = new Model('type');
			//把提交的pid赋值给path，因为pid 是拼接的0,1,标识
			$_POST['path'] = $_POST['pid'].',';
			//获取pid
			$_POST['pid'] = ltrim(strrchr($_POST['pid'],','),',');
			//判断是否是只修改顶级分类名字
			if (isset($_POST['biaoshi']) && $_POST['biaoshi'] == 'f') {
				//强制让pid=0，路径=0，
				$_POST['pid'] = '0';
				$_POST['path'] = '0,';
			}
			//将postid 赋值给$id
			$id = $_POST['id'];
			//删除POST里面的id防止修改冲突
			unset($_POST['id']);
			// var_dump($_POST);
			// exit;
			// 执行修改操作并判断结果
			if($m->where('id='.$id)->update($_POST)){
				echo '<script>alert("修改成功");location="./index.php?m=type&a=show"</script>';
			}else{
				echo '<script>alert("修改失败");location="./index.php?m=type&a=update&id='.$_POST['id'].'"</script>';

			}
		}
		function paixu(){
			// var_dump($_POST);
			$m = new Model('type');
			$num = 0;
			//循环修改 排序字段
			foreach($_POST as $k=>$v){
				if($_POST[$k] != 0){
					$num += $m->where('id='.$k)->update(array('ord'=>$v));
				}
			}
			if($num > 0){
				header('location:./index.php?m=type&a=show');
			}else{
				header('location:./index.php?m=type&a=show');
			}
		}

	}