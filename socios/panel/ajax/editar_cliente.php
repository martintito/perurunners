<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id_cliente"])){

	// escaping, additionally removing everything that could be (html/javascript-) code
     $nombres = mysqli_real_escape_string($con,(strip_tags($_POST['nombres'], ENT_QUOTES)));
	 $telefono = mysqli_real_escape_string($con,(strip_tags($_POST['telefono'], ENT_QUOTES)));
	 $email = mysqli_real_escape_string($con,(strip_tags($_POST['email'], ENT_QUOTES)));
	 $id=intval($_POST['id_cliente']);
	 $sql="UPDATE clientes SET nombres='$nombres', telefono='$telefono', email='$email' WHERE id_cliente='$id'";
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