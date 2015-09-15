<?php
	$error = "";
	
	$data = array();
	

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "select max(LocationID) from Location";

		$result = mysql_query($query);

		//print_r($query);die;
		//echo mysql_num_rows($result);die;
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$LocationID = substr($row[0],3,4);

			$id= intval($LocationID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$LocationID = 'LOC' . $id;
		}
		else{

			$LocationID = 'LOC0001';
		} 

		
		$LocationLatitude = $_POST['Lat'];
		$LocationLongitude = $_POST['Lng'];
		$LocationAddress = $_POST['LocationAddress'];
		$LocationName = $_POST['LocationName'];

		$query = "insert into Location(LocationID,LocationLatitude, LocationLongitude , LocationName, LocationAddress) 
			values('$LocationID','$LocationLatitude','$LocationLongitude','$LocationName','$LocationAddress')";

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