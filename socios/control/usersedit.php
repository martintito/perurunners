<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Editar Usuarios";
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if (isset($_GET['id'])){
	$id=intval($_GET['id']);
	$query=mysqli_query($con,"select * from user where user_id='$id'");
	$rw=mysqli_fetch_array($query);
	$nombres=$rw['nombres'];
	$apellidos=$rw['apellidos'];
	$username=$rw['username'];
	$status=$rw['status'];
	
}else {
	exit;
}
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
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-6">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Editar usuario</h3>
			<form class="form-horizontal" id="editar_usuarios">
				 
			  <div class="form-group">
				<label for="nombres" class="col-sm-4 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $nombres;?>" required>
				  <input type="hidden" value="<?php echo $id;?>" id="user_id" name="user_id">		
				</div>
			  </div>

			  <div class="form-group">
				<label for="apellidos" class="col-sm-4 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos;?>" required>
				 </div>
			  </div>
			  <div class="form-group">
				<label for="usuario" class="col-sm-4 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="usuario" name="usuario" value="<?php echo $username;?>" required>
				 </div>
			  </div>
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-4 control-label">Estado</label>
				<div class="col-sm-8">
				  <select name="estado" id="estado" class="form-control">
					<option value="0" <?php if ($status==0){echo "selected";}?>>Inactivo</option>
					<option value="1" <?php if ($status==1){echo "selected";}?>>Activo</option>
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
		 <div class="col-md-6">
		 <h3 ><span class="glyphicon glyphicon-cog"></span> Editar contraseña</h3>
			<form class="form-horizontal" id="editar_pass">
			<div class="form-group">
				<label for="pass" class="col-sm-4 control-label">Contraseña actual</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="pass" name="pass" required>
				 		
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="newpass" class="col-sm-4 control-label">Nueva contraseña</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="newpass" name="newpass" required>
				  <input type="hidden" value="<?php echo $id;?>" id="id_user" name="id_user">		
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="repass" class="col-sm-4 control-label">Repite nueva contraseña</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="repass" name="repass" required>
				 </div>
			  </div>
			  <div class="form-group">
				<div id='cargador'></div>
				<div class='salida'></div>
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-success">Actualizar contraseña</button>
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
		$("#editar_usuarios").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_usuario.php",
				  type: "POST",
				  data: $("#editar_usuarios").serialize(),
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
		$("#editar_pass").submit(function(e) {
			var newpass=$("#newpass").val();
			var repass=$("#repass").val();
			if (newpass!=repass){
				alert("Contraseñas no coinciden.");
				return false;
			}
			  $.ajax({
				  url: "ajax/editar_pass.php",
				  type: "POST",
				  data: $("#editar_pass").serialize(),
				   beforeSend: function(objeto){
					$("#cargador").html("Cargando...");
				  },
				  success:function(data){
						$(".salida").html(data).fadeIn('slow');
						$("#cargador").html("");
					}
			});
			 e.preventDefault();
		});
	</script>

