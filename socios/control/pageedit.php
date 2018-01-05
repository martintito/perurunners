<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Editar Página";
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
include ("functions.php");

if (isset($_GET['id'])){
	$id_pagina=intval($_GET['id']);
	$query_pagina=mysqli_query($con,"select * from paginas where id_pagina='$id_pagina'");
	$rw=mysqli_fetch_array($query_pagina);
	$titulo=$rw['titulo'];
	$slug=$rw['slug'];
	$descripcion=$rw['descripcion'];
	$estado=$rw['estado'];
	$url=url();
	
		
}else {
	exit;
}
$active_paginas="active";
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
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
	<!-- include summernote css/js-->
	<link href="summernote/summernote.css" rel="stylesheet">
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
		  <li><a href="pageslist.php">Páginas</a></li>
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-9">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Editar página</h3>
			<form class="form-horizontal" id="editar_pagina">
				 
			 
			  
			  <div class="form-group">
				<label for="titulo" class="col-sm-3 control-label">Título de la página</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="titulo" value="<?php echo $titulo;?>" required name="titulo"><input type="hidden" class="form-control" id="id_pagina" value="<?php echo $id_pagina;?>" required name="id_pagina">
				</div>
			  </div>
			  <div class="form-group">
				<label for="titulo" class="col-sm-3 control-label">Enlace permanente</label>
				<div class="col-sm-5">
				  <input type="text" class="form-control" id="url" value="<?php echo str_replace("control/","",$url);?>" required name="url" readonly>
				</div><div class="col-sm-4">
				  <input type="text" class="form-control" id="slug" value="page/<?php echo $slug;?>" required name="slug" readonly>
				</div>
			  </div>
			  <div class="form-group">
				<label for="descripcion" class="col-sm-3 control-label">Contenido</label>
				<div class="col-sm-9">
				  <textarea class="form-control " rows="9"  id="descripcion" required name="descripcion"><?php echo $descripcion;?></textarea>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-9">
				  <select class="form-control" id="estado" required name="estado">
					<option value="0" <?php if ($estado==0){echo "selected";}?>>No publicada</option>
					<option value="1" <?php if ($estado==1){echo "selected";}?>>Publicada</option>
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
	<script src="summernote/summernote.min.js"></script>
  </body>
</html>
	<script>
		$("#editar_pagina").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_pagina.php",
				  type: "POST",
				  data: $("#editar_pagina").serialize(),
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

	<script>
$(document).ready(function() {
$('#descripcion').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	['link',['linkDialogShow', 'unlink','video']],
	['view', ['codeview']],
    
  ],height: 350,
  focus: true 
  
});

$('#descripcion').summernote('code','<?php echo $descripcion;?>');

});
</script>
