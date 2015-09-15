<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<script src="assets/library/jquery-2.1.1.js"></script>	
	    <script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />


		<script type="text/javascript">
		$(document).ready(function(){

			$(".addTestimony").fancybox({
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
			?>
			<div id="content">
				<div class="form">
					<div class="field">
						<h2 align="center">List Testimony MyHome Indonesia</h2>
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

								$query = "select * from testimony a join member b on a.memberid=b.memberid where status = 'approved' order by TestimonyID desc limit $offset, $dataPerPage";

								$result = mysql_query($query);
								//$i=0;
								
								while($row=mysql_fetch_array($result)){
									//if($i % 2 ==0){


							?>
							<tr class="font">
								<td colspan="2"><b><?php echo $row['MemberName'];?></b></td>
							</tr>
							<tr class="colortablecontent">
								<td><img width="200px" height="144px" src="assets/images/photomember/<?php echo $row['MemberPhoto']?>" /></td>
								
								<td class="newstext2">
									<b><?php echo $row['Title'];?></b> <br/><br/>
									<?php echo $row['Description']?>
								</td>
							</tr>
							
								<?php
								
								//$i++;
								}

							?>
						</table>
						<br/><br/>  
						<div class="font paging">
                        	<?php 
											//untuk mengetahui jumlah data
										$query3 = "select count(*) as jmlhData from testimony where status = 'approved' ";
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
		                        <a href="popup/addTestimony.php" class="addTestimony">
		                        	<input class="button" type='button' value='Send Testimony'>
		                        </a>
		                    	</div>

                        <?php 
                    		}
                        ?>

						<br/><br/>
					</div>

				</div>
				<div class="clear"></div>
				<br/><br/>
				<!--
				<form method="post" action="controller/doInsertTestimony">
						<div class="field">
							<h2 align="center">Give Testimony</h2>
							<hr/>
						</div>
						<br/>
						<div class="field">
							<span>Title</span>
							<span><input type="text" name="Title" class="textbox"/></span>
						</div>
						
						<div class="field">
							<span>Description</span>
							<span><textarea class="textarea" name="Description"></textarea></span>
						</div>
						<br/><br/>
						<div class="field">
							<div class="submit"><input type="submit" value="Send Testimony" class="sizesubmit"/></div>
						</div>
						<br/><br/>
				</form>
			-->
			</div>
			<?php
				include("footer.php");
			?>
		</div>
	</body>
</html>