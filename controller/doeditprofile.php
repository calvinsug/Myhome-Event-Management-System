<?php
session_start();
include("connect.php");
$MemberID = $_SESSION['MemberID'];

$error= "";

$memberName = $_POST['MemberName'];
$email=$_POST['email'];

$address=$_POST['address'];
$image = $_FILES['img']['name'];
$BranchID = $_POST['branchID'];

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
	
if($memberName == NULL || $memberName == ""){
		 $error="Member Name must be filled";
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
		$query = "update member set MemberName = '$memberName',MemberEmail = '$email', 
	 	MemberAddress='$address', BranchID = '$BranchID' where MemberID = '$MemberID'";
	else {
		
		$query = "update member set MemberName = '$memberName', MemberEmail = '$email', 
	  MemberPhoto='$image', MemberAddress='$address', BranchID = '$BranchID' where MemberID = '$MemberID'";

		//upload file ke folder image
		move_uploaded_file($_FILES['img']['tmp_name'], "../assets/images/photomember/".$image);
	}

	$query2 = "select * from phonemember where memberid = '$MemberID'";
	$result = mysql_query($query2);

	//update current phone number
	$i=0;
	while($row = mysql_fetch_array($result)){
		$i++;
		$MemberPhoneID = $row['MemberPhoneID'];
		$PhoneNumber = $_POST['phone'.$i];
		$query3 = "update phonemember set PhoneNumber = '$PhoneNumber' where MemberPhoneID = '$MemberPhoneID' ";
		mysql_query($query3);
		//echo $query3;
		//echo '<br/>';
	}

	//ada penambahan phone
	if($totalPhone > $currentPhone){

		$queryphone = "select max(MemberPhoneID) from phonemember";

		$result = mysql_query($queryphone);
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$MemberPhoneID = substr($row[0],3,4);

			$id= intval($MemberPhoneID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			
		}
		else{

			$MemberPhoneID = 'MPH0001';
		} 
		$i = $currentPhone+1;
		for($i;$i<=$totalPhone;$i++){
			//echo $i;
			$MemberPhoneID = 'MPH' . $id;
			$id++;
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);
			$PhoneNumber = $_POST['phone'.$i];
			$query3 = "insert into phonemember(MemberPhoneID,PhoneNumber,MemberID) values('$MemberPhoneID','$PhoneNumber','$MemberID')";

			mysql_query($query3);
		}


	}

	mysql_query($query);

	//menutup koneksi
	mysql_close($con);
	
	//balik ke home
	header("location:../popup/editProfile.php?success=1");

}
//klo ga lolos validasi
else header("location:../popup/editProfile.php?error=".$error);
?>