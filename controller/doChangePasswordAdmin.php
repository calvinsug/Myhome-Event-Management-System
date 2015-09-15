<?php
	$error = "";
	include('connect.php');
	session_start();

	$oldPassword = $_POST['oldPassword'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	$StaffID = $_SESSION['StaffID'];

	$query = "select * from Staff where StaffID = '$StaffID'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);

	if(md5($oldPassword) != $row['Password']) $error = "Wrong password.";
	else if($password == "") $error = "New password must be filled.";
	else if($password != $confirmPassword ) $error = "Confirmation password do not match.";

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "update Staff set password='".md5($password)."' where StaffID ='$StaffID'";

		mysql_query($query);

		mysql_close($con);
		
		header("location:../popup/changePasswordAdmin.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/changePasswordAdmin.php?error=".$error);
	}
	
?>