<?php
	class DetailControl{
		//默认显示后台首页
		function show(){
			$m = new Model('goods');
			//获取详情数据
			$result = $m->where('id='.$_GET['id'])->find();
			$kanle =  $m->where()->limit(5)->select();
			//获取点击量，把需要修改的点击量在当前基础上加1
			$_POST['clicknum'] = $result['clicknum']+1;
			//执行加1操作
			// var_dump($_POST);
			$m->where('id='.$_GET['id'])->update($_POST);
			//获取评价数据
			$m1 = new Model('pingjia');
			$pingjia = $m1->where("goodsid='".$_GET['id']."'")->select();
			// var_dump($pingjia);
			// var_dump($kanle);
			// var_dump($result);
			include './view/detail.html';
			include './view/footer.html';
		}
	}