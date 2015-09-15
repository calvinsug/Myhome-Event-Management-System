<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/slider.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/animation.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <script src="assets/library/filejavascript.js"></script>
	    
	    <!--<link href="assets/css/jquery.snippet.min.css" type="text/css" rel="stylesheet"/>
	    <script type="text/javascript" src="assets/library/jquery_v_1.4.js"></script>-->	  
	    <link href="assets/css/jquery_notification.css" type="text/css" rel="stylesheet"/>
	    <script type="text/javascript" src="assets/library/jquery_notification_v.1.js"></script>

  
	</head>

	<?php
		include("header.php");
	?>

	<?php
        if (isset($_GET["login"])) {
           
    ?>
             <script type="text/javascript">
             	$(document).ready(function(){

	         		showNotification({
	                    message: "You have successfully logged in.",
	                    //type: "success"
	                    autoClose: true,
	                    duration: 2                                        
	                });
	                //$('#info_message').css('margin-left','350px');

             	});
               
            </script>
    <?php
        }
    ?>
	<body>
	<!--<body>-->
		<div id="container">
			
			<div id="content">
				<div class="containerslide">
                    <div id="content-slider">
                        <div id="slider">
                            <div id="mask">
                            <ul>
                            <li id="first" class="firstanimation">
                            <a href="#">
                            <img class="img" src="assets/images/imageslide/Myhome1.jpg" alt="Cougar"/>
                            </a>
                            </li>
                
                            <li id="second" class="secondanimation">
                            <a href="#">
                            <img class="img" src="assets/images/imageslide/Myhome2.jpg" alt="Lions"/>
                            </a>
                            </li>
                            
                            <li id="third" class="thirdanimation">
                            <a href="#">
                            <img class="img" src="assets/images/imageslide/Myhome3.jpg" alt="Snowalker"/>
                            </a>
                            </li>
                                        
                            <li id="fourth" class="fourthanimation">
                            <a href="#">
                            <img class="img" src="assets/images/imageslide/Myhome4.jpg" alt="Howling"/>
                            </a>
                            </li>
                                        
                            <li id="fifth" class="fifthanimation">
                            <a href="#">
                            <img class="img" src="assets/images/imageslide/Myhome5.jpg" alt="Sunbathing"/>
                            </a>
                            </li>
                            </ul>
                            </div>
                            <div class="progress-bar"></div>
                        </div>
                    </div>
               	</div>	



				<div class="clear"></div>
				<br/><br/>

				<?php 
					include("controller/connect.php");

					$query = "select * from news order by NewsID desc LIMIT 3";

					$result = mysql_query($query);
					//$i=0;
					while($row=mysql_fetch_array($result)){
						//if($i % 2 ==0){


				?>

				<div class="news">
					<h2><?php echo $row['Title']?></h2>
					<img style="width:200px;height:144px" src="assets/images/photonews/<?php echo $row['Photo']?>" class="newspicture"/>
					<div class="newstext">
						<?php 

							$desc = $row['Description'];
							//echo strlen($desc);
							if (strlen($desc) > 340) {
							// truncate string
							$desc = substr($desc, 0, 340);
							echo rtrim($desc).'...';
							}
							else 
							echo $desc;

						?>
					</div>
						<?php if(strlen($row['Description']) > 340){ ?>
									<div class="buttonviewdetails popup"><a href="newsdetails.php?NewsID=<?php echo $row['NewsID']?>">Continue reading</a></div>

						<?php }?>
					<br/>
					
				</div>

				<?php
					}
				?>

				<div class="clear"></div>
				<br/><br/>
			</div>
			<?php 
				include("footer.php");
			?>
		</div>
	</body>
</html>