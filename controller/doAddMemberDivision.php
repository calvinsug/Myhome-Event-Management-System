<?php
	$error = "";
	
	$EventID = $_POST['EventID'];
	$DivisionID = $_POST['division'];
	$MemberID = $_POST['member'];


	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "insert into MemberDivision(EventID,DivisionID,MemberID) 
			values('$EventID','$DivisionID','$MemberID')";	

		mysql_query($query);
		
		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/addDetailDivision.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/addDetailDivision.php?error=".$error);
	}
	
?>