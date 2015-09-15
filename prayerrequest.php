<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<script src="assets/library/jquery-2.1.1.js"></script>	
	    <script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />


		<script type="text/javascript">
		$(document).ready(function(){

			$(".sendPrayer").fancybox({
					maxWidth	: 800,
					maxHeight	: 450,
					fitToView	: false,
					width		: '70%',
					height		: '100%',
					autoSize	: false,
					closeClick	: false,
					type: 'iframe'
			});

			$(".viewPrayer").fancybox({
					maxWidth	: 800,
					maxHeight	: 450,
					fitToView	: false,
					width		: '70%',
					height		: '100%',
					autoSize	: false,
					closeClick	: false,
					type: 'iframe'
			});
		
		});
		</script>

	</head>
	<body>
		<div id="container">
			<?php
				include("header.php");
				if(!isset($_SESSION['MemberID']))
					header("location:notfound.php");
				if(isset($_SESSION['MemberID']))
					$MemberID = $_SESSION['MemberID'];
			?>
			<div id="content">
				<div class="form">
					<div class="field">
						<h2 align="center">List Prayer Request</h2>
						<hr/>
					</div>
					
					<div align="center" class="font">
						<table width="700">
							<tr class="colortableheader" align="center">
								
								<td>SendDate</td>
								<td>Status</td>
								<td>AcceptDate</td>
								<td>Action</td>
							</tr>
							<?php 
								include("controller/connect.php");

								$dataPerPage = 5;
								$noPage = 1;

								if(isset($_REQUEST['page']))
									$noPage = $_REQUEST['page'];
								
								$offset = ($noPage-1) * $dataPerPage;
								

								$search = "";
								if(isset($_POST['search']) && $_POST['search'] != "" ){
									$search = $_POST['search'];

								$query = "select RequestID,DATE_FORMAT(SendDate,'%d %b %Y %T') as SendDate,Status,
								DATE_FORMAT(AcceptDate,'%d %b %Y %T') as AcceptDate 
								from prayerrequest where memberid= '$MemberID' and date_format(senddate,'%m/%d/%Y') = '$search'
								order by RequestID desc limit $offset, $dataPerPage";	
								}
								else {

									$query = "select RequestID,DATE_FORMAT(SendDate,'%d %b %Y %T') as SendDate,Status,
								DATE_FORMAT(AcceptDate,'%d %b %Y %T') as AcceptDate 
								from prayerrequest where memberid= '$MemberID' order by RequestID desc limit $offset, $dataPerPage";
								}
									

								$result = mysql_query($query);
								$i=0;
								
								while($row=mysql_fetch_array($result)){
									

							?>
					
							<tr align="center" <?php if($i%2==1) echo 'class="colortablecontent"';?>>
								<td><?php echo $row['SendDate'];?></td>
								
								<td><?php echo $row['Status']?></td>
								<td><?php 
									if($row['AcceptDate'] != NULL)
										echo $row['AcceptDate'];
									else echo '-';
									?>
								</td>	
								<td class="popup"><a href="popup/viewPrayer.php?RequestID=<?php echo $row['RequestID'];?>" class="viewPrayer"><input class="button" type="button" value="View Details"></a></td>
							</tr>
							
							<br/>
							<?php
								
								$i++;
								}

							?>
						</table>
						<br/><br/>
						<div class="font paging">
                                	
							<?php 
										//untuk mengetahui jumlah data
									

									if(isset($_POST['search']) && $_POST['search'] != "" ){
										$search = $_POST['search'];

									$query3 = "select count(*) as jmlhData 
									from prayerrequest where memberid= '$MemberID' and date_format(senddate,'%m/%d/%Y') = '$search'";	
									}
									else {

										$query3 = "select count(*) as jmlhData 
												from prayerrequest where memberid= '$MemberID' ";
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
                        <br/><br/>
						<?php 
                        	if(isset($_SESSION['MemberID'])){


                        ?>
                        
                        		<div class="popup">
		                        <a href="popup/addPrayerRequest.php" class="sendPrayer">
		                        	<input class="button" type='button' value='Send Prayer Request'>
		                        </a>
		                    	</div>
		                 <br/><br/>
                        <?php 
                    		}
                        ?>
					</div>
				</div>
			</div>
			<?php 
				include("footer.php");
			?>
		</div>
	</body>
</html>