<?php
	include("connect.php");
	session_start();
	$SendDate = date('Y-m-d H:i:s');

	$MemberID=$_SESSION['MemberID'];
	$prequest=$_POST['prequest'];
	
	$status='pending';

	$query = "select max(RequestID) from prayerrequest";

	$result = mysql_query($query);

	if(mysql_num_rows($result) > 0){
		$row=mysql_fetch_array($result);

		$RequestID = substr($row[0],3,4);

		$id= intval($RequestID) +1;
			
		$id = str_pad($id, 4, '0', STR_PAD_LEFT);

		$RequestID = 'REQ' . $id;
	}
	else{
		$RequestID = 'REQ0001';
	}

	$query2="insert into prayerrequest(RequestID,SendDate,PrayerDesc,Status,MemberID) 
		values('$RequestID','$SendDate','$prequest','$status','$MemberID')";
	
	mysql_query($query2);
	header("location:../popup/addPrayerRequest.php?success=1");
?>