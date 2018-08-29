<?php
	class TypeControl{
		function show(){
			$m = new Model('type');
			$result = $m->select();
			//调用无限分类的类 来处理数据
			$t = new Cattree($result);
			$res = $t->getTree();
			//var_dump($res);
			//显示分类信息页
			include('./View/type/type_list.html');
		}
		function add(){
			$m = new Model('type');
			$result = $m->select();
			$t = new Cattree($result);
			$res = $t->getTree();
			include ('./View/type/type_info.html');
		}
		function do_add(){
			//var_dump($_POST);
			$m = new Model('type');
			//$m->insert($_POST);
			//echo $m->sql;
			//exit;
			if($m->insert($_POST)){
				echo '<script>alert("添加成功");location="./index.php?m=type&a=show"</script>';
			}else{
				echo '<script>alert("添加失败");location="./index.php?m=type&a=add"</script>';

			}
		}
		function paixu(){
			//var_dump($_POST);
			$m = new Model('type');
			$num = 0;
			foreach($_POST as $k=>$v){
				if($_POST[$k] != 0){
					$num += $m->where('id='.$k)->update(array('ord'=>$v));
				}
			}
			if($num > 0){
				header('location:./index.php?m=type&a=show');
			}
		}
	}