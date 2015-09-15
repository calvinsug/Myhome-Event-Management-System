<?php
	$error = "";
	
	$data = array();
	

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$LocationID = $_POST['LocationID'];
		$LocationLatitude = $_POST['Lat'];
		$LocationLongitude = $_POST['Lng'];
		$LocationAddress = $_POST['LocationAddress'];
		$LocationName = $_POST['LocationName'];

		$query = "update Location set LocationLatitude='$LocationLatitude', LocationLongitude='$LocationLongitude' ,
		 LocationAddress = '$LocationAddress', LocationName = '$LocationName' where LocationID ='$LocationID'";

		//echo $query;die;

		//insert ke database MySQL
		mysql_query($query);

		$data['status'] = 'success';
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