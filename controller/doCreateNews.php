<?php
	session_start();
	$error = "";
	$title = $_POST['title'];
	$desc = $_POST['desc'];
		
	$image = $_FILES['img']['name'];

	$StaffID = $_SESSION['StaffID'];

	$CreateDate = date('Y-m-d G:i:s');	

	//echo $image;die;

	//echo $title;

	//echo "<br/>";

	//echo $StaffID;die;

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
		
	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");


		$query = "select max(NewsID) from news";

		$result = mysql_query($query);

		//print_r($query);die;
		//echo mysql_num_rows($result);die;
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$NewsID = substr($row[0],3,4);

			$id= intval($NewsID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$NewsID = 'NEW' . $id;
		}
		else{

			$NewsID = 'NEW0001';
		} 

		$query = "insert into news(NewsID,Title,Description,CreateDate,Photo,StaffID) 
			values('$NewsID','$title','$desc','$CreateDate','$image','$StaffID')";		


		//insert ke database MySQL
		mysql_query($query);

		//upload file ke folder image
		move_uploaded_file($_FILES['img']['tmp_name'], "../assets/images/photonews/".$image);

		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/addNews.php?success=1");
	}
	//klo gk lolos validasi
	else{	
		header("location:../popup/addNews.php?error=".$error);
	}
	
?>