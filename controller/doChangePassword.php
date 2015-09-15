<?php
	$error = "";
	include('connect.php');
	session_start();

	$oldPassword = $_POST['oldPassword'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	$MemberID = $_SESSION['MemberID'];

	$query = "select * from member where MemberID = '$MemberID'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);

	if(md5($oldPassword) != $row['Password']) $error = "Wrong password.";
	else if($password == "") $error = "New password must be filled.";
	else if($password != $confirmPassword ) $error = "Confirmation password do not match.";

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "update member set password='".md5($password)."' where MemberID ='$MemberID'";

		mysql_query($query);

		mysql_close($con);
		
		header("location:../popup/changePassword.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/changePassword.php?error=".$error);
	}
	
?>