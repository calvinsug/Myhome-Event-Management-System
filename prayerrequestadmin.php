<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	  	<script src="assets/library/jquery-2.1.1.js"></script>
			<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		<script src="assets/library/jquery-ui.js"></script>
	    
	    <script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />


		<script type="text/javascript">

		$(document).ready(function(){

			$(".confirmPrayer").fancybox({
				maxWidth	: 800,
				maxHeight	: 450,
				fitToView	: false,
				width		: '70%',
				height		: '100%',
				autoSize	: false,
				closeClick	: false,
				type: 'iframe',
			});

		$('input[name="search"]').datepicker();


		})
		

		</script>


	</head>
	<body>
		<div id="container">
			<?php include("headeradmin.php");?>
			<div id="contentadmin">
				<div class="headercontentadmin">Prayer Request</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<br/>
					<div>
						<form method="post" action="prayerrequestadmin.php">
                        <div align="center" class="font">
                        Search Prayer Request by Date
                        <input type="text" name="search"/> 
                        <input type="submit" value="Search" />
                        </div>
                         </form>
						<table class="tableadmin">
							<tr class="colortableheader" align="center">
								
								<td>SendDate</td>
								<td>PrayerDesc</td>
								<td>Status</td>
								<td>AcceptDate</td>
								<td>Member Name</td>
								<?php if($StaffRole != "President"){ 
									echo '<td>Confirm Request</td>';
								}
								?>

							</tr>

							<?php 
								include("controller/connect.php");

								$dataPerPage = 5;
                                $noPage = 1;
								//$BranchID = 'BRA0001';
                                if(isset($_REQUEST['page']))
                                    $noPage = $_REQUEST['page'];
                                
                                $offset = ($noPage-1) * $dataPerPage;
                                $StaffID = $_SESSION['StaffID'];
                                $queryBranch = "select BranchID from branch where StaffID ='$StaffID' ";

                                $resultBranch = mysql_query($queryBranch);

                                $rowBranch = mysql_fetch_array($resultBranch);

                                $BranchID = $rowBranch[0];
                                
                                	


								$search = "";
								if(isset($_POST['search']) && $_POST['search'] != "" ){
									$search = $_POST['search'];

								$query = "select RequestID,DATE_FORMAT(SendDate,'%d %b %Y %T') as SendDate,Status,
								DATE_FORMAT(AcceptDate,'%d %b %Y %T') as AcceptDate, PrayerDesc, MemberName 
								from prayerrequest a join member b on a.memberid=b.memberid where date_format(senddate,'%m/%d/%Y') = '$search'
								and where BranchID = '$BranchID'
								order by RequestID desc limit $offset, $dataPerPage";	
								}
								else {

									$query = "select RequestID,DATE_FORMAT(SendDate,'%d %b %Y %T') as SendDate,Status,
								DATE_FORMAT(AcceptDate,'%d %b %Y %T') as AcceptDate, PrayerDesc, MemberName 
								from prayerrequest a join member b on a.memberid=b.memberid 
								where BranchID = '$BranchID'
								order by RequestID desc limit $offset, $dataPerPage";
								}

								$result = mysql_query($query);
								$i=0;
								while($row=mysql_fetch_array($result)){
								
							?>

							<tr align="center" <?php if($i%2==1) echo 'class="colortablecontent"';?>>
								
								<td><?php echo $row['SendDate']?></td>
								<td><?php echo $row['PrayerDesc']?></td>
								<td><?php echo $row['Status']?></td>
								<td><?php echo $row['AcceptDate']?></td>
								<td><?php echo $row['MemberName']?></td>
								<?php if($StaffRole != "President"){ ?>
									<td class="popup">

										<?php
											if($row['Status'] == "pending"){

										?>
										<a href="popup/confirmPrayer.php?id=<?php echo $row['RequestID']?>" class="confirmPrayer"><input type="button" value="Confirm"></a>

										<?php
											}
										else
										
										echo "Done";	
										?>
									</td>
								<?php } ?>
							</tr>

							<?php 
									
								
								$i++;
								}		
							?>

						</table>
						<br/><br/>  
						<div class="popup font paging">
                           <?php 
									//untuk mengetahui jumlah data
								

								if(isset($_POST['search']) && $_POST['search'] != "" ){
									$search = $_POST['search'];

								$query3 = "select count(*) as jmlhData 
								from prayerrequest a join member b on a.memberid=b.memberid 
								where date_format(senddate,'%m/%d/%Y') = '$search'
								and BranchID = '$BranchID' ";	
								}
								else {

									$query3 = "select count(*) as jmlhData 
											from prayerrequest a join member b on a.memberid=b.memberid 
											where BranchID = '$BranchID'";
								}


								//$query3 = "select count(*) as jmlhData from prayerrequest where Title like '%$search%'";

								$result2 = mysql_query($query3);
								$data = mysql_fetch_array($result2);
								$jmlhData = $data['jmlhData'];
								
								//echo $query3;
								//echo $jmlhData;
								$prev = $noPage-1;

								$jmlhPage = ceil($jmlhData / $dataPerPage);
								//echo $jmlhPage;die;
								if($noPage > 1)	echo "<a href='{$_SERVER['PHP_SELF']}?page=1'> <img src='assets/images/first.png'> </a>"; 
	                            if($noPage > 1)	echo "<a href='{$_SERVER['PHP_SELF']}?page=$prev'> <img src='assets/images/prev.png'> </a>"; 
						

								for($page = 1 ; $page <= $jmlhPage; $page++){
								
									if($page == $noPage)	
										echo "<b>$page</b>";
									else echo "<a href='{$_SERVER['PHP_SELF']}?page=$page'> $page </a>";
								
								}	
								$next = $noPage+1;

								if($noPage < $jmlhPage)	echo "<a href='{$_SERVER['PHP_SELF']}?page=$next'> <img src='assets/images/next.png'> </a>"; 
	                            if($noPage < $jmlhPage)	echo "<a href='{$_SERVER['PHP_SELF']}?page=$jmlhPage'> <img src='assets/images/last.png'> </a>"; 
						
							?>
                        </div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</body>
</html>