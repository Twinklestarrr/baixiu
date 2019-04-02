<?php 
	session_start();
	if(!isset($_SESSION['userinfo'])){
	  header("location:login.php");
	}

 ?>