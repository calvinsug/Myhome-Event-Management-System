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

			<?php 
					

	            if(isset($_GET['success'])){
	            	$success= $_GET['success'];

	            	if($success == 1){

		    ?>	
		     			alert('Approve Testimony Success.');
				    <?php
				    }
				     	else if($success == 2){
				    ?>
					     	alert('Hide Testimony Success.');
		
				    <?php	
				    	}
				    ?>



			     	location.href('testimonyadmin.php');
		    <?php    	
		          } 
		    ?>


			$(".updateTestimony").fancybox({
					maxWidth	: 800,
					maxHeight	: 450,
					fitToView	: false,
					width		: '70%',
					height		: '100%',
					autoSize	: false,
					closeClick	: false,
					type: 'iframe'
			});
			
			$('input[name="search"]').datepicker();

		});
		</script>

	</head>

	<body>
		<div id="container">
			<?php include("headeradmin.php");?>

			<div id="contentadmin">
				<div class="headercontentadmin">Testimony</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<br/>
					<div>
						<form method="post" action="testimonyadmin.php">
                        <div align="center" class="font">
                        Search Testimony by Date
                        <input type="text" name="search"/> 
                        <input type="submit" value="Search" />
                        </div>
                         </form>
						<table class="tableadmin">
							<tr class="colortableheader" align="center">
								<td>CreateDate</td>
								<td>Title</td>
								<td>Description</td>
								<td>Status</td>
								<td>MemberName</td>
								<td>Action</td>
							</tr>

							<?php 
								include("controller/connect.php");

								$dataPerPage = 3;
                                $noPage = 1;

                                if(isset($_REQUEST['page']))
                                    $noPage = $_REQUEST['page'];
                                
                                $offset = ($noPage-1) * $dataPerPage;

								$search = "";
								if(isset($_POST['search']) && $_POST['search'] != "" ){
									$search = $_POST['search'];

								$query = "select a.TestimonyID,DATE_FORMAT(CreateDate,'%d %b %Y %T') as CreateDate,Status,Title,Description,MemberName
								from testimony a join member b on a.memberid=b.memberid where date_format(createdate,'%m/%d/%Y') = '$search'
								order by TestimonyID desc limit $offset, $dataPerPage";	


								}
								else {

									$query = "select a.TestimonyID,DATE_FORMAT(CreateDate,'%d %b %Y %T') as CreateDate,Status,Title,Description,MemberName
								from testimony a join member b on a.memberid=b.memberid order by TestimonyID desc limit $offset, $dataPerPage";
								}

								//echo $query;die;
								/*$query = "select a.TestimonyID,DATE_FORMAT(CreateDate,'%d %b %Y %T') as CreateDate,Status,Title,Description,MemberName 
										from testimony a join member b on a.memberid= b.memberid order by a.TestimonyID desc";
*/
								$result = mysql_query($query);
								$i=0;
								
								while($row=mysql_fetch_array($result)){
									

							?>

							<tr align="center" <?php if($i%2==1) echo 'class="colortablecontent"';?>>
								<td><?php echo $row['CreateDate'];?></td>
								<td><?php echo $row['Title'];?></td>
								<td><?php echo $row['Description'];?></td>
								<td><?php echo $row['Status'];?></td>
								<td><?php echo $row['MemberName'];?></td>
								<td class="popup">
									<a href="popup/updateTestimony.php?id=<?php echo $row['TestimonyID'];?>&Title=<?php echo $row['Title'];?>&Description=<?php echo $row['Description'];?>" class="updateTestimony">
										<input type="button" value="Update">
									</a>
									<?php 
										if($row['Status'] == "pending"){
									?>
									<a href="controller/doChangeTestimony.php?show=1&id=<?php echo $row['TestimonyID'];?>">
										<input type="button" value="Approve"/>
									</a>
									<?php
										}
										else if($row['Status'] == "approved"){
									?>		
									<a href="controller/doChangeTestimony.php?show=0&id=<?php echo $row['TestimonyID'];?>">
										<input type="button" value="Hide"/>
									</a>

									<?php
										}
									?>
								</td>
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
                                $query3 = "select count(*) as jmlhData from testimony where title like '%$search%' ";
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