<?php 

	include_once '../../common/mysql.php';
	$conn = connect();
	$sql = "select * from categories";
	$arr = query($conn,$sql);
	$res = array("code"=>0,"msg"=>"请求分类数据失败");
	if ($arr) {
		$res['code'] = 1;
		$res['msg'] = "请求分类数据成功";
		$res['data'] = $arr;
	}
	echo json_encode($res);

 ?>