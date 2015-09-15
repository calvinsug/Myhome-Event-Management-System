<?php
	include("connect.php");

	$RequestID = $_POST['RequestID'];

	$AcceptDate = date('Y-m-d H:i:s');

	$PrayerRespond = $_POST['PrayerRespond'];

	$query = "update prayerrequest set status = 'done', AcceptDate = '$AcceptDate',PrayerRespond = '$PrayerRespond' where RequestID= '$RequestID'";	
	
	//echo $query;die;

	mysql_query($query);

	//menutup koneksi
	mysql_close($con);

	header("location:../popup/confirmPrayer.php?success=1");
?>