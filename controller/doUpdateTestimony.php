<?php
	$error = "";

	$TestimonyID= $_POST['TestimonyID'];

	$Title = $_POST['Title'];
	$Description = $_POST['Description'];

	if($Title == "") $error = 'Title must be filled.';
	else if($Description == "") $error = 'Description must be filled.';

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "update Testimony set Title='$Title', Description = '$Description' where TestimonyID ='$TestimonyID'";

		mysql_query($query);

		mysql_close($con);
		
		header("location:../popup/updateTestimony.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/updateTestimony.php?id=".$TestimonyID."&error=".$error."&Title=".$Title."&Description=".$Description);
	}
	
?>