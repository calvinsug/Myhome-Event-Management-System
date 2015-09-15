<?php 
	//untuk connect ke database
	include("connect.php");
	$error = "";
	$status = "";
	//memulai session
	session_start();
	//mengambil username dan password yang diinput
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == NULL || $username == "")
		$error="Username must be filled";
	else if($password == NULL || $password == "")
		$error="Password must be filled";
	
	//kalo lolos validasi inputan
	if($error==""){
		//encrypt password
		$password = md5($password);
 
		//membuat query
		$query = "select * from staff where username = '$username' and password = '$password' ";

		$result = mysql_query($query);

		//print_r($query);die;
		//echo mysql_num_rows($result);die;
		
		if(mysql_num_rows($result) > 0){
			
			$row = mysql_fetch_array($result);
			$tes2="";
			//print_r($row);die;
			//membuka session
			
			$_SESSION['StaffUsername'] = $row['Username'];
			
			$_SESSION['StaffID'] = $row['StaffID'];
			$_SESSION['StaffName'] = $row['StaffName'];
			$_SESSION['StaffRole'] = $row['StaffRole'];
			//echo $row['Username'],$row['StaffID'], $row['StaffName'];

			//print_r($row['StaffID']);

			
			

			//$remember = $_POST['remember'];
			
			//jika remember me dicentang
			//if($remember=="yes")	setcookie("user", $user, time()+3600,"/");
			
			header("location:../homeadmin.php");
		
		}
		else{
			//tidak ditemukan username dan password yg diinput
			header("location:../loginadmin.php?error=Wrong username or password");
		}

	}
	else	header("location:../loginadmin.php?error=".$error);

	
	//menutup koneksi
mysql_close($con);
?>