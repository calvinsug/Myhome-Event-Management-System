<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
		
		<script type="text/javascript" src="../assets/library/tiny_mce/tiny_mce.js"></script>

		<script>

			$( document ).ready(function() {

				<?php 
		          if(isset($_GET['success'])){
			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Create News Success');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 
			    ?>

			 	$('#formRegis').submit(function(e){
			 		console.log(e);
			 		e.preventDefault();
			 	});

			 	lat = 0;
			 	lng = 0;

			 	tinymce.init({
			    	selector: "textarea",
			    	width: 700,
			    	theme : "advanced",
		            plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist"

				});


			 	$('.btnCreateNews').click(function(){
			 		tinymce.triggerSave();
			 		//alert('tes');

			 		$('#txtDesc').val($('#desc').val());

			 		//alert($('#desc').val());

			 		/*$.ajax({
						url: "../controller/doCreateBranch.php",
						type: "POST",
						dataType: "json",
						//contentType: "application/json; charset=utf-8",
						data : {
							'StaffID' : $('select[name="Staff"]').val(),
							'Lat'  : lat,
							'Lng'  : lng,
							'Region' : $('select[name="region"]').val(),
							'BranchAddress' : $('#pac-input').val()								
						},
						success: function(data){
							if(data == '1'){
								javascript:parent.$.fancybox.close();
								alert('Create new Branch success.');
								//$('.fancybox-close');

								javascript:parent.location.reload();
								
																

								//$.fancybox.close();
							}
							else{
								alert(data);
							}
							
						}
					});*/

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
					
						<div class="field">
							<h2 align="center">Create News</h2>
							<hr/>
						</div>
						<br/>
						
						<form method="post" action="../controller/doCreateNews.php" enctype="multipart/form-data">	
							<div class="field">
								<span>News Title</span>
								<span><input name="title" class="textbox" type="text" /></span>
							</div>

							<div class="field">
								<span>News Desc</span>
								<span><textarea id="desc"></textarea></span>
							</div>

							<input type="text" style="display:none" name="desc" id="txtDesc" />
 
							<div class="field">
								<span>News Photo</span>
								<span><input type="file" class="textbox" id="file_upload" name="img" accept="image/png, image/jpg, image/jpeg"></span>
							</div>

							<div id="divImg" style="margin:0 0 20px 242px"><img src="" id="imgPath"/></div>

							<div class="field">
								<div class="submit"><input type="submit" class="btnCreateNews" value="Create News" class="sizesubmit"/></div>
							</div>
						</form>

						<br/><br/>
					
				</div>
			</div>
			
		</div>
	</body>
</html>