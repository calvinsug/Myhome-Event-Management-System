<?php 

	session_start();
	//unset($_SESSION['userlogin']);
	

	unset($_SESSION['StaffUsername']);
	unset($_SESSION['StaffID']);
	unset($_SESSION['StaffName']);

	//session_destroy(); //ancurin semua session
	//setcookie("user","",time()-1,"/");
	
	header("location:../loginadmin.php");
?>