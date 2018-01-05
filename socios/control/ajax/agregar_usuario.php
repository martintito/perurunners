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
	 $nombres = mysqli_real_escape_string($con,(strip_tags($_POST['nombres'], ENT_QUOTES)));
	 $apellidos = mysqli_real_escape_string($con,(strip_tags($_POST['apellidos'], ENT_QUOTES)));
	 $username = mysqli_real_escape_string($con,(strip_tags($_POST['usuario'], ENT_QUOTES)));
	 $status=intval($_POST['estado']);
	 $pass =$_POST['pass'];
	 $password=md5($pass);
	 $sql="insert into user (username,nombres,apellidos, password, status) value ('$username','$nombres','$apellidos','$password','$status')";
	 $query = mysqli_query($con,$sql);
	// if user has been added successfully
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