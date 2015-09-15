<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<script src="assets/library/jquery-2.1.1.js"></script>
<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

<script>
$( document ).ready(function() {
		

		$(".addLocation").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

		$(".updateLocation").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

		/*$(".updateBranch").click(function(){
			var x = $(this);

			console.log(x.parent().parent().html());

			data = {nama : 'calvin' , age : 22};
			//console.log(data);
		});
		*/

});


</script>

<html>
	
	<body>
		<div id="container">
			<?php include("headeradmin.php"); ?>
			<div id="contentadmin">
				<div class="headercontentadmin">Location</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<?php include('headerevent.php');?>
						

					<div>
						<form method="post" action="locationadmin.php">
                        <div align="center" class="font">
                        Search Location by Location Name
                        <input type="text" name="search"/> 
                        <input type="submit" value="Search" />
                        </div>
                         </form>
						<table class="tableadmin">
							<?php if($StaffRole != "President"){?>
							<tr>
								<td>
									<div class="adminicon2">
										<a href="popup/addLocation.php" class="addLocation">
											<img src="assets/images/addlocation.png"/>
											Create Location
										</a>
									</div>
								</td>
							</tr>
							<?php } ?>
							<tr class="colortableheader" align="center">
								<td>Location Name</td>
								<td>Location Address</td>
								<?php 
								if($StaffRole != "President"){
									echo '<td>Action</td>';
								}	
								?>

							</tr>

							<?php 
								include("controller/connect.php");

								$dataPerPage = 5;
                                $noPage = 1;

                                if(isset($_REQUEST['page']))
                                    $noPage = $_REQUEST['page'];
                                
                                $offset = ($noPage-1) * $dataPerPage;

								$search="";
								if(isset($_POST['search'])){
								    $search = $_POST['search'];
								}

								$query = "select * from location where LocationName like '%$search%' limit $offset,$dataPerPage";

								$result = mysql_query($query);
								$i=0;
								while($row=mysql_fetch_array($result)){
									
							?>
								<tr align="center" <?php if($i %2 ==1) echo "class='colortablecontent'"; ?> >
									
									
									<td><?php echo $row['LocationName'];?></td>
									<td><?php echo $row['LocationAddress'];?></td>
									<?php if($StaffRole != "President"){ ?>
									<td class="popup"><a href="popup/updateLocation.php?id=<?php echo $row['LocationID'];?>&
										lat=<?php echo $row['LocationLatitude'];?>&
										lng=<?php echo $row['LocationLongitude'];?>&
										address=<?php echo $row['LocationAddress'];?>&
										name=<?php echo $row['LocationName'];?>" class="updateLocation"><input type="button" value="Update">
									</a></td>
									<?php } ?>
								</tr> 

							<?php
								$i++;
								}		
							?>

							
						</table>
						<br/><br/>  
						<div class="font paging">
                        	<?php 
                                    //untuk mengetahui jumlah data
                                $query3 = "select count(*) as jmlhData from location where LocationName like '%$search%'";
                                $result2 = mysql_query($query3);
                                $data = mysql_fetch_array($result2);
                                $jmlhData = $data['jmlhData'];
                                
                                //echo $query3;
                                //echo $jmlhData;
                                $prev = $noPage-1;

                                $jmlhPage = ceil($jmlhData / $dataPerPage);
                                //echo $jmlhPage;die;
                                if($noPage > 1) echo "<a href='{$_SERVER['PHP_SELF']}?page=1'> <img src='assets/images/first.png'> </a>"; 
                                if($noPage > 1) echo "<a href='{$_SERVER['PHP_SELF']}?page=$prev'> <img src='assets/images/prev.png'> </a>"; 
                        

                                for($page = 1 ; $page <= $jmlhPage; $page++){
                                
                                    if($page == $noPage)    
                                        echo "<b>$page</b>";
                                    else echo "<a href='{$_SERVER['PHP_SELF']}?page=$page'> $page </a>";
                                
                                }   
                                $next = $noPage+1;

                                if($noPage < $jmlhPage) echo "<a href='{$_SERVER['PHP_SELF']}?page=$next'> <img src='assets/images/next.png'> </a>"; 
                                if($noPage < $jmlhPage) echo "<a href='{$_SERVER['PHP_SELF']}?page=$jmlhPage'> <img src='assets/images/last.png'> </a>"; 
                            
                            ?>
                        </div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</body>
</html>