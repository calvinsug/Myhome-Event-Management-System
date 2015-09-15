<?php 

	session_start();
	//unset($_SESSION['userlogin']);
	

	unset($_SESSION['Username']);
	unset($_SESSION['MemberID']);
	unset($_SESSION['MemberName']);

	//session_destroy(); //ancurin semua session
	//setcookie("user","",time()-1,"/");
	
	header("location:../home.php");
?>