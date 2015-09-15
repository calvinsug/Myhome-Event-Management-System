<?php
	$error = "";
	session_start();

	$CreateDate = date('Y-m-d G:i:s');	
	$Title = $_POST['Title'];
	$Description = $_POST['Description'];


	if($Title == '') $error ='Title must be filled.';
	else if($Description == '') $error = 'Desription must be filled.';	

	$MemberID = $_SESSION['MemberID'];

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "select max(TestimonyID) from testimony";

		$result = mysql_query($query);

		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$TestimonyID = substr($row[0],3,4);

			$id= intval($TestimonyID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$TestimonyID = 'TES' . $id;
		}
		else{

			$TestimonyID = 'TES0001';
		} 

		$query = "insert into testimony(TestimonyID,CreateDate,Title,Description,Status,MemberID) 
			values('$TestimonyID','$CreateDate','$Title','$Description','pending','$MemberID')";	


		//echo $query;die;	

		mysql_query($query);
		
		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/addTestimony.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/addTestimony.php?error=".$error);
	}
	
?>