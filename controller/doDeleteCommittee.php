<?php 
	include("connect.php");
	$EventID = $_GET['EventID'];
	$DivisionID = $_GET['DivisionID'];
	$EventTitle = $_GET['EventTitle'];
	
	$MemberID = $_GET['MemberID'];

	$query = "delete FROM memberdivision where EventID='$EventID' and DivisionID='$DivisionID' and MemberID ='$MemberID'";

	//echo $query;die;

	mysql_query($query);

	mysql_close($con);

	header("location:../popup/viewDetailDivision.php?success=1&EventID=$EventID&EventTitle=$EventTitle");
	
?>