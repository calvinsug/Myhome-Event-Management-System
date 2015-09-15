<?php
session_start();
include("connect.php");
$StaffID = $_SESSION['StaffID'];

$error= "";

$StaffName = $_POST['StaffName'];
$email=$_POST['email'];

$address=$_POST['address'];
$image = $_FILES['img']['name'];

$currentPhone = $_POST['totalPhoneBefore'];

$totalPhone = $_POST['totalPhone'];

for($i=1;$i<=$currentPhone ; $i++){
	$phone = $_POST['phone'.$i];
	
	if($phone == NULL || $phone == ""){
		$error="phone ".$i." must be filled";
	}
	else if(is_numeric($phone) == false){
		$error="phone ".$i." must be a number";
	}
}

//validasi penambahan phone
if($totalPhone > $currentPhone){
	for($i=$currentPhone+1;$i<=$totalPhone ; $i++){
		$phone = $_POST['phone'.$i];
		
		if($phone == NULL || $phone == ""){
			$error="phone ".$i." must be filled";
		}
		else if(is_numeric($phone) == false){
			$error="phone ".$i." must be a number";
		}
	}

}

//$phone=$_POST['phone'];
/*if(!empty($_POST['gender'])){
		$gender = $_POST['gender'];
	}else{
		$gender = "";
	}*/
	
if($StaffName == NULL || $StaffName == ""){
		 $error="Staff Name must be filled";
	}
/*else if($phone == NULL || $phone == ""){
	$error="phone must be filled";
}
else if(is_numeric($phone) == false){
	$error="phone must be a number";
}*/
else if($email == NULL || $email== ""){
$error="email must be filled";
	}
	//validasi email dapet dari sini neh http://www.w3schools.com/php/func_filter_var.asp
else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) $error="email address not valid";
else if($address == "" ||$address ==NULL){
	$error="address must be filled";
}
//else if(substr($address,0,7) != "Street.") $error= "Address must starts with 'Street.' word";

/*else if($gender == ""){
	$error="gender must be filled";
}
else if($_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/png" && $_FILES["file"]["type"] != "image/jpg"){
	$error="Format file must be “.jpeg”, “.jpg”, or “.png”";
}else if($image == null || $image==""){
	$error="Image must be filled";
}*/

//klo lolos validasi
if($error==""){
	
	if($image == '')
		$query = "update Staff set StaffName = '$StaffName',StaffEmail = '$email', 
	 	StaffAddress='$address' where StaffID = '$StaffID'";
	else {
		
		$query = "update Staff set StaffName = '$StaffName', StaffEmail = '$email', 
	  StaffPhoto='$image', StaffAddress='$address' where StaffID = '$StaffID'";

		//upload file ke folder image
		move_uploaded_file($_FILES['img']['tmp_name'], "../assets/images/photostaff/".$image);
	}

	$query2 = "select * from phoneStaff where Staffid = '$StaffID'";
	$result = mysql_query($query2);

	//update current phone number
	$i=0;
	while($row = mysql_fetch_array($result)){
		$i++;
		$StaffPhoneID = $row['StaffPhoneID'];
		$PhoneNumber = $_POST['phone'.$i];
		$query3 = "update phonestaff set PhoneNumber = '$PhoneNumber' where StaffPhoneID = '$StaffPhoneID' ";
		mysql_query($query3);
		//echo $query3;
		//echo '<br/>';
	}

	//ada penambahan phone
	if($totalPhone > $currentPhone){

		$queryphone = "select max(StaffPhoneID) from phonestaff";

		$result = mysql_query($queryphone);
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$StaffPhoneID = substr($row[0],3,4);

			$id= intval($StaffPhoneID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			
		}
		else{

			$StaffPhoneID = 'SPH0001';
		} 
		$i = $currentPhone+1;
		for($i;$i<=$totalPhone;$i++){
			//echo $i;
			$StaffPhoneID = 'SPH' . $id;
			$id++;
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);
			$PhoneNumber = $_POST['phone'.$i];
			$query3 = "insert into phoneStaff(StaffPhoneID,PhoneNumber,StaffID) values('$StaffPhoneID','$PhoneNumber','$StaffID')";
			//echo $query3;die;

			mysql_query($query3);
		}


	}

	mysql_query($query);

	//menutup koneksi
	mysql_close($con);
	
	//balik ke home
	header("location:../popup/editProfileAdmin.php?success=1");

}
//klo ga lolos validasi
else header("location:../popup/editProfileAdmin.php?error=".$error);
?>