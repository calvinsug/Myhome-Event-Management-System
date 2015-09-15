<?php
	$error = "";
	/*$user = $_POST['username'];
	$pass = $_POST['password'];
	$cpass = $_POST['confirmpassword'];
	$fullname = $_POST['firstname']. ' '.$_POST['lastname'];
	//$img = $_POST['img'];
	//$gender = $_POST['gender'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$branchID = $_POST['branchID'];
	$image = $_FILES['img']['name'];*/

	//cek paramater keterima ato ga
	//echo $user,$pass,$fullname, $img, $gender, $email, $phone, $address;
	
	//mulai validasi username segala macem 	

		//ini buat cek ada berapa special character sih
		
	
	/*if($user == "") $error="Username must be filled";
	else if($pass == "") $error = "password must be filled";
	else if($flagspecial==0 ) $error = "password must contain any special character";
	else if($cpass =="") $error = "you must confirm your password";
	else if($pass != $cpass) $error= "your confirm password doesn`t match with your password";
	else if($fullname == "") $error= "fullname must be filled";
	else if($image == "") $error = "image must be chosen";
	else if($_FILES["img"]["type"] != "image/jpeg" && $_FILES["img"]["type"] != "image/png" && $_FILES["img"]["type"] != "image/jpg")	$error="Format file must be '.jpeg', '.jpg', or '.png'";
	else if($gender=="") $error="Gender must be chosen";
	else if($email=="") $error="Email must be filled";
	//validasi email dapet dari sini neh http://www.w3schools.com/php/func_filter_var.asp
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) $error="emaill address not valid";
 	else if($phone == "") $error= "phone must be filled";
	else if(is_numeric($phone) == false)  $error="Phone must be a number"; 
	else if($address == "") $error = "address must be filled";
	//$start = substr($address,0,7); mecahin 7 huruf di awal
	else if(substr($address,0,7) != "Street.") $error= "Address must starts with 'Street.' word";

*/
	$data = array();
	

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		
		

		$query = "select max(BranchID) from Branch";

		$result = mysql_query($query);

		//print_r($query);die;
		//echo mysql_num_rows($result);die;
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$BranchID = substr($row[0],3,4);

			$id= intval($BranchID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$BranchID = 'BRA' . $id;
		}
		else{

			$BranchID = 'BRA0001';
		} 

		$StaffID = $_POST['StaffID'];
		$BranchLatitude = $_POST['Lat'];
		$BranchLongitude = $_POST['Lng'];
		$BranchAddress = $_POST['BranchAddress'];
		$Region = $_POST['Region'];

		$query = "insert into Branch(BranchID, BranchLatitude, BranchLongitude , BranchAddress, Region,StaffID) 
			values('$BranchID','$BranchLatitude','$BranchLongitude','$BranchAddress','$Region','$StaffID')";

		//echo $query;die;

		//insert ke database MySQL
		mysql_query($query);

		$data['status'] = 'success';
		$data['BranchID'] = $BranchID;
		//menutup koneksi
		mysql_close($con);
		
		echo 1;
	}
	//klo gk lolos validasi
	else{	

		$data['status'] = 'failed';

		echo $error;
	}
	
?>