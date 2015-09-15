<?php
	session_start();

	//echo count($_SESSION['product']);
	unset($_SESSION['product'][$_GET['id']]);
	//echo count($_SESSION['product']);
	

	/* percobaan 
	echo count($_SESSION['product']);
	echo "sebelum";
	echo $_SESSION['product'][0];
	echo $_SESSION['product'][1];
	echo $_SESSION['product'][2];
	echo $_SESSION['product'][3];
	*/

	$j=0;
	if($_GET['id']<count($_SESSION['product'])){
		//+1-$_GET['id']
		for($i=$_GET['id']; $i < count($_SESSION['product']); $i++) { 
			$_SESSION['product'][$i] = $_SESSION['product'][$i+1];
			$j=$i; 
		}

		unset($_SESSION['product'][$j]);

	}
	
	/* percobaan
	echo count($_SESSION['product']);
	echo "sesudah";
	echo $_SESSION['product'][0];
	echo $_SESSION['product'][1];
	echo $_SESSION['product'][2];
	echo $_SESSION['product'][3];
	*/
	header("location:../shopcart.php");
?>