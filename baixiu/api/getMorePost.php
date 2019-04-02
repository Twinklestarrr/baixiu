<?php 
	//接收数据
	$categoryId = $_POST['categoryId'];
	$currentPage = $_POST['currentPage'];
	$pageSize = $_POST['pageSize'];

	//计算数据库的偏移量
	$offset = ($currentPage-1)*$pageSize;
	//引入封装的连接数据库函数
	include_once '../common/mysql.php';

	$conn = connect();
	$sql = "SELECT p.id,p.title,p.feature,p.created,p.content,p.views,p.likes,u.nickname,c.`name`,
     (SELECT COUNT(*) FROM comments WHERE comments.post_id = p.id) AS commentsCount 
     FROM posts AS p
     LEFT JOIN users AS u ON u.id = p.user_id
     LEFT JOIN categories AS c ON c.id = p.category_id
     ORDER BY created DESC
     LIMIT $offset,$pageSize";
	$arr = query($conn,$sql);

	//计算总条数
	$countSql = "select count(*) as count from posts where category_id=$categoryId";
	$countArr = query($conn,$countSql);
	// print_r($countArr); //二维数组
			// Array(
			// 	    [0] => Array
			// 	        (
			// 	            [count] => 294
			// 	        )

			// 		)
	$count = $countArr[0]['count'];




	//返回默认值
	$res = array("code"=>0,"msg"=>"请求失败");
	//请求成功返回值
	if($arr){
		//成功条件
		$res['code'] = 1;
		$res['msg'] = "请求成功";
		//返回的数据
		$res['data'] = $arr;
		//页数
		$res['count'] = $count;
	}
	echo json_encode($res);




 ?>