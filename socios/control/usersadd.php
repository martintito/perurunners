<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Agregar Usuarios";
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
$active_usuarios="active";
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
		  <li><a href="userslist.php">Usuarios</a></li>
		  <li class="active">Agregar</li>
		</ol>
		 <div class="col-md-6">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Agregar usuario</h3>
			<form class="form-horizontal" id="agregar_usuario">
				 
			  <div class="form-group">
				<label for="nombres" class="col-sm-4 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombres" name="nombres" required>
				  <input type="hidden" value="<?php echo $id;?>" id="user_id" name="user_id">		
				</div>
			  </div>

			  <div class="form-group">
				<label for="apellidos" class="col-sm-4 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidos" name="apellidos" required>
				 </div>
			  </div>
			  <div class="form-group">
				<label for="usuario" class="col-sm-4 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="usuario" name="usuario"  required>
				 </div>
			  </div>
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-4 control-label">Estado</label>
				<div class="col-sm-8">
				  <select name="estado" id="estado" class="form-control" required>
					<option value="" > Selecciona estado</option>
					<option value="0" >Inactivo</option>
					<option value="1" >Activo</option>
				  </select>
				 </div>
			  </div>
			  
			  <div class="form-group">
				<label for="pass" class="col-sm-4 control-label">Contraseña</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="pass" name="pass" required>
				</div>
			 </div>
			 
			 <div class="form-group">
				<label for="repass" class="col-sm-4 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="repass" name="repass" required>
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
		$("#agregar_usuario").submit(function(e) {
			var pass=$("#pass").val();
			var repass=$("#repass").val();
			if (pass!=repass){
				alert("Las contraseñas no coinciden.");
				$("#pass").focus();
				return false;
			}
			  $.ajax({
				  url: "ajax/agregar_usuario.php",
				  type: "POST",
				  data: $("#agregar_usuario").serialize(),
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
	