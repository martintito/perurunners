<?php
$imagen_demo="demo.png";
$id_banner=1;
$sql=mysqli_query($con,"select * from modal where id='$id_banner' limit 0,1");
$count=mysqli_num_rows($sql);
if ($count==0){
	header("location: bannerlist.php");
	exit;
}
$rw=mysqli_fetch_array($sql);
$titulo=$rw['titulo'];
$url_boton=$rw['url_boton'];
$url_image=$rw['url_image'];
$estado=intval($rw['estado']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("view/head.php");?>
<link href="css/preview-image.css" rel="stylesheet">
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
	<?php include("view/leftpanel.php");?>
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    
    <div class="headerbar">
		<?php include("view/headerbar.php"); ?>
    </div><!-- headerbar -->
    
    <div class="pageheader">
      <?php include("view/pageheader.php");?>
    </div>
    
    <div class="contentpanel">
      <?php if ($permisos_editar==1){?>
		<section class="content-header">
			<div class="row">
				<ol class="breadcrumb">
		  <li><a href="productslist.php">Inicio</a></li>
		  <li class="active">Ventana modal</li>
		</ol>
		 <div class="col-md-7">
		 
			<form class="form-horizontal" id="editar_modal">
				 
			 
			  
			  <div class="form-group">
				<label for="titulo" class="col-sm-1 control-label">Titulo</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="titulo" value="<?php echo $titulo;?>" required name="titulo">
				  
				</div>
			  </div>
			  
			 
			  
			  <div class="form-group">
				<label for="url_boton" class="col-sm-1 control-label">URL</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="url_boton" name="url_boton" value="<?php echo $url_boton;?>">
				</div>
			  </div>
			 
			
			  
			  
			  
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-1 control-label">Estado</label>
				<div class="col-sm-12">
				  <select class="form-control" id="estado" required name="estado">
					<option value="0" <?php if($estado==0){echo "selected";} ?>>Inactivo</option>
					<option value="1" <?php if($estado==1){echo "selected";} ?>>Activo</option>
				 </select>
				</div>
			  </div>
			  
			
			 
			  
			  
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-12">
				  <button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
			  </div>
			</form>
			
			
			
		</div>
		<div class="col-md-5">
		 <h3 ><span class="glyphicon glyphicon-picture"></span> Imagen</h3>
		 
		
		 
			<div class="form-group">
				
				<div class="col-sm-12">
				
				 
				 <div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 100%;" >
									  <img class="img-rounded" src="../img/banner/<?php echo $url_image;?>" />
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;"></div>
								  <div>
									<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
									<span class="fileinput-exists" onclick="upload_image();">Cambiar imagen</span><input type="file" name="fileToUpload" id="fileToUpload" required onchange="upload_image();"></span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Cancelar</a>
								  </div>
					</div>
					<div class="upload-msg"></div>
					
				</div>
				
			  </div>
			  
			
			  
			 
			  
			  
		
		</div>
		
			</div>	
				
			 
        </section>
		 <!-- Main content -->

     
      <?php 
	  } 
	  else
	  {
		include("view/access_denied.php");
	  }
	  ?>
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->
  

  
  
</section>


<?php
include ("view/js.php")
?>
<script src="plugins/jasny/jasny-bootstrap.min.js"></script>
</body>
</html>
<script>
			function upload_image(){
				$(".upload-msg").text('Cargando...');
				var inputFileImage = document.getElementById("fileToUpload");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				
				
				$.ajax({
					url: "ajax/upload_modal.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
			

				
				
				
				
			
	</script>
	<script>
		$("#editar_modal").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_modal.php",
				  type: "POST",
				  data: $("#editar_modal").serialize(),
				   beforeSend: function(objeto){
					$("#loader").html("Cargando...");
				  },
				  success:function(data){
						$(".outer_div").html(data).fadeIn('slow');
						$("#loader").html("");
					}
			});
			 e.preventDefault();
		});
	</script>

	

