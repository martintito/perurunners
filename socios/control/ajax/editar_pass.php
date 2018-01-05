<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
echo "<script>location.replace('login.php');</script>";
exit;
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id_user"])){
	/* Llamar la Cadena de Conexion*/ 
	include ("../../config/conexion.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
	 $pass = mysqli_real_escape_string($con,(strip_tags($_POST['pass'], ENT_QUOTES)));
	 $newpass = mysqli_real_escape_string($con,(strip_tags($_POST['newpass'], ENT_QUOTES)));
	 $actual_pass=md5($pass);
	 $password=md5($newpass);
	 $id=intval($_POST['id_user']);
	 $sql_pass=mysqli_query($con,"select * from user where user_id='$id' and password='$actual_pass'");
	 $num=mysqli_num_rows($sql_pass);
	 if ($num==1){
	 $sql="UPDATE user SET password='$password' WHERE user_id='$id'";
	 $query = mysqli_query($con,$sql);
	// if user has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido actualizados satisfactoriamente.";
	} else {
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
	}
	 } else {
		$errors []= "La contraseña actual no coincide."; 
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