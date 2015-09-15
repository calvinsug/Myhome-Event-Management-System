<?php
	$error = "";
	
	$EventID = $_POST['EventID'];
	$MemberID = $_POST['MemberID'];

	$BankAccountFrom = $_POST['BankAccountFrom'];

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");
		
		$query = "update registrationevent set PaymentStatus='wait',
				  BankAccountFrom='$BankAccountFrom'
				  where EventID = '$EventID' and MemberID = '$MemberID' ";

		//echo $query;die;		
		mysql_query($query);
		
		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/confirmPayment.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/confirmPayment.php?error=".$error);
	}
	
?>