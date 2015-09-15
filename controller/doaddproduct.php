<?php 
	include("connect.php");

	$error = "";
	$productname= $_POST['productname'];
	$stock = $_POST['stock'];
	$price = $_POST['price'];
	$image = $_FILES['imgproduct']['name'];
	$categoryid = $_POST['categoryid'];


	//mulei validasi
	if($productname== "") $error = "product name must be filled";
	else if($categoryid=="") $error = "category must be chosen";
	else if($image == "") $error = "image must be chosen";
	else if($_FILES["imgproduct"]["type"] != "image/jpeg" && $_FILES["imgproduct"]["type"] != "image/png" && $_FILES["imgproduct"]["type"] != "image/jpg")
		$error="Format file must be '.jpeg', '.jpg', or '.png'";	
	else if($stock=="") $error = "stock must be filled";
	else if(!is_numeric($stock)) $error= "stock must contain only numeric character";
	else if($stock <0) $error= "stock must greater than or equal zero";
	else if($price=="") $error = "price must be filled";
	else if(!is_numeric($price)) $error= "price must contain only numeric character";
	else if($price <0) $error= "price must greater than or equal zero";
	

	if($error==""){
	$query= "insert into product(categoryid,name,stock,price,image) values($categoryid, '$productname' , $stock, $price, '$image')";
	mysql_query($query);
	//upload file ke folder image
	move_uploaded_file($_FILES['imgproduct']['tmp_name'], "../asset/images/toys/".$_FILES['imgproduct']['name']);


	//menutup koneksi
	mysql_close($con);
		
	header("location:../product.php");	
	}
	else{

		header("location:../addproduct.php?error=$error");
	} 


?>