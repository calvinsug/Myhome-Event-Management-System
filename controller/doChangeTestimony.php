<?php
	include("connect.php");
	$TestimonyID= $_GET['id'];
	$show = $_GET['show'];

	//kalo lolos validasi
	if($show == '1'){
		//untuk connect ke database
		

		$query = "update Testimony set Status='approved' where TestimonyID ='$TestimonyID'";

		mysql_query($query);

		mysql_close($con);
		
		header("location:../testimonyadmin.php?success=1");
	}
	//klo gk lolos validasi
	else if($show == '0'){	
		$query = "update Testimony set Status='pending' where TestimonyID ='$TestimonyID'";

		mysql_query($query);

		mysql_close($con);
		
		header("location:../testimonyadmin.php?success=2");

	}
	
?>