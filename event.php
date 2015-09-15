<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	  
	    <script src="assets/library/jquery-2.1.1.js"></script>
	    <script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
	</head>
	<body>
		<div id="container">
			
		<script>
		$( document ).ready(function() {
			$(".confirmPayment").fancybox({
				maxWidth	: 800,
				maxHeight	: 450,
				fitToView	: false,
				width		: '70%',
				height		: '100%',
				autoSize	: false,
				closeClick	: false,
				type 		: 'iframe'
			});

			$('.registerEvent').click(function(e){
				var x = $(this);

				var answer = confirm ("Are you sure to register this Event?");
				if (answer){
					
					$.ajax({
						url: "controller/doRegisterEvent.php",
						type: "POST",
						dataType: "json",
						//contentType: "application/json; charset=utf-8",
						data : {
							'EventID'  : x.attr('eventid')
						},
						success: function(data){
							console.log(data);
							if(data == '1'){
								
								alert('You have registered this event.');	
								//$('.registerEvent').remove();
								location.reload();

								//$.fancybox.close();
							}
							else{
								alert('Registration Failed.');
							}
							
						}
					});


				}

			});


		});


		</script>

		<?php


			include('header.php');
			if(isset($_SESSION['MemberID']))
				$MemberID = $_SESSION['MemberID'];

		?>

			<div id="content">
				<div class="form">
					<div class="field">
						<h2 align="center">Events</h2>
						<hr/>
					</div>
					<div align="center">
						<table>

							<?php 

								include("controller/connect.php");

								$dataPerPage = 3;
								$noPage = 1;

								if(isset($_REQUEST['page']))
									$noPage = $_REQUEST['page'];
								
								$offset = ($noPage-1) * $dataPerPage;

								$search = "";
								if(isset($_POST['search']))
									$search = $_POST['search'];

								$query = "select * from event where eventTitle like '%$search%' order by eventid desc limit $offset, $dataPerPage";

								$result = mysql_query($query);
								//$i=0;
								while($row=mysql_fetch_array($result)){
									//if($i % 2 ==0){
									$EventID = $row['EventID'];

							?>
							<tr class="font">
								<td colspan="2"><b><?php echo $row['EventTitle'];?></b></td>
							</tr>

							<tr class="colortablecontent">
								<td><img style="width:200px;height:144px" src="assets/images/photoevent/<?php echo $row['EventPhoto']?>" class="newspicture"/></td>

								<td>
									<table>
										<tr>
											<td class="newstext2">
												<?php 

												$desc = $row['EventDesc'];
												//echo strlen($desc);
												if (strlen($desc) > 300) {
													// truncate string
													$desc = substr($desc, 0, 300);
													echo $desc;
												}
												else 
												echo $desc;

												?>
											</td>
										</tr>
										<tr>
											<td>
												<span class="popup"><a href="eventdetails.php?EventID=<?php echo $row['EventID'];?>">View Detail</a></span>
												&nbsp;&nbsp; | &nbsp;&nbsp;
												<span class="popup"><a href="galleryevent.php?EventID=<?php echo $row['EventID'];?>">Gallery Event</a></span>
											</td>
										</tr>
									</table>
								</td>
							</tr>

							<?php
								}
							?>

						</table>
						<br/><br/>  
						<div class="font paging">

								
								<?php 
											//untuk mengetahui jumlah data
										$query3 = "select count(*) as jmlhData from event where eventTitle like '%$search%'";
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
					</div>
				</div>
				<div class="clear"></div>
				<br/><br/>
			</div>
			<?php
				include("footer.php");
			?>
		</div>
	</body>
</html>