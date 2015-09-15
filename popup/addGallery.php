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

				$('.videofield').hide();

				<?php 
		          if(isset($_GET['success'])){
			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Add Gallery Success');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 
			    ?>


			 	<?php 
					$EventID = "";
					echo $EventID;
					if(isset($_GET['EventID']))
						$EventID = $_GET['EventID'];
				?>

				$('select[name="Type"]').change(function(){
					//alert('q');
					if ($('select[name="Type"]').val() == 'photo' ){
						$('.imagefield').show();
						$('.videofield').hide();
					}
				 	else if ($('select[name="Type"]').val() == 'video' ){
						$('.imagefield').hide();
						//$('.videofield').css('display','');
						$('.videofield').show();
					}

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
					<form method="post" action="../controller/doAddGalery.php" id="formRegis" enctype="multipart/form-data">
			
							<div id="newRundown">
							<div class="field">
								<h2 align="center">Add Gallery</h2>
								<hr/>
							</div>
							<br/>
							
							<div id="rundownFormGeneral">	

								<div class="dayForm">
									
									<div class="rundown">

										<div class="field" style="display:none">
											<span>Event ID</span>
											<span><input id="title" name="EventID" value="<?php echo $EventID;?>" class="textbox" type="text"/></span>
										</div>
										
										<div class="field">
											<span>Gallery Type</span>
											<span>
												<select name="Type" class="textbox">
													<option value="photo">Photo</option>
													<option value="video">Video</option>
												</select>
											</span>
										</div>
										
										<div class="field imagefield">
											<span>Image</span>
											<span><input type="file" class="textbox" id="file_upload" name="img" accept="image/png, image/jpg, image/jpeg"></span>
											<div id="divImg" style="margin:10px 0 20px 200px"><img src="" id="imgPath"/></div>
										</div>

										<div class="field videofield">
											<span>Video Url</span>
											<span><input id="title" name="video" class="textbox" type="text"/></span>
										</div>

									</div>

								</div>
							</div>

							<div class="field">
								
								<div class="submit"><input type="submit" class="btnAddGalery" value="Add Gallery" class="sizesubmit"/></div>
							
								<div style="color:#FF0000;margin-bottom: 10px" align="center" id="rundownerror">
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