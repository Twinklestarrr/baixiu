<?php 
	$currentPage = $_POST['currentPage'];
	$pageSize = $_POST['pageSize'];
	$category = $_POST['category']; //all
	$status = $_POST['status'];   //all

	//计算偏移量
	$offset=($currentPage-1)*$pageSize;

	//添加sql限制条件 难点
	$where = "where 1=1";
	if($category!="all"){
		$where .= " and p.category_id = '$category'";
	}
	if($status!="all"){
		$where .= " and p.status = '$status'";
	}


	//连接数据库获取数据
	include_once '../../common/mysql.php';
	$conn = connect();
	$sql = "SELECT p.created,p.`status`,u.nickname,c.`name`,p.title,p.id
	FROM posts as p
	LEFT JOIN categories as c
	on p.category_id = c.id
	LEFT JOIN users as u
	on p.user_id = u.id 
	$where
	LIMIT $offset,$pageSize";

	$countSql = "select count(*) as count from posts as p $where";
	$count = query($conn,$countSql)[0]['count'];
	$arr = query($conn,$sql);


	$res = array("code"=>0,"msg"=>"请求分类数据失败");
	if ($arr) {
		$res['code'] = 1;
		$res['msg'] = "请求分类数据成功";
		$res['data'] = $arr;
		$res['count'] = $count;
	}
	echo json_encode($res);

 ?>