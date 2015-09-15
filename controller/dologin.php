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
		$query = "select * from member where username = '$username' and password = '$password' ";

		$result = mysql_query($query);

		//print_r($query);die;
		//echo mysql_num_rows($result);die;
		
		if(mysql_num_rows($result) > 0){
			
			$row = mysql_fetch_array($result);
			
			//membuka session
			$_SESSION['Username'] = $row['Username'];
			
			$_SESSION['MemberID'] = $row['MemberID'];
			$_SESSION['MemberName'] = $row['MemberName'];

			//echo $tes;die;

			//$remember = $_POST['remember'];
			
			//jika remember me dicentang
			//if($remember=="yes")	setcookie("user", $user, time()+3600,"/");
			
			header("location:../home.php?login=1");
		
		}
		else{
			//tidak ditemukan username dan password yg diinput
			header("location:../login.php?error=Wrong username or password");
		}

	}
	else	header("location:../login.php?error=".$error);

	
	//menutup koneksi
mysql_close($con);
?>