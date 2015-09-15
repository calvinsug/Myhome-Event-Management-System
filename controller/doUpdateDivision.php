<?php
	$error = "";

	$DivisionID= $_POST['DivisionID'];

	$DivisionName = $_POST['DivisionName'];


	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "update Division set DivisionName='$DivisionName' where DivisionID ='$DivisionID'";

		mysql_query($query);

		mysql_close($con);
		
		header("location:../popup/updateDivision.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/updateDivision.php?error=".$error);
	}
	
?>