<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Editar Categorías";
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if (isset($_GET['id'])){
	$id_categoria=intval($_GET['id']);
	$query_cat=mysqli_query($con,"select * from categorias where id_categoria='$id_categoria'");
	$rw_cat=mysqli_fetch_array($query_cat);
	$nombre_categoria=$rw_cat['nombre_categoria'];
	$parent=$rw_cat['parent'];

	
}else {
	exit;
}
$active_categorias="active";
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
		  <li><a href="categorylist.php">Categorías</a></li>
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-6">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Editar categoría</h3>
			<form class="form-horizontal" id="editar_categorias">
				 
			  <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Nombre categoría</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" value="<?php echo $nombre_categoria;?>" required>
				  <input type="hidden" value="<?php echo $id_categoria;?>" id="id_categoria" name="id_categoria">		
				</div>
			  </div>
			  <div class="form-group">
				<label for="modelo" class="col-sm-4 control-label">Categoría padre</label>
				<div class="col-sm-8">
				  <select class="form-control" id="parent" name="parent">
					<option value='0'>Sin categoría padre</option>
					<?php
					if ($parent!=0){
						$sql_parent=mysqli_query($con,"select * from categorias where parent=0 order by nombre_categoria");
						while ($rw_parent=mysqli_fetch_array($sql_parent)){
							$id_cat=$rw_parent['id_categoria'];
							$cat=$rw_parent['nombre_categoria'];
							if ($id_cat==$parent){$selected="selected";}
							else {$selected="";}
							?>
							<option value="<?php echo $id_cat;?>" <?php echo $selected?>><?php echo $cat;?></option>
							<?php
						}
					}
					?>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-offset-2 col-sm-10">
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
  </body>
</html>
	<script>
		$("#editar_categorias").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_categoria.php",
				  type: "POST",
				  data: $("#editar_categorias").serialize(),
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

