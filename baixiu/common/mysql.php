<?php 
	function connect(){
		$conn = mysqli_connect("localhost","root","root","baixiu");
		return $conn;
	};

	function query($conn,$sql){
		$res = mysqli_query($conn,$sql);
		$arr = []; //预防数据为空 下面的语句不执行
		while($row = mysqli_fetch_assoc($res)){
			$arr[] = $row;
		}
		return $arr;
	}

 ?>