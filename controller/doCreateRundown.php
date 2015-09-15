<?php
	$error = "";

	$dayRundown = $_POST['dayRundown'];

	$desc = $_POST['Rundowndesc'];
	$EventID = $_POST['EventID'];
	$LocationID = $_POST['Location'];


	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	
			
	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "select max(RundownID) from RundownEvent";

		$result = mysql_query($query);

		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$RundownID = substr($row[0],3,4);

			$id= intval($RundownID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$RundownID = 'RUN' . $id;
		}
		else{

			$RundownID = 'RUN0001';
		} 

		$query ="insert into RundownEvent(RundownID, EventID , LocationID , DayRunDown , StartTime , EndTime, Description) 
			values('$RundownID','$EventID','$LocationID','$dayRundown','$startTime','$endTime','$desc')"; 

		//insert ke database MySQL
		mysql_query($query);

		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/addRundown.php?EventID=$EventID&success=1");
	}
	//klo gk lolos validasi
	else{	
		header("location:../popup/addRundown.php?error=".$error);
	}
	
?>