<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	
	<body>
		<div id="container">
			<?php include("headeradmin.php"); ?>
			<?php include("controller/connect.php");?>
            
       			<div id="contentadmin">
				<div class="headercontentadmin">Member</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<div class="subheaderadmin">
						<div class="adminicon">
                            <a href="adoptstreetadmin.php">
                                <img src="assets/images/adoptstreet.png"/>
                                Adopt Street
                            </a>
                        </div>
						<hr/>
					</div>
					<div>
                        <form method="post" action="memberadmin.php">
                        <div align="center" class="font">
                        Search Member by Username
                        <input type="text" name="username"/> 
                        <input type="submit" value="Search" />
                        </div>
                         </form>
                         <?php 

                                $dataPerPage = 5;
                                $noPage = 1;

                                if(isset($_REQUEST['page']))
                                    $noPage = $_REQUEST['page'];
                                
                                $offset = ($noPage-1) * $dataPerPage;

								$search="";
								if(isset($_REQUEST['username'])){
								 $search = $_REQUEST['username'];
								}
								
								$query = "select * FROM member where username like '%$search%' limit $offset, $dataPerPage";
								
								$result = mysql_query($query);
								$i=0;
						?>
                        
						
                        
                    		<table class="tableadmin">		
                                <tr class="colortableheader" align="center">
                                                    
                                    <td>Member Photo</td>
                                    <td>Username</td>
                                    <td>MemberName</td>
                                    <td>MemberAddress</td>
                                    <td>MemberEmail</td>
                                    <td>MemberPhone</td>

                                </tr>	
                                <?php   
                                    while($row=mysql_fetch_array($result)){
                                        $MemberID = $row[0];
                                        $query2 = "select * from member a join phonemember b on a.memberid = b.memberid where a.MemberID= '$MemberID'";
                                        $result2 = mysql_query($query2);
                                ?>	
                    		    <tr align="center" <?php if($i % 2 ==1) echo 'class="colortablecontent"'?>  >
                                    <td> <div align="center"><img width="50px" height="50px" src="assets/images/photomember/<?php echo $row['MemberPhoto']?>" /> </</div></td>
                            
                                    <td width="350"> <?php echo $row[1]?> </td>

                                    <td width="350"> <?php echo $row[3]?> </td>

                                    <td width="350"> <?php echo $row[4]?> </td>

                                    <td width="350"> <?php echo $row[5]?> </td>

                                    <td width="350"> 
                                        <?php 
                                            $row2 = mysql_fetch_array($result2);
                                            echo $row2['PhoneNumber'];
                                            while ($row2 = mysql_fetch_array($result2)) {
                                                echo ', '.$row2['PhoneNumber'];
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
                                    $query3 = "select count(*) as jmlhData from member where username like '%$search%' ";
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