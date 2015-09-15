<?php
	session_start();
	include("connect.php");
	$error = "";
	$data = array();	

	$EventID = $_POST['EventID'];
	$MemberID = $_SESSION['MemberID'];

	$query = "select PaymentType from event where eventid = '$EventID' ";

	$result = mysql_query($query);

	$row = mysql_fetch_array($result);

	$RegistrationDate = date('Y-m-d G:i:s');

	if($row[0] == 'free'){

		$query = "select max(ParticipantID) from registrationevent where eventid = '$EventID' ";

		$result = mysql_query($query);

		$row = mysql_fetch_array($result);

		if(mysql_num_rows($result) > 0){
			$ParticipantID = $row[0]+1;

		}
		else $ParticipantID =1;
		
		$query = "insert into RegistrationEvent(EventID,MemberID,ParticipantID,PaymentStatus,RegistrationDate) 
			values('$EventID','$MemberID',$ParticipantID,'done','$RegistrationDate')";	

		mysql_query($query);

		echo 1;
	}
	else{
		$query = "insert into RegistrationEvent(EventID,MemberID,PaymentStatus,RegistrationDate) 
			values('$EventID','$MemberID','pending','$RegistrationDate')";	


		mysql_query($query);

		echo 1;
	}


	
	
?>