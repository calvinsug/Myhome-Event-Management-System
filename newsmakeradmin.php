<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
    
    <head>
        
        <script src="assets/library/jquery-2.1.1.js"></script>  
        <script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />


        <script type="text/javascript">

        $(".addNews").fancybox({
                maxWidth    : 800,
                maxHeight   : 450,
                fitToView   : false,
                width       : '70%',
                height      : '100%',
                autoSize    : false,
                closeClick  : false,
                type: 'iframe',
        });

        $(".updateNews").fancybox({
                maxWidth    : 800,
                maxHeight   : 450,
                fitToView   : false,
                width       : '70%',
                height      : '100%',
                autoSize    : false,
                closeClick  : false,
                type: 'iframe',
            });



        </script>


    </head>

    <body>
        <?php include("headeradmin.php");?>
            <div id="contentadmin">
                <div class="headercontentadmin">News</div>
                <div class="clear"></div>
                <div class="fieldcontentadmin">
                    <div class="subheaderadmin">
                        
                       <div class="adminicon">
                            <a href="popup/addNews.php" class="addNews">
                                <img src="assets/images/createnewsicon2.png"/>
                                Create News
                            </a>
                            
                        </div>
                        <div class="adminicon">
                            <a href="newsmakeradmin.php">
                                <img src="assets/images/createnewsicon2.png"/>
                                News Maker
                            </a>
                        </div>  
                        <hr/>
                    </div>
                    <div>
                        <form method="post" action="newsmakeradmin.php">
                            <div align="center" class="font">
                            Search News by Title
                            <input type="text" name="username"/> 
                            <input type="submit" value="Search" />
                            </div>
                        </form>

                        <table class="tableadmin">

                            <tr class="colortableheader" align="center">
                                
                                <td>News Title</td>
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

                                $query = "select * from news a join staff b on a.StaffID=b.StaffID where title like '%$search%' limit $offset,$dataPerPage";

                                $result = mysql_query($query);
                                $i=0;
                                while($row=mysql_fetch_array($result)){
                                    

    
                            ?>
                                <tr align="center" <?php if($i % 2 ==1) echo 'class="colortablecontent"';?>>
                                    
                                    <td><?php echo $row['Title'];?></td>
                                    <td><?php echo $row['StaffName'];?></td>
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
                                $query3 = "select count(*) as jmlhData from news where title like '%$search%' ";
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