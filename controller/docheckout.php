<?php
	session_start();
	include("connect.php");
	$huruf=0;
	$error = "";
	$grandtotal = 0;
	$useridonline = $_SESSION['useridonline'];
	for ($i=0; $i < count($_SESSION['product']); $i++) { 
		# code...

		$quantity = $_POST["quantity$i"];
		
		//buat cek ada berapa jumlah huruf
		for ($j=0; $j < strlen($quantity); $j++) 
			if (!is_numeric($quantity[$j]) && $quantity[$j]!='-') 
				$huruf++;
		



		$id=$_SESSION['product'][$i];
		$query = "select * from product p join category c on p.CategoryID=c.CategoryID where ProductID=$id";	

		$result = mysql_query($query);
		$row = mysql_fetch_array($result);

		//klo ada huruf ya error
		if($huruf>0) $error="quantity must contain only numerical character";
		//kudu lbih dari 0
		else if($quantity <= 0) $error="quantity must greater than 0";
		//ngaco bro klo stocknya minus
		else if($quantity>$row['Stock']) $error="quantity must equals or less then Stock";
		?>

		total = <?php echo $quantity*$row['Price']?> , 
		<?php
		$grandtotal+=$quantity*$row['Price'];
	}


	if($error==""){
			$date=date('Y-m-d');
			$queryheader="insert into salesheader(MemberID,SalesDate) values('$useridonline','$date')";
			mysql_query($queryheader);

			$queryidheader= "select max(SalesID) from salesheader";
			$resultid= mysql_query($queryidheader);
			$rowid= mysql_fetch_array($resultid);


			for ($i=0; $i < count($_SESSION['product']); $i++) { 
				$quantity = $_POST["quantity$i"];
				$id=$_SESSION['product'][$i];

				$query = "select * from product where ProductID=$id";	
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				$stock = $row['Stock'] - $quantity;

				$queryupdate = "update product set Stock=$stock where ProductID='$id'";
				mysql_query($queryupdate);
				$querydetail = "insert into detailsales values('$rowid[0]','$id','$quantity')";
				mysql_query($querydetail);
			}

			unset($_SESSION['product']);
			header("location:../home.php");
			
			
	}
	else header("location:../shopcart.php?error=$error");
	
?>