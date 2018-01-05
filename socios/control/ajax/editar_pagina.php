<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
echo "<script>location.replace('login.php');</script>";
exit;
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id_pagina"])){
	/* Llamar la Cadena de Conexion*/ 
	include ("../../config/conexion.php");
	include("../../slug.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
     $titulo = mysqli_real_escape_string($con,(strip_tags($_POST['titulo'], ENT_QUOTES)));
	 $descripcion = mysqli_real_escape_string($con,($_POST['descripcion']));
	 $slug = mysqli_real_escape_string($con,($_POST['slug']));
	 $slug_final=create_slug($titulo);
	 $estado=intval($_POST['estado']);
	 $id_pagina=intval($_POST['id_pagina']);
	 $sql="UPDATE paginas SET titulo='$titulo', descripcion='$descripcion', estado='$estado', slug='$slug_final' WHERE id_pagina='$id_pagina'";
	 $query = mysqli_query($con,$sql);
	// if user has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido actualizados satisfactoriamente.";
	} else {
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
	}
	
	if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
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