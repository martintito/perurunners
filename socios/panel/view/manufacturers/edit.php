<?php
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if (isset($_GET['id'])){
	$id=intval($_GET['id']);
	$query=mysqli_query($con,"select * from fabricantes where id_fabricante='$id'");
	$rw=mysqli_fetch_array($query);
	$nombre_fabricante=$rw['nombre_fabricante'];
	$logo_url=$rw['logo_url'];

	
}else {
	exit;
}

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
				
			<ol class="breadcrumb">
			  <li><a href="productslist.php">Inicio</a></li>
			  <li><a href="manufacturerslist.php">Fabricantes</a></li>
			  <li class="active">Editar</li>
			</ol>
			
			<div class="col-md-6">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Editar fabricante</h3>
			<form class="form-horizontal" id="editar_fabricante" enctype="multipart/form-data"  method="post">
				 
			  <div class="form-group">
				<label for="nombre_fabricante" class="col-sm-4 control-label">Nombre fabricante</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_fabricante" name="nombre_fabricante"  value="<?php echo $nombre_fabricante;?>"required>
				  <input type="hidden" class="form-control" id="id_fabricante" name="id_fabricante"  value="<?php echo $id;?>" >
				 </div>
			  </div>
			  <div class="form-group">
				<label for="modelo" class="col-sm-4 control-label">Logo</label>
				<div class="col-sm-8">
					<div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 250px;" >
									  <img class="img-rounded" src="../img/marcas/<?php echo $logo_url;?>" />
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;"></div>
								  <div>
									<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
									<span class="fileinput-exists" onclick="upload_image();">Cambiar imagen</span><input type="file" name="fileToUpload" id="fileToUpload"  ></span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Cancelar</a>
								  </div>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success">Guardar datos</button>
				</div>
			  </div>
			</form>
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
		$("#editar_fabricante").submit(function(e) {
			e.preventDefault();
				$("#loader").text('Cargando...');
				var nombre_fabricante=$("#nombre_fabricante").val();
				var id_fabricante=$("#id_fabricante").val();
				var inputFileImage = document.getElementById("fileToUpload");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				data.append('nombre_fabricante',nombre_fabricante);
				data.append('id_fabricante',id_fabricante);
				
				$.ajax({
					url: "ajax/editar_fabricante.php",        // Url to which the request is send
					type: "POST",            	 // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					beforeSend: function(objeto){
						$("#loader").html("Cargando...");
					},
					success: function(data)   // A function to be called if request succeeds
					{
						$(".outer_div").html(data).fadeIn('slow');
						$("#loader").html("");
						
					}
				});
				
			 
		});
	</script>




