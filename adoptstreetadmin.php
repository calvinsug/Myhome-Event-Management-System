<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	
	<body>
		<div id="container">
			<?php include("headeradmin.php"); ?>
			<?php include("controller/connect.php");?>
            
       			<div id="contentadmin">
				<div class="headercontentadmin">Adopt Street</div>
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

								$search="";
								if(isset($_REQUEST['username'])){
								 $search = $_REQUEST['username'];
								}
								
								$query2 = "select * FROM member a join branch b on a.branchid=b.branchid where username like '%$search%'";
								
								$result = mysql_query($query2);
								$i=0;
						?>
                        
						
                        
                    		<table class="tableadmin">		
                                <tr class="colortableheader" align="center">

                                    <td>MemberName</td>
                                    <td>Branch Address</td>


                                </tr>	
                                <?php   
                                    while($row=mysql_fetch_array($result)){
                                ?>	
                    		    <tr align="center" <?php if($i % 2 ==1) echo 'class="colortablecontent"'?>  >


                                    <td width="350"> <?php echo $row['MemberName']?> </td>

                                    <td width="350"> <?php echo $row['BranchAddress']?> </td>


                                </tr>

                                <?php
                                        $i++;
                                    }                       
                                ?>  
                            </table>
                        <br/><br/>  
						<div class="font paging">
                                <img src="assets/images/first.png"> <img src="assets/images/prev.png"> 1 2 3 4 5 <img src="assets/images/next.png"> <img src="assets/images/last.png">
                        </div>
				        </div>
			         </div>
			     <div class="clear"></div>
			</div>
		</div>
	</body>
</html>