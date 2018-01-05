<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
echo "<script>location.replace('login.php');</script>";
exit;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
	/* Llamar la Cadena de Conexion*/ 
	include ("../../config/conexion.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
     $nombre_categoria = mysqli_real_escape_string($con,(strip_tags($_POST['nombre_categoria'], ENT_QUOTES)));
	 $parent=intval($_POST['parent']);
	 $sql="insert into categorias (nombre_categoria, parent) values ('$nombre_categoria','$parent')";
	 $query = mysqli_query($con,$sql);
	// if user has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido guardados satisfactoriamente.";
	} else {
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
	}
	
	if (isset($errors)){
			
			?>
			<div class="alert alert-error" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
		}
		if (isset($messages)){
			
			?>
			<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>¡Bien hecho!</strong>
					<?php
						foreach ($messages as $message) {
								echo $message;
							}
						?>
			</div>
			<?php
		}
		
}
?>