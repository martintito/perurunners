<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Editar Fabricante ";
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
$active_fabricantes="active";
$title.=" - $nombre_fabricante";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/ico/favicon.ico">
    <title><?php echo $title;?></title>
    <!-- Bootstrap core CSS -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
	<link href="css/preview-image.css" rel="stylesheet">
  </head>
  <body>
	<?php include("top_menu.php");?>

    <div class="container">
		
      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">
	   <?php 
			if ($user_id_db==1){
	   ?>	  
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
			<?php 
				} 
				else
				{
					?>
					<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
						<h4>Acceso denegado!</h4> 
						<p>El acceso fue denegado porque no tiene privilegios suficientes para acceder a este módulo</p> 
						<p> <a href="quoteslist.php"  class="btn btn-danger">Ir a cotizaciones</a>  </p>
					</div>
					<?php
				}
				
			?>		
    </div> 
	</div><!-- /container -->
	<?php include("footer.php");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
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




