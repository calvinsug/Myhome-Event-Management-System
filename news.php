<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	
	</head>
	<body>
		<div id="container">
			
		<?php
			include('header.php');
		?>

			<div id="content">
				<div class="form">
					<div class="field">
						<h2 align="center">News</h2>
						<hr/>
					</div>
					<div align="center">
						<table class="tablemember">

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

								$query = "select * from news where Title like '%$search%' order by NewsID desc limit $offset, $dataPerPage";

								//echo $query;die;
								$result = mysql_query($query);
								//$i=0;
								while($row=mysql_fetch_array($result)){
									//if($i % 2 ==0){


							?>
							<tr class="font">
								<td colspan="2"><b><?php echo $row['Title'];?></b></td>
							</tr>

							<tr class="colortablecontent">
								<td><img width="200px" height="144px" src="assets/images/photonews/<?php echo $row['Photo']?>" class="newspicture"/></td>
								
								<td>
									<table>
										<tr>
											<td class="newstext2">
												<?php 

												$desc = $row['Description'];
												//echo strlen($desc);
												if (strlen($desc) > 300) {
													// truncate string
													$desc = substr($desc, 0, 300);
													echo $desc.'...';
												}
												else 
												echo $desc;

												?>
											</td>
										</tr>
										<tr>
											<td>
												<?php if(strlen($row['Description']) > 300){ ?>
												<div class="popup"><a href="newsdetails.php?NewsID=<?php echo $row['NewsID']?>">Continue reading</a></div>

												<?php }?>
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
										$query3 = "select count(*) as jmlhData from news where Title like '%$search%'";
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