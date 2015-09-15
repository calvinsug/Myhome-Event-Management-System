<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<script src="assets/library/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

<script>
$( document ).ready(function() {
	

		$('.createRundown').fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

		$('.viewRundown').fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});


		$('.printCommittee').click(function(){

			window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");

		});
		
});


</script>



	<body>
		
		<?php include("headeradmin.php"); ?>

			<div id="contentadmin">
				<div class="headercontentadmin">Committee</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<?php include('headerevent.php'); ?>
					<div>
						<form method="post" action="detaildivisionadmin.php">
                        <div align="center" class="font">
                        Search Committee by Event Title
                        <input type="text" name="username"/> 
                        <input type="submit" value="Search" />
                        </div>
                         </form>
						<table class="tableadmin">
							<tr class="colortableheader" align="center">
								
								<td>Event Photo</td>
								<td>EventTitle</td>
								<td>Action</td>

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

								$query = "select * from event where eventTitle like '%$search%' limit $offset,$dataPerPage";

								$result = mysql_query($query);
								$i=0;
								while($row=mysql_fetch_array($result)){
									
							?>
									<tr align="center" <?php if($i % 2 ==1) echo 'class="colortablecontent"'?>  >
										
										<td><img style="width:120px;height:100px" src="assets/images/photoevent/<?php echo $row['EventPhoto']?>" class="newspicture"/></td>
										<td><?php echo $row[1];?></td>
										
										<td class="popup">
											<a href="popup/viewDetailDivision.php?EventTitle=<?php echo $row['EventTitle']?>&EventID=<?php echo $row[0];?>" class="viewRundown"> <input type="button" value="View" /> </a>
											<?php if($StaffRole != "President"){ ?>
											<a href="popup/addDetailDivision.php?EventID=<?php echo $row[0];?>" class="createRundown"> <input type="button" value="Add" /> </a>
											<?php } ?>
											<input type="button" href="popup/printCommittee.php?EventTitle=<?php echo $row['EventTitle']?>&EventID=<?php echo $row[0];?>" class="printCommittee" value="print">
										</td>
										
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