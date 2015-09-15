<?php

	if(isset($_GET['EventID']))
		$EventID = $_GET['EventID'];

	if(isset($_GET['MemberID']))
		$MemberID = $_GET['MemberID'];

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "select max(ParticipantID) from registrationevent where eventid = '$EventID' ";

		$result = mysql_query($query);

		$row = mysql_fetch_array($result);

		if(mysql_num_rows($result) > 0){
			$ParticipantID = $row[0]+1;

		}
		else $ParticipantID = 1;
		
		$query = "update registrationevent set PaymentStatus='done', ParticipantID = $ParticipantID
				  where EventID = '$EventID' and MemberID = '$MemberID' ";



		//echo $query;die;		
		mysql_query($query);
		
		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/confirmPaymentAdmin.php?success=1&EventID=".$EventID);
	}
	//klo gk lolos validasi
	
	
?>