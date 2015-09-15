<?php
	//untuk connect ke database
	include("connect.php");

	$error = "";
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$cpass = $_POST['confirmpassword'];
	$fullname = $_POST['firstname']. ' '.$_POST['lastname'];
	//$img = $_POST['img'];
	//$gender = $_POST['gender'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$StaffRole = $_POST['role'];
	$image = $_FILES['img']['name'];


	$questionsecurity = $_POST['questionsecurity'];
	$answer = $_POST['answer'];


	//cek paramater keterima ato ga
	//echo $user,$pass,$fullname, $img, $gender, $email, $phone, $address;
	
	//mulai validasi username segala macem 	

		//ini buat cek ada berapa special character sih
		$flagspecial = 0;
		for ($i=0; $i < strlen($pass); $i++) {
			if (!is_numeric($pass[$i]) && !ctype_alpha($pass[$i])) 
				$flagspecial++;	
		}
	
	$querycheck = "select * from staff where username = '$user'";

	$resultcheck = mysql_query($querycheck);

/*	$sum = mysql_num_rows($resultcheck);
	echo $sum;die;
*/
	if($user == "") $error="Username must be filled";
	else if(mysql_num_rows($resultcheck) >0) $error ="username already exist";
	else if($pass == "") $error = "password must be filled";
	//else if($flagspecial==0 ) $error = "password must contain any special character";
	else if($cpass =="") $error = "you must confirm your password";
	else if($pass != $cpass) $error= "your confirm password doesn`t match with your password";
	else if($fullname == "") $error= "fullname must be filled";
	else if($image == "") $error = "image must be chosen";
	//else if($_FILES["img"]["type"] != "image/jpeg" && $_FILES["img"]["type"] != "image/png" && $_FILES["img"]["type"] != "image/jpg")	$error="Format file must be '.jpeg', '.jpg', or '.png'";
	
	else if($email=="") $error="Email must be filled";
	//validasi email dapet dari sini neh http://www.w3schools.com/php/func_filter_var.asp
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) $error="emaill address not valid";
 	else if($phone == "") $error= "phone must be filled";
	else if(is_numeric($phone) == false)  $error="Phone must be a number"; 
	else if($address == "") $error = "address must be filled";
	else if($answer == "") $error = "Aswer security must be filled.";

	//$start = substr($address,0,7); mecahin 7 huruf di awal
	
		
	//kalo lolos validasi
	if($error==""){
		

		session_start();
		

		$query = "select max(StaffID) from staff";

		$result = mysql_query($query);

		//print_r($query);die;
		//echo mysql_num_rows($result);die;
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$StaffID = substr($row[0],3,4);

			$id= intval($StaffID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$StaffID = 'STA' . $id;
		}
		else{

			$StaffID = 'STA0001';
		} 

		$query = "select max(StaffPhoneID) from phonestaff";

		$result = mysql_query($query);

		//print_r($query);die;
		//echo mysql_num_rows($result);die;
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$StaffPhoneID = substr($row[0],3,4);

			$id= intval($StaffPhoneID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$StaffPhoneID = 'SPH' . $id;
		}
		else{

			$StaffPhoneID = 'SPH0001';
		} 


		$query = "insert into staff(StaffID,username,password,StaffName,StaffAddress,StaffEmail,StaffPhoto,SecurityQuestion,Answer) 
			values('$StaffID','$user','".md5($pass)."','$fullname','$address','$email','$image','$questionsecurity','$answer')";

		$query2 = "insert into phonestaff(StaffPhoneID,PhoneNumber,StaffID) values('$StaffPhoneID','$phone','$StaffID')";


		/*echo $query;
		echo $query2;
		die;*/

		//insert ke database MySQL
		mysql_query($query);


		mysql_query($query2);



		//upload file ke folder image
		move_uploaded_file($_FILES['img']['tmp_name'], "../assets/images/photostaff/".$image);
		
		/*$_SESSION['StaffUsername'] = $user;
		$_SESSION['StaffID'] = $StaffID;
		$_SESSION['StaffName'] = $fullname;*/

		

		//menutup koneksi
		mysql_close($con);
		
		//balik ke home
		header("location:../loginadmin.php");
	}
	//klo gk lolos validasi
	else{	
		header("location:../registeradmin.php?error=".$error);
	}
	
?>