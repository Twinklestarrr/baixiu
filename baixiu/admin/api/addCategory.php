<?php 
	//接收数据
	$name = $_POST['name'];
	$slug = $_POST['slug'];
	$classname = $_POST['classname'];

	include_once '../../common/mysql.php';
	$conn = connect();
	$sql = "select count(*) as count from categories where name = '$name'";
	$arr = query($conn,$sql);
	$res = ["code"=>0,"msg"=>"添加分类信息错误"];
	if($arr[0]['count']>0){
		$res['msg'] = "分类名称已存在";
	}else{
		$addsql = "insert into categories values(null,'$name','$slug','$classname')";
		$bool = mysqli_query($conn,$addsql);
	}

	if($bool){
		$res['code']=1;
		$res['msg']="插入成功";
		//获取自动生成的新id
		$res['id']=mysqli_insert_id($conn);
	}
	echo json_encode($res);

?>