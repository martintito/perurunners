<?php
$imagen_demo="demo.png";
$id_banner=intval($_GET['id']);
$sql=mysqli_query($con,"select * from banner where id='$id_banner' limit 0,1");
$count=mysqli_num_rows($sql);
if ($count==0){
	header("location: bannerlist.php");
	exit;
}
$rw=mysqli_fetch_array($sql);
$titulo=$rw['titulo'];
$url_boton=$rw['url_boton'];
$url_image=$rw['url_image'];
$orden=intval($rw['orden']);
$estado=intval($rw['estado']);
$posicion=intval($rw['posicion']);
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
		  <li><a href="bannerlist.php">Banner</a></li>
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-8">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Editar banner</h3>
			<form class="form-horizontal" id="editar_banner">
				 
			 
			  
			  <div class="form-group">
				<label for="titulo" class="col-sm-3 control-label">Titulo</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="titulo" value="<?php echo $titulo;?>" required name="titulo">
				  <input type="hidden" class="form-control" id="id_banner" value="<?php echo intval($id_banner);?>" name="id_banner">
				</div>
			  </div>
			  
			 
			  
			  <div class="form-group">
				<label for="url_boton" class="col-sm-3 control-label">URL</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="url_boton" name="url_boton" value="<?php echo $url_boton;?>">
				</div>
			  </div>
			 
			 <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Posición del banner</label>
				<div class="col-sm-9">
				  <select class="form-control" id="posicion" required name="posicion">
					<option value="1" <?php if($posicion==1){echo "selected";} ?>>Superior</option>
					<option value="2" <?php if($posicion==2){echo "selected";} ?>>Inferior</option>
				 </select>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="orden" class="col-sm-3 control-label">Orden</label>
				<div class="col-sm-9">
				  <input type="number" class="form-control" id="orden" name="orden" value="<?php echo $orden;?>">
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-9">
				  <select class="form-control" id="estado" required name="estado">
					<option value="0" <?php if($estado==0){echo "selected";} ?>>Inactivo</option>
					<option value="1" <?php if($estado==1){echo "selected";} ?>>Activo</option>
				 </select>
				</div>
			  </div>
			  
			
			 
			  
			  
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-offset-3 col-sm-9">
				  <button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
			  </div>
			</form>
			
			
			
		</div>
		<div class="col-md-4">
		 <h3 ><span class="glyphicon glyphicon-picture"></span> Imagen</h3>
		 
		 <form class="form-vertical">
		 
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
				<p class="text-primary text-center">Tamaño recomendado es de 188 x 188 píxeles.</p>
			  </div>
			  
			
			  
			 
			  
			  
		 </form>
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
				var id_banner=$("#id_banner").val();
				var inputFileImage = document.getElementById("fileToUpload");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				data.append('id',id_banner);
				
				$.ajax({
					url: "ajax/upload_banner.php",        // Url to which the request is send
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
			
			function eliminar(id){
				var parametros = {"action":"delete","id":id};
						$.ajax({
							url:'ajax/upload2.php',
							data: parametros,
							 beforeSend: function(objeto){
							$(".upload-msg2").text('Cargando...');
						  },
							success:function(data){
								$(".upload-msg2").html(data);
								
							}
						})
					
				}
				
				
				
				
			
	</script>
	<script>
		$("#editar_banner").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_banner.php",
				  type: "POST",
				  data: $("#editar_banner").serialize(),
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