<?php 
	if($_FILES['file']['error']==0){
		$filename = time().mt_rand(1,99).strrchr($_FILES['file']['name'],".");
		$bool = move_uploaded_file($_FILES['file']['tmp_name'],"../../static/uploads/".$filename);

		$res = array('code' => 0,'msg'=>"上传文件失败" );
		if($bool){
			$res['code'] = 1;
			$res['msg'] = "上传成功";
			$res['src'] = "/static/uploads/".$filename;
		}
		echo json_encode($res);
	}

 ?>