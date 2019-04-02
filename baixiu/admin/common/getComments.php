<?php 
	$currentPage = $_POST['currentPage'];
	$pageSize = $_POST['pageSize'];

	//计算偏移量
	$offset=($currentPage-1)*$pageSize;

	//连接数据库获取数据
	include_once '../../common/mysql.php';
	$conn = connect();
	$sql = "SELECT c.id,c.author,c.created,c.content,c.status,p.title
	FROM comments as c
	LEFT JOIN posts as p
	on p.id = c.post_id
	LIMIT $offset,$pageSize";

	$arr = query($conn,$sql);


	$res = array("code"=>0,"msg"=>"请求评论数据失败");
	if ($arr) {
		$res['code'] = 1;
		$res['msg'] = "请求评论数据成功";
		$res['data'] = $arr;
	}
	echo json_encode($res);



 ?>