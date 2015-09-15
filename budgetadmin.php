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

		$('.printBudget').click(function(){
		
			window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
	 
		});

		$('.printOverallBudget').click(function(){

			var month = $('select[name="month"]').val();
			var year = $('select[name="year"]').val();

			if(month == 0){
				alert('please select Month first.');
				return false;
			} 
			else if(year == 0){
				alert('please select Year first.');
				return false;
			}

			$('.printOverallBudget').attr('href','popup/printOverallBudget.php?m='+month+'&y='+year);	
			
			window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
	 
		});

		
});


</script>



	<body>
		
		<?php include("headeradmin.php"); ?>

			<div id="contentadmin">
				<div class="headercontentadmin">Budgeting</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<?php include('headerevent.php'); ?>
					<div>
						<form method="post" action="budgetadmin.php">
                        <div align="center" class="font">
                        Search Budgeting by Event Title
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
											<a href="popup/viewBudget.php?EventTitle=<?php echo $row['EventTitle']?>&EventID=<?php echo $row[0];?>" class="viewRundown"> <input type="button" value="View" /> </a>
											<?php if($StaffRole != "President"){ ?>
											<a href="popup/addBudget.php?EventID=<?php echo $row[0];?>" class="createRundown"> <input type="button" value="Create" /> </a>
											<?php } ?>
											<input type="button" href="popup/printBudget.php?EventTitle=<?php echo $row['EventTitle']?>&EventID=<?php echo $row[0];?>" class="printBudget" value="print">
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

                        <div align="center">
                        	<select name="month">
								<option value="0" >Months...</option>
								<option value="1" >January</option>
								<option value="2" >February</option>
								<option value="3" >March</option>
								<option value="4" >April</option>
								<option value="5" >May</option>
								<option value="6" >June</option>
								<option value="7" >July</option>
								<option value="8" >August</option>
								<option value="9" >September</option>
								<option value="10" >October</option>
								<option value="11" >November</option>
								<option value="12" >December</option>
                        	</select>
                        	<select name="year">
                        		<option value="0" >Years...</option>
								<option value="2015" >2015</option>
								<option value="2014" >2014</option>
								<option value="2013" >2013</option>
								<option value="2012" >2012</option>
								<option value="2011" >2011</option>
								<option value="2010" >2010</option>
								<option value="2009" >2009</option>
								<option value="2008" >2008</option>
								<option value="2007" >2007</option>
								<option value="2006" >2006</option>
								<option value="2005" >2005</option>
								<option value="2004" >2004</option>
								<option value="2003" >2003</option>
								<option value="2002" >2002</option>
								<option value="2001" >2001</option>
								<option value="2000" >2000</option>
								<option value="1999" >1999</option>
								<option value="1998" >1998</option>
								<option value="1997" >1997</option>
								<option value="1996" >1996</option>
								<option value="1995" >1995</option>
								<option value="1994" >1994</option>
								<option value="1993" >1993</option>
								<option value="1992" >1992</option>
								<option value="1991" >1991</option>
								<option value="1990" >1990</option>
								<option value="1989" >1989</option>
								<option value="1988" >1988</option>
								<option value="1987" >1987</option>
								<option value="1986" >1986</option>
								<option value="1985" >1985</option>
								<option value="1984" >1984</option>
								<option value="1983" >1983</option>
								<option value="1982" >1982</option>
								<option value="1981" >1981</option>
								<option value="1980" >1980</option>
								<option value="1979" >1979</option>
								<option value="1978" >1978</option>
								<option value="1977" >1977</option>
								<option value="1976" >1976</option>
								<option value="1975" >1975</option>
                        	</select>
                        	<input type="button" value="Print Overall Report" class="printOverallBudget">
                        </div>

                        
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</body>
</html>