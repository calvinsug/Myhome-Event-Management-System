<?php 
	session_start();

	
	//if(isset($_SESSION['product']))
	//	array_push($_SESSION['product'], $_GET['id'])
	//else $_SESSION['product'] = $_GET['id'];
	
	//$_SESSION['product'] = $_GET['id'];

	if (!isset($_SESSION['product'])) {
    $_SESSION['product'] = array();
	}

	//klo udah pernah add to cart, flag =0
	$flag= 1;
	for ($i=0; $i < count($_SESSION['product']); $i++) { 
		# code...
		if ($_SESSION['product'][$i] == $_GET['id']) {
			# code...
			$flag =0;
		}
	}

	//blom pernah di add to cart
	if ($flag==1) 
	array_push($_SESSION['product'],$_GET['id']);
	
	header("location:../shopcart.php");


?>