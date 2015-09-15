<?php
	$error = "";

	$title = $_POST['title'];
	$desc = $_POST['desc'];
		
	$image = $_FILES['img']['name'];
	$EventID = $_POST['EventID'];

	$eventType = $_POST['eventType'];
	//$startDate = $_POST['startDate'];
	//$endDate = $_POST['endDate'];
	//$Capacity = $_POST['capacity'];
	$paymentType = $_POST['price'];

	if($paymentType == 'free') 
		$ticketPrice = 0;
	else if($paymentType == 'paid')
		$ticketPrice = $_POST['ticketPrice'];

			
	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		//echo $image;die;
		if($image != ""){
			$query ="update event set EventTitle = '$title',EventType = '$eventType',EventDesc = '$desc',
			EventPhoto = '$image',PaymentType = '$paymentType',RegistrationFee = $ticketPrice 
			where EventID = '$EventID'"; 

		//upload file ke folder image
		move_uploaded_file($_FILES['img']['tmp_name'], "../assets/images/photoevent/".$image);

		}
		else{
			$query ="update event set EventTitle = '$title',EventType = '$eventType',
					EventDesc = '$desc',PaymentType = '$paymentType',RegistrationFee = $ticketPrice
					where EventID = '$EventID'"; 
		}
		//echo $query;die;

		//insert ke database MySQL
		mysql_query($query);

		//menutup koneksi
		mysql_close($con);
		
		header("location:../popup/updateEvent.php?success=1");
	}
	//klo gk lolos validasi
	else{	
		header("location:../popup/updateEvent.php?EventID=".$EventID."&error=".$error);
	}
	
?>