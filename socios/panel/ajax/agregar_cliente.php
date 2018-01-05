<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");


if($_SERVER['REQUEST_METHOD'] == "POST"){

	// escaping, additionally removing everything that could be (html/javascript-) code
	 $nombres = mysqli_real_escape_string($con,(strip_tags($_POST['nombres'], ENT_QUOTES)));
	 $telefono = mysqli_real_escape_string($con,(strip_tags($_POST['telefono'], ENT_QUOTES)));
	 $email = mysqli_real_escape_string($con,(strip_tags($_POST['email'], ENT_QUOTES)));
	 $agregado=date("Y-m-d");
	 $sql="insert into clientes (nombres,telefono, email, agregado) value ('$nombres','$telefono','$email','$agregado')";
	 $query = mysqli_query($con,$sql);
	// if has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido almacenados satisfactoriamente.";
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