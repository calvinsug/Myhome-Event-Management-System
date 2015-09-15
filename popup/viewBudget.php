<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>

		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="../assets/css/jquery-ui.css">
		<script src="../assets/library/jquery-ui.js"></script>

		<script src="../assets/library/tiny_mce/tiny_mce.js"></script>

		<!-- Datepicker  
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css">
		-->

		<script>

			$( document ).ready(function() {
				$('.btnUpdate').hide();
				<?php 
		          if(isset($_GET['success'])){
			    		$success = $_GET['success'];

			    		//delete
			    		if($success == 1){
			    ?>
			     	
			     	//javascript:parent.$.fancybox.close();

			     	alert('Delete Budget Success');
			     	
			     	//location.reload();
			    <?php  
			    		}
			    		else if($success ==2){
				 ?>
							     	
			     	//javascript:parent.$.fancybox.close();

			     	alert('Update Budget Success');
			     	
			     	//location.reload();
			    <?php  

			    		}

		          } 
 					
 					session_start();

					$EventID = "";
					$EventTitle = "";

					if(isset($_GET['EventID']))
						$EventID = $_GET['EventID'];

					if(isset($_GET['EventTitle']))
						$EventTitle = $_GET['EventTitle'];

					if(isset($_SESSION['StaffRole']))
						$StaffRole = $_SESSION['StaffRole'];

					include("../controller/connect.php");

					$query = "select EventTitle,DivisionName,BudgetID, BudgetDescription,BudgetExpected,BudgetActual
							from BudgetEvent a join event b on a.eventid = b.eventid 
							join division c on a.divisionid = c.divisionid
							where a.eventid = '$EventID'
							order by DivisionName asc" ;


					$result = mysql_query($query);

				?>

				$('.btnEdit').click(function(e){

					var x = $(this);

					x.hide();

					$(".Actual"+x.attr('id')).removeAttr("readonly");
					$(".Expected"+x.attr('id')).removeAttr("readonly");
					$(".Description"+x.attr('id')).removeAttr("readonly");

					//console.log($('.btnUpdate').attr('id',x.attr('id'));

					$('.update'+x.attr('id')).show();


				});

			

			    $('.btnUpdate').click(function(e){
			    	var x = $(this);
			    	var BudgetActual = $(".Actual"+x.attr('id')).val();
			    	var BudgetExpected = $(".Expected"+x.attr('id')).val();
			    	var BudgetDescription = $(".Description"+x.attr('id')).val();

			    	$('input[name="BudgetID"]').val(x.attr('id'));
			    	$('input[name="BudgetActual"]').val(BudgetActual);
			    	$('input[name="BudgetExpected"]').val(BudgetExpected);
			    	$('input[name="BudgetDescription"]').val(BudgetDescription);

			    	$('#formRegis').submit();
			    });

		    	$('.delete').click(function(e){

			    	var answer = confirm ("Are you sure to delete this Budget?");

					if (!answer){
			    		e.preventDefault();
			    	}

			    });
						
			});


    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doUpdateBudget.php" id="formRegis">
			
							<div id="newRundown">
							<div class="field">
								<h2 align="center"><?php echo $EventTitle;?></h2>
								<hr/>
							</div>
							<br/>
									
							<?php

							if(mysql_num_rows($result) == 0)
								echo 'There is no Budgeting yet.';

							
							$division="";

							while($row  = mysql_fetch_array($result)){

								//untuk pemisahan antar division
								if($division != $row['DivisionName']){
									$division = $row['DivisionName'];
							?>
								<h1>Division <?php echo $row['DivisionName'];?> 
								
								</h1>

								<div style="font-weight: bold;">	
									<div class="popupviewspace colortableheader">Budget Description</div>
									
									<div class="popupviewspace colortableheader">Budget Expected</div>
									<div class="popupviewspace colortableheader">Budget Actual</div>
									<?php if($StaffRole != "President"){ ?>
										<div class="colortableheader">Action</div>
									<?php } ?>	
								</div>
								<br/>

							<?php
								} //end of pisahin division

							?>
								<div>	
									<div class="popupviewspace"><input type="text" readonly class="Description<?php echo $row['BudgetID'];?>" value="<?php echo $row['BudgetDescription'];?>"></div>
									
									<div class="popupviewspace"><input type="text" readonly class="Expected<?php echo $row['BudgetID'];?>" value="<?php echo $row['BudgetExpected'];?>"></div>
									<div class="popupviewspace"><input type="text" readonly class="Actual<?php echo $row['BudgetID'];?>" value="<?php echo $row['BudgetActual'];?>"></div>
									<?php if($StaffRole != "President"){ ?>
										<div>
											<input type="button" class="btnEdit" id="<?php echo $row['BudgetID'];?>" value="Edit"/>
											<input type="button" class="btnUpdate update<?php echo $row['BudgetID']?>" id="<?php echo $row['BudgetID'];?>" value="Update"/>
											<a href="../controller/doDeleteBudget.php?EventTitle=<?php echo $EventTitle;?>&EventID=<?php echo $EventID;?>&BudgetID=<?php echo $row['BudgetID']?>" class="delete">
												<input type="button" value="Delete"/>
											</a>

										</div>
									<?php }?>
								</div>	
								<div class="clear"></div>
							<?php
	
							}	//end of while

							?>

							<div style="display:none">
								<input type="text" name="BudgetID" />
								<input type="text" name="BudgetActual" />
								<input type="text" name="BudgetExpected" />
								<input type="text" name="BudgetDescription" />
								<input type="text" name="EventID" value="<?php echo $EventID;?>"/>
								<input type="text" name="EventTitle" value="<?php echo $EventTitle;?>" />
							</div>

							<br/><br/>
						</div>

					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>