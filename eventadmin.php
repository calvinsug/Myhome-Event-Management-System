<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<script src="assets/library/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

<script>
$( document ).ready(function() {
		

		$(".addEvent").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

		$(".updateEvent").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

});


</script>



	<body>
		
		 <div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=296401307235561&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
 
				<?php include("headeradmin.php"); ?>

			<div id="contentadmin">
				<div class="headercontentadmin">Event</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<?php include('headerevent.php'); ?>
					

					<div>
						<form method="post" action="eventadmin.php">
                        <div align="center" class="font">
                        Search Event by Title
                        <input type="text" name="username"/> 
                        <input type="submit" value="Search" />
                        </div>
                         </form>

						<table class="tableadmin">
							<?php if($StaffRole != "President"){?>
							<tr>
								<td>
									<div class="adminicon2">
										<a href="popup/addEvent.php" class="addEvent">
										<img src="assets/images/neweventicon2.png"/>
										Create Event
										</a>
									</div>
								</td>
							</tr>
							<?php } ?>
							<tr class="colortableheader" align="center">
								
								<td>Event Photo</td>
								<td>EventTitle</td>
								<td>EventType</td>
							
								<td>StartDate</td>
								<td>EndDate</td>
								<td>PaymentType</td>
								<td>RegistrationFee</td>
								<td>Capacity</td>
								<?php 
								if($StaffRole != "President"){
									echo '<td>Action</td>';
								}
								?>
	
							</tr>

							<?php 
								include("controller/connect.php");

								$dataPerPage = 3;
                                $noPage = 1;

                                if(isset($_REQUEST['page']))
                                    $noPage = $_REQUEST['page'];
                                
                                $offset = ($noPage-1) * $dataPerPage;

								$search="";
								if(isset($_POST['username'])){
								    $search = $_POST['username'];
								}

								$query = "select * from event where eventTitle like '%$search%' order by eventid desc limit $offset, $dataPerPage";

								$result = mysql_query($query);
								$i=0;
								while($row=mysql_fetch_array($result)){
									
							?>
									<tr align="center" <?php if($i % 2 ==1) echo 'class="colortablecontent"'?>  >
										
										<td><img style="width:120px;height:100px" src="assets/images/photoevent/<?php echo $row['EventPhoto']?>" class="newspicture"/></td>
										<td><?php echo $row[1];?></td>
										<td><?php echo $row[2]?></td>
										
										<td><?php echo $row['StartDate']?></td>
										<td><?php echo $row['EndDate']?></td>
										<td><?php echo $row['PaymentType']?></td>
										<td><?php echo $row['RegistrationFee']?></td>
										<td><?php echo $row['Capacity']?></td>
										<?php if($StaffRole != "President"){ ?>
										<td class="popup"><a href="popup/updateEvent.php?EventID=<?php echo $row['EventID'];?>" class="updateEvent">
										<input type="button" value="Update"></a>
										
										
										<!-- <div class="fb-share-button" data-href="http://localhost:8080/myhome/eventdetails.php?EventID=<?php echo $row['EventID']?>" data-layout="button"></div>
										<a class="twitter-share-button" 
										  href="https://twitter.com/share"
										  data-url="http://localhost:8080/myhome/eventdetails.php?EventID=<?php echo $row['EventID']?>"
										  data-related="twitterdev"
										  data-size="medium"
										  data-count="none">
										Tweet 
										</a>
										<script>
										window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
										</script> --> 
			
										</td>
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
                                $query3 = "select count(*) as jmlhData from event where eventTitle like '%$search%' ";
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