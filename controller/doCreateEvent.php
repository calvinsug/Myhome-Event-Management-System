<?php
	$error = "";

	$title = $_POST['title'];
	$desc = $_POST['desc'];
		
	$image = $_FILES['img']['name'];

	$CreateDate = date('Y-m-d G:i:s');	
	$eventType = $_POST['eventType'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$Capacity = $_POST['capacity'];
	$paymentType = $_POST['price'];

	if($paymentType == 'free') 
		$ticketPrice = 0;
	else if($paymentType == 'paid')
		$ticketPrice = $_POST['ticketPrice'];

			
	//kalo lolos validasi
	if($error==""){
		//untuk connect ke database
		include("connect.php");

		$query = "select max(EventID) from Event";

		$result = mysql_query($query);

		if(mysql_num_rows($result) > 0){
			$row=mysql_fetch_array($result);

			$EventID = substr($row[0],3,4);

			$id= intval($EventID) +1;
			
			$id = str_pad($id, 4, '0', STR_PAD_LEFT);

			$EventID = 'EVE' . $id;
		}
		else{

			$EventID = 'EVE0001';
		} 

		$query ="insert into event(EventID,EventTitle,EventType,EventDesc,StartDate,EndDate,EventPhoto,PaymentType,RegistrationFee,Capacity) 
			values('$EventID','$title','$eventType','$desc','$startDate','$endDate','$image','$paymentType','$ticketPrice','$Capacity')"; 
		
		//echo $query;die;

		//insert ke database MySQL
		mysql_query($query);



		//upload file ke folder image
		move_uploaded_file($_FILES['img']['tmp_name'], "../assets/images/photoevent/".$image);
	
		//menutup koneksi
		mysql_close($con);
		
		echo 'Create Event Success';
		header("location:../popup/addEvent.php?success=1");
	}
	//klo gk lolos validasi
	else{	
		header("location:../popup/addEvent.php?error=".$error);
	}
	
?>