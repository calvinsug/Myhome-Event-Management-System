<?php
	$error = "";
	
	$DivisionName = $_POST['DivisionName'];

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "select max(DivisionID) from Division";

		$result = mysql_query($query);
		
		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$DivisionID = substr($row[0],3,4);

			$id= intval($DivisionID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$DivisionID = 'DIV' . $id;
		}
		else{

			$DivisionID = 'DIV0001';
		} 

		$query = "insert into Division(DivisionID, DivisionName) 
			values('$DivisionID','$DivisionName')";	

		mysql_query($query);
		
		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/addDivision.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/addDivision.php?error=".$error);
	}
	
?>