<?php
	$error = "";

	$BudgetActual = $_POST['BudgetActual'];
	$BudgetExpected = $_POST['BudgetExpected'];
	$BudgetDescription = $_POST['BudgetDescription'];
	$BudgetID = $_POST['BudgetID'];	

	$EventID = $_POST['EventID'];
	$EventTitle = $_POST['EventTitle'];

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		
		$query = "update budgetevent set BudgetDescription = '$BudgetDescription',BudgetExpected ='$BudgetExpected',
		 BudgetActual ='$BudgetActual'where BudgetID ='$BudgetID' ";
			
		//insert ke database MySQL
		mysql_query($query);
/*
		$data['status'] = 'success';
		$data['BranchID'] = $BranchID;*/

		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/viewBudget.php?EventID=$EventID&EventTitle=$EventTitle&success=2");
		
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/viewBudget.php?EventID=$EventID&EventTitle=$EventTitle&error=".$error);
	}
	
?>