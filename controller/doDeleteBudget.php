<?php 
	include("connect.php");
	$EventID = $_GET['EventID'];
	$EventTitle = $_GET['EventTitle'];
	$BudgetID = $_GET['BudgetID'];

	$query = "delete FROM budgetevent where BudgetID='$BudgetID'";

	//echo $query;die;

	mysql_query($query);

	mysql_close($con);

	header("location:../popup/viewBudget.php?success=1&EventID=$EventID&EventTitle=$EventTitle");
	
?>