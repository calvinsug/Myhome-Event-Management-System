<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="../assets/css/jquery-ui.css">
		<script src="../assets/library/jquery-ui.js"></script>

		<script src="../assets/library/tiny_mce/tiny_mce.js"></script>

		<!-- Datepicker  
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css">
		-->

		<script>

			$( document ).ready(function() {
			 	$('#formRegis').submit(function(e){
			 		console.log(e);
			 		e.preventDefault();
			 	});

			 	var location = [];
			 	var locationvalue = [];

			 	
			 	$.ajax({
				  url: "../controller/getlocation.php",
				  type: "POST",
				  dataType: "json",
				  success: function(data){
				  	console.log(data);

				  	for(i=0;i<data.location.length;i++){
				 		location.push(data.location[i]);
				 		locationvalue.push(data.value[i]);

				 		//$('select[name="Staff"]').append('<option value="'+data.StaffID[i]+'">'+data.StaffName[i]+'</option>');
				 	}
				  }

				});



			 	$.ajax({
				  url: "../controller/getdivision.php",
				  type: "POST",
				  dataType: "json",
				  success: function(data){
				  	//alert(data);
				  	console.log(data);
				  	number=1;
				  	for(i=0 ; i<data.division.length ; i++){
				  		number++;
						$('.divisionForm').append(							
							'<div class="field">'+
								'<span><input type="text" class="txtdivision'+(i+1)+'" value="'+data.division[i]+'" disabled></span>'+
								'<span><input class="chk'+(i+1)+'" type="checkbox"/></span>'+
							'</div>'+
							'<br/>');

						$('.BudgetingForm').append(							
							'<div class="field">'+
								'Division '+data.division[i]+'<br/>'+
								'<span><input type="textbox" class="txtBudgetdesc'+(i+1)+'" placeholder="Budget description"></span>'+
								'<span><input type="textbox" class="txtBudget" placeholder="budget"/></span>'+
							'</div>'+
							'<input type="button" class="btn'+data.value[i]+'" value="Add">'+
							'<br/>');

						$('.btn'+data.value[i]).click(function(){
							
							alert(i);

						});
				  	}

				  	$('.divisionForm').append('<input type="button" class="addDivision" value="Add more Division"/>');

				  	$('.addDivision').click(function(){
						
						$('.divisionForm').append('<br/>'+							
							'<div class="field">'+
								'<span><input type="text" class="txtdivision'+number+'" ></span>'+
								'<span><input class="chk'+number+'" type="checkbox"/></span>'+
							'</div>');				  		

						number++;
				  	});

				  }
				}); //end of Ajax


			 	$('#newRundown').hide();
			 	$('#newDivision').hide();
			 	$('#newBudgeting').hide();
			 	$('#detailRundown').hide();

			 


			 	$('.btnEventNext').click(function(){

					$('#newEvent').slideUp(function(){

						$('#newRundown').slideDown();

						//2015-01-12
						var date1 = new Date($('#startDate').val().substr(0,4), $('#startDate').val().substr(5,2), $('#startDate').val().substr(8,2));

						var date2 = new Date($('#endDate').val().substr(0,4), $('#endDate').val().substr(5,2), $('#endDate').val().substr(8,2));

						var diff = date2 - date1;

						days = diff/1000/60/60/24;

						days++;
						console.log(days + ' days');


						//rundownform = $('.rundown').html();

						

						$('#rundownFormGeneral').html('');



						//$('#iMasterTOEFLTemplate').clone().removeAttr('id').css('display', '').addClass('datarow');
						



						for(i = 0 ; i<days ; i++){
							
							n = i+1;

							console.log('repetition '+i);

							//dayform = $('.dayForm').clone().css('display','');

							dayform = $('.dayForm').html();

							//console.log(dayform);

							//dayform = $('.dayForm').clone().css('display','').addClass('Day'+i+1);	

							//$('.title', dayform).text('Day '+i+1);

							//$('#rundownFormGeneral').append(dayform);

							$('#rundownFormGeneral').append('<div class="dayForm">'+
									'<h2 class="title">Day '+n+'</h2>'+
									//'<input type="text" class="day" name="day'+n+'" value="'+(i+1)+'"/> '+
									'<div class="rundown'+n+'">'+
										'<div class="field">'+
											'<span>Day Rundown</span>'+
											'<span><input id="title" class="textbox day'+n+'" type="text"/></span>'+
										'</div>'+
									
										'<div class="field">'+
											'<span>Start Time Rundown</span>'+
											'<span><input id="startDate" class="textbox startRundown'+n+'" type="text"/></span>'+
										'</div>'+

										'<div class="field">'+
											'<span>End Time Rundown</span>'+
											'<span><input id="endDate" class="textbox endRundown'+n+'" type="text"/></span>'+
										'</div>'+

										'<div class="field">'+
											'<span>Description Rundown</span>'+
											'<span><textarea name="Rundowndesc'+n+'" id="desc" class="textbox" rows="3" cols="40"></textarea></span>'+
										'</div>'+
										'<br/><br/><br/>'+

										'<div class="field">'+
											'<span>Location Rundown</span>'+
											'<span><select name="Location'+n+'" id="ddlLocation" class="textbox"></select></span>'+
										'</div>'+	

										'<input type="button" class="btnAdd'+n+'" value="Add"/>'+
										
									'</div>'+
								'</div>');
							
							for(j=0;j<location.length;j++){
								$('select[name="Location'+n+'"]').append('<option value="'+locationvalue[j]+'">'+location[j]+'</option>');
								
							}

							console.log(n);

							var btn = $(".btnAdd"+n);
							//console.log('checkpoint');
							//console.log($('.btnRundownPrev'));
							console.log(btn);

							$('.btnAdd'+n).click(function(){
								alert(n);
								$('.rundown'+n).append('afafa');

							});

						}


					});


			 	});

			 	$('.btnRundownPrev').click(function(){

			 		$('#newRundown').slideUp(function(){

						$('#newEvent').slideDown();
						//alert('done');
					});

			 	});

				$('.btnRundownNext').click(function(){

					$('#newRundown').slideUp(function(){

						$('#newDivision').slideDown();
						//alert('done');
					});


			 	});			 	

				$('.btnDivisionPrev').click(function(){

					$('#newDivision').slideUp(function(){

						$('#newRundown').slideDown();
						//alert('done');
					});


			 	});	

			 	$('.btnDivisionNext').click(function(){

			 		$('#newDivision').slideUp(function(){

			 			$('#newBudgeting').slideDown();

			 		});

			 	});

			 	$('.btnBudgetingPrev').click(function(){

			 		$('#newBudgeting').slideUp(function(){

			 			$('#newDivision').slideDown();

			 		});

			 	});

			 	$('.btnSubmit').click(function(){

			 		alert('Create Event Success.');
			 		javascript:parent.$.fancybox.close();

			 	});


			 	lat = 0;
			 	lng = 0;

			 	$('#startDate').datepicker({
			 		dateFormat : 'yy-mm-dd',
			 		minDate : '+1'
			 	});

			 	$('#endDate').datepicker({
			 		dateFormat : 'yy-mm-dd',
			 		minDate : '+1'
			 	});

			 	tinymce.init({
				    selector: "textarea",
				    width: 700
				});

			 	/*tinymce.init({
				    selector: "textarea",
				    plugins: [
				        "advlist autolink lists link image charmap print preview anchor",
				        "searchreplace visualblocks code fullscreen",
				        "insertdatetime media table contextmenu paste moxiemanager"
				    ],
				    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
				});*/

			 	/*$('#desc').tinymce({
		            // Location of TinyMCE script
		            script_url : 'js/tinymce/tiny_mce.js',

		            // General options
		            theme : "advanced",
		            plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

		            // Theme options
		            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,blockquote,forecolor,backcolor",
		            theme_advanced_buttons2 : "",
		            theme_advanced_buttons3 : "",
		            theme_advanced_buttons4 : "",
		            theme_advanced_toolbar_location : "top",
		            theme_advanced_toolbar_align : "center",
		            theme_advanced_statusbar_location : "bottom",
		            content_css : "css/tinymce.css"
		        });*/

			 	$('.pricefield').hide();
			 	//pricefield
			 	$("input[name='price']").click(function(){
			 		
			 		if($(this).val() == 'paid')
			 			$('.pricefield').show();
			 		else
			 			$('.pricefield').hide();
			 		
			 	});


				$('#file_upload').change(function(e) {
	        	attachmentFile = e.target.files;
	   
	   			console.log(attachmentFile);

	            if(attachmentFile.length)
	            	extension = attachmentFile[0].name.substr(attachmentFile[0].name.length-3).toLowerCase();
	            else 
	            	$('#txtFile').val("");
	            
	            if(attachmentFile.length)
	            {
	                if(attachmentFile[0].size > 2000000)
	                {
	                	alert("File size cannot exceed 2 MB limit");
	                    attachmentFile = null;
	                    
	                    $('#divImg').html('<img src="" id="imgPath"/>'); 
	                    $('#file_upload').val('');
	                }
	                else if(extension != 'jpg' && extension != 'png' && extension != 'gif' ){
	                	alert("File extension must be .jpg, .png, or .gif");
	                    attachmentFile = null;
	                   
	                    $('#divImg').html('<img src="" id="imgPath"/>');   
	                    $('#file_upload').val('');
	                }
	                else
	                {
	                    
	                    prepareUpload(e);
	                }
	            }
	        });

				function prepareUpload(event){
					files = event.target.files;
					if (files && files[0]) {
						var reader = new FileReader();

						reader.onload = function (e) {
							$('#imgPath')
								.attr('src', e.target.result)
								.width(100)
								.height(100);
							
						};
						reader.readAsDataURL(files[0]);
					}
				}


			 	


			 	
			 	
			});


    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					<form method="post" action="controller/doCreateEvent.php" id="formRegis" enctype="multipart/form-data">
						

						<div id="newEvent">
							<div class="field">
								<h2 align="center">Create New Event</h2>
								<hr/>
							</div>
							<br/>
							
							<div class="field">
								<span>Event Title</span>
								<span><input id="title" class="textbox" type="text"/></span>
							</div>
							
							<div class="field">
								<span>Event Type</span>
								<span><input id="type" class="textbox" type="text"/></span>
							</div>

							<div class="field">
								<span>Start Date</span>
								<span><input id="startDate" class="textbox" type="text"/></span>
							</div>

							<div class="field">
								<span>End Date</span>
								<span><input id="endDate" class="textbox" type="text"/></span>
							</div>

							<br/>

							<div class="field">
								<span>Event Desc</span>
								<span><textarea name="Eventdesc" id="desc" class="textbox" rows="3" cols="40"></textarea></span>
							</div>						
							<br/><br/>

							<div class="field">
								<span>Event Photo</span>
								<span><input type="file" class="textbox" id="file_upload" name="img" accept="image/png, image/jpg, image/jpeg"></span>
							</div>

							<div id="divImg" style="margin:0 0 20px 240px"><img src="" id="imgPath"/></div>
							<br/><br/>
							<div class="field">
								<span>Price</span>
								<span>
									<input name="price" type="radio" value="free" checked/>Free
									<input name="price" type="radio" value="paid"/>Paid
								</span>
							</div>

							<div class="field pricefield">
								<span>Ticket Price</span>
								<span><input id="ticketPrice" class="textbox" type="text"/></span>
							</div>

							<div class="field">
								<div class="submit" style="float:left; display:none"><input type="button" value="Prev" class="sizesubmit"/></div>
								<div class="submit"><input type="button" style="float:right" class="btnEventNext" value="Next" class="sizesubmit"/></div>
								<div style="color:#FF0000;margin-bottom: 10px" align="center" id="eventerror">
					              <?php 
					                  if(isset($_GET['error'])) echo $_GET['error'];
					                  else echo "&nbsp;";
					              ?>
					            </div>
							</div>
							<br/><br/>
						</div>

						<div id="detailRundown">
							
							<div class="field">
								<h2 align="center">Set Detail Rundown Event</h2>
								<hr/>
							</div>
							<br/>
							
							<div id="setrundownForm">	

								
							</div>

							<br/>

							<div class="field">
								<div class="submit" style="float:left"><input type="button" class="btnSetRundownPrev" value="Prev" class="sizesubmit"/></div>
								<div class="submit" style="float:right"><input type="button" class="btnSetRundownNext" value="Next" class="sizesubmit"/></div>
								
							</div>
							
						</div>

						<div id="newRundown">
							<div class="field">
								<h2 align="center">Create Rundown Event</h2>
								<hr/>
							</div>
							<br/>
							
							<div id="rundownFormGeneral">	

								<div class="dayForm">
									<h2 class="title">Day</h2>

									<div class="rundown">
										<div class="field">
											<span>Day Rundown</span>
											<span><input id="title" class="textbox" type="text"/></span>
										</div>
									
										<div class="field">
											<span>Start Time Rundown</span>
											<span><input id="startDate" class="textbox" type="text"/></span>
										</div>

										<div class="field">
											<span>End Time Rundown</span>
											<span><input id="endDate" class="textbox" type="text"/></span>
										</div>

										<div class="field">
											<span>Description Rundown</span>
											<span><textarea name="Rundowndesc" id="desc" class="textbox" rows="3" cols="40"></textarea></span>
										</div>
										<br/><br/><br/>

										<a>add</a>
										
									</div>

								</div>
							</div>

							<br/>

							<div class="field">
								<div class="submit" style="float:left"><input type="button" class="btnRundownPrev" value="Prev" class="sizesubmit"/></div>
								<div class="submit" style="float:right"><input type="button" class="btnRundownNext" value="Next" class="sizesubmit"/></div>
								<div style="color:#FF0000;margin-bottom: 10px" align="center" id="rundownerror">
					              <?php 
					                  if(isset($_GET['error'])) echo $_GET['error'];
					                  else echo "&nbsp;";
					              ?>
					            </div>
							</div>
							<br/><br/>


						</div>

						<div id="newDivision">
							<div class="field">
								<h2 align="center">Create Division</h2>
								<hr/>
							</div>
							<br/>
							
							<div class="divisionForm">

							</div>

							<br/>

							<div class="field">
								<div class="submit" style="float:left"><input type="button" class="btnDivisionPrev" value="Prev" class="sizesubmit"/></div>
								<div class="submit" style="float:right"><input type="button" class="btnDivisionNext" value="Next" class="sizesubmit"/></div>
								<div style="color:#FF0000;margin-bottom: 10px" align="center" id="divisionerror">
					              <?php 
					                  if(isset($_GET['error'])) echo $_GET['error'];
					                  else echo "&nbsp;";
					              ?>
					            </div>
							</div>
							<br/><br/>


						</div>

						<div id="newBudgeting">
							<div class="field">
								<h2 align="center">Expected Budgeting</h2>
								<hr/>
							</div>
							<br/>
							
							<div class="BudgetingForm">
									
							</div>

							<br/>

							<div class="field">
								<div class="submit" style="float:left"><input type="button" class="btnBudgetingPrev" value="Prev" class="sizesubmit"/></div>
								<div class="submit" style="float:right"><input type="submit" class="btnSubmit" value="Create Event" class="sizesubmit"/></div>
								<div style="color:#FF0000;margin-bottom: 10px" align="center" id="divisionerror">
					              <?php 
					                  if(isset($_GET['error'])) echo $_GET['error'];
					                  else echo "&nbsp;";
					              ?>
					            </div>
							</div>
							<br/><br/>


						</div>


					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>