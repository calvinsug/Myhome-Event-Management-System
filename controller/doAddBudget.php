<?php
	$error = "";
	
	$EventID = $_POST['EventID'];
	$DivisionID = $_POST['division'];


	$BudgetDescription = $_POST['budgetdesc'];
	$BudgetExpected = $_POST['budgetexpected'];

	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "select max(BudgetID) from BudgetEvent";

		$result = mysql_query($query);

		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$BudgetID = substr($row[0],3,4);

			$id= intval($BudgetID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$BudgetID = 'BUD' . $id;
		}
		else{

			$BudgetID = 'BUD0001';
		} 

		$query = "insert into BudgetEvent(BudgetID,EventID,DivisionID,BudgetDescription,BudgetExpected) 
			values('$BudgetID','$EventID','$DivisionID','$BudgetDescription','$BudgetExpected')";	


		//echo $query;die;	

		mysql_query($query);
		
		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/addBudget.php?success=1");
	}
	//klo gk lolos validasi
	else{	

		header("location:../popup/addBudget.php?error=".$error);
	}
	
?>