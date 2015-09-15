<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<script src="assets/library/jquery-2.1.1.js"></script>
<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

<script>
$( document ).ready(function() {
        

        $(".addBranch").fancybox({
            maxWidth    : 800,
            maxHeight   : 450,
            fitToView   : false,
            width       : '70%',
            height      : '100%',
            autoSize    : false,
            closeClick  : false,
            type: 'iframe'
        });

        $(".updateBranch").fancybox({
            maxWidth    : 800,
            maxHeight   : 450,
            fitToView   : false,
            width       : '70%',
            height      : '100%',
            autoSize    : false,
            closeClick  : false
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
                <div class="headercontentadmin">Branch Maker</div>
                <div class="clear"></div>
                <div class="fieldcontentadmin">
                    <div class="subheaderadmin">
                        
                        <div class="adminicon">
                            <a href="popup/addBranch.html" class="addBranch">
                                <img src="assets/images/newbranchicon2.png"/>
                                Create Branch
                            </a>
                        </div>
                        <div class="adminicon">
                            <a href="branchmakeradmin.php">
                                <img src="assets/images/branchmaker.png"/>
                                Branch Maker
                            </a>
                        </div>
                        <hr/>
                    </div>
                    <div>
                        <form method="post" action="branchmakeradmin.php">
                        <div align="center" class="font">
                        Search Branch Maker by Branch Address
                        <input type="text" name="username"/> 
                        <input type="submit" value="Search" />
                        </div>
                         </form>
                        <table class="tableadmin">

                            <tr class="colortableheader" align="center">
                                
                                <td>BranchAddress</td>
                                <td>Staff Name</td>

                            </tr>

                            <?php 
                                include("controller/connect.php");

                                $dataPerPage = 5;
                                $noPage = 1;

                                if(isset($_REQUEST['page']))
                                    $noPage = $_REQUEST['page'];
                                
                                $offset = ($noPage-1) * $dataPerPage;

                                $search="";
                                if(isset($_POST['username'])){
                                    $search = $_POST['username'];
                                }

                                $query = "select * from branch a join staff b on a.StaffID=b.StaffID where BranchAddress like '%$search%' LIMIT $offset,$dataPerPage ";

                                $result = mysql_query($query);
                                $i=0;
                                while($row=mysql_fetch_array($result)){
                                    if($i % 2 ==0){

    
                            ?>
                                <tr align="center">
                                    
                                    <td><?php echo $row['BranchAddress'];?></td>
                                    <td><?php echo $row['StaffName'];?></td>
                                </tr> 

                            <?php 
                                    }
                                    else{

                            ?>
                            
                            <tr class="colortablecontent" align="center">
                                
                                    <td><?php echo $row['BranchAddress'];?></td>
                                    <td><?php echo $row['StaffName'];?></td>
                            </tr>

                            <?php
                                    }
                                $i++;
                                }       
                            ?>

                            
                        </table>
                        <br/><br/>  
                        <div class="popup font paging">
                            <?php 
                                    //untuk mengetahui jumlah data
                                $query3 = "select count(*) as jmlhData from branch where BranchAddress like '%$search%'";
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