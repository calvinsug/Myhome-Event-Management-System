<?php
	$error = "";
	include('connect.php');

	$data['status'] = '1';
	$data['error'] = '';

	$StaffID = $_POST['StaffID'];
	$answer = $_POST['answer'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmpassword'];

	$query = "select * from staff where StaffID = '$StaffID'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);


	if($answer == "") 	$data['error'] = "Answer must be filled.";
	else if($answer !== $row['Answer'])  $data['error'] = "Wrong Answer.";
	else if($password == "") $data['error'] = "New password must be filled.";
	else if($confirmPassword == "") $data['error'] = "Confirm password must be filled.";
	else if($password != $confirmPassword ) $data['error'] = "Confirmation password do not match.";
	
	
	if($data['error'] != "") $data['status'] = '0';

	//kalo lolos validasi
	if($data['status'] == '1' ){
		
		$query = "update staff set password='".md5($password)."' where StaffID ='$StaffID'";

		//echo $query;die;
		mysql_query($query);

		mysql_close($con);
		
	}
	
		echo json_encode($data);
	
	
?>