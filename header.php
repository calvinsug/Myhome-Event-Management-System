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

		<?php 
				session_start();

				if(isset( $_SESSION['Username'] ))
					$MemberName = $_SESSION['MemberName'];

			?>

		$(document).ready(function(){
			var eventdesc = [];
			var newstitle = [];

			$.ajax({
			  url: "controller/getEvent.php",
			  type: "POST",
			  dataType: "json",
			  success: function(data){
			  	//alert(data);

			  	for(i=0;i<data.EventID.length;i++)
			  		eventdesc.push(data.EventName[i]);

			  	//console.log(data);
			  	//console.log(eventdesc);

			  	$('.txtSearch').autocomplete({
			  		source: eventdesc,
			  		minLength: 0

			  	}).focus(function(){    
			            $(this).trigger('keydown.autocomplete');
			    });

			 /*	var myOptions={};

			 	for(i=0;i<data.EventID.length;i++){
			 		$('select[name="Event"]').append('<option value="'+data.EventID[i]+'">'+data.EventName[i]+'</option>');

			 	}*/
			  }
			}); //end of Ajax


				$.ajax({
				  url: "controller/getNews.php",
				  type: "POST",
				  dataType: "json",
				  success: function(data){
				  	//alert(data);
				  		for(i=0;i<data.NewsID.length;i++)
			  				newstitle.push(data.Title[i]);

				  	//console.log(data.StaffID.length);
				 	
				  }
				}); //end of Ajax


			$('select[name="search"]').change(function(){


				$('input[name="search"]').val('');

				if($('select[name="search"] option:selected').val() == 'event'){
					$('input[name="search"]').attr('placeholder','search by Event Title');

					$('.txtSearch').autocomplete({
				  		source: eventdesc,
				  		minLength: 0

				  	}).focus(function(){    
				            $(this).trigger('keydown.autocomplete');
				    });

					$('#searchForm').attr('action','event.php');
					$('input[name="search"]').datepicker('destroy');
					//console.log('event');
				}
				else if($('select[name="search"] option:selected').val() == 'news'){
					$('input[name="search"]').attr('placeholder','search by News Title');
					//console.log('news');

					$('.txtSearch').autocomplete({
				  		source: newstitle,
				  		minLength: 0

				  	}).focus(function(){    
				            $(this).trigger('keydown.autocomplete');
				    });

					$('input[name="search"]').datepicker('destroy');
					$('#searchForm').attr('action','news.php');
				}
				else if($('select[name="search"] option:selected').val() == 'prayer'){
					$('input[name="search"]').attr('placeholder','search by Date');
					$('#searchForm').attr('action','prayerrequest.php');
					$('input[name="search"]').datepicker();

					
					//console.log('news');

				}

			});

			$('.searching').click(function(){

				$('#searchForm').submit();

			});
		});
	    	
	    </script>
	</head>

	<body>
		<div id="container">
			<?php 
				if(isset($_SESSION['Username'])){
			?>
			<div id="headerbg">
				<div id="header">
					<img src="assets/images/Myhome.png"/>
					<div class="menuheader">

							<span class="submenuheader">
								<span>Welcome, <?php 
								echo $MemberName ?></span> &nbsp;&nbsp;&nbsp;
								<span><a href="controller/dologout.php"><img src="assets/images/logoutmember.png"/>&nbsp;Logout</a></span>
								
							</span>

					</div>
				</div>
			</div>
			
			<div class="clear"></div>
			<br/>
			<div class="menubar">


				<ul>
					<li><a href="home.php" class="menulink">Home</a></li>
					<li><a href="profile.php">Profile</a></li>
					<li><a href="event.php">Event</a></li>
					<li><a href="news.php">News</a></li>
					<li><a href="prayerrequest.php">Prayer Request</a></li>
					<li><a href="testimony.php">Testimony</a></li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
				
				<form id="searchForm" method="post" action="event.php">
					<div class="search">
						<select name="search">
							<option value="event">Event</option>
							<option value="news">News</option>
							<option value="prayer">Prayer</option>
						</select>
						<span><input type="text" class="txtSearch" name="search" placeholder="search by Event Title"/></span>
						<span><a href="#" class="searching"><img src="assets/images/search.png"></a></span>
					</div>
				</form>	
			</div>
						<?php 
						}
						else{
							
						?>
				<div id="headerbg">
					<div id="header">
						<img src="assets/images/Myhome.png"/>
						<div class="menuheader">


							<span class="submenuheader">
								<span><a href="login.php">Sign In</a></span>
							</span>
							<span class="submenuheader">|</span>
							<span class="submenuheader">
								<span><a href="register.php">Register</a></span>
							</span>
						</div>
					</div>
				</div>
			<div class="clear"></div>
			<br/>
			<div class="menubar">
				<ul>
					<li><a href="home.php">Home</a></li>
					<li><a href="event.php">Event</a></li>
					<li><a href="news.php">News</a></li>
					<li><a href="testimony.php">Testimony</a></li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>

			
			<form id="searchForm" method="post" action="event.php">
				<div class="search">
					<select name="search">
						<option value="event">Event</option>
						<option value="news">News</option>
					</select>
					<span><input type="text" class="txtSearch" name="search" placeholder="search by Event Title"/></span>
					<span><a href="#" class="searching"><img src="assets/images/search.png"></a></span>
				</div>
			</form>	
			</div>
			<?php 
						}
			?>	
			<div class="clear"></div>
			<br/><br/>
			
		</div>
	</body>
</html>