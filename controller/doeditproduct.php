<?php
include("connect.php");

$error= "";
$price = $_POST['price'];
$stock = $_POST['stock'];
$idproduct = $_POST['idproduct'];

//validasi price dan stock
if($price=="") $error="price must be filled";
else if (is_numeric($price) == false) $error="price must be number";
else if ($price<0) $error= "price must be greater than or equal zero";
else if($stock== "") $error="stock must be filled";
else if(is_numeric($stock) == false) $error="stock must be number";
else if($stock<0) $error="stock must be greater than or equal zero";

//klo lolos validasi
if($error==""){
	$query = "UPDATE product set price = $price,stock =$stock where ProductID=$idproduct";
	

	mysql_query($query);

	//menutup koneksi
	mysql_close($con);
			
	//balik ke home
	header("location:../product.php");

}
//klo ga lolos validasi
else header("location:../editproduct.php?error=$error & id=$idproduct");
?>