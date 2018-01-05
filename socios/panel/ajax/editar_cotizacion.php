<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id_cotizacion"])){

	// escaping, additionally removing everything that could be (html/javascript-) code
     $estado=intval($_POST['estado']);
	 $garantia = mysqli_real_escape_string($con,(strip_tags($_POST['garantia'], ENT_QUOTES)));
	 $condiciones = mysqli_real_escape_string($con,(strip_tags($_POST['condiciones'], ENT_QUOTES)));
	 $validez = mysqli_real_escape_string($con,(strip_tags($_POST['validez'], ENT_QUOTES)));
	 $entrega = mysqli_real_escape_string($con,(strip_tags($_POST['entrega'], ENT_QUOTES)));
	 $cantidad=intval($_POST['cantidad']);
	 $precio=floatval($_POST['precio']);
	 $descuento=floatval($_POST['descuento']);
	 $id_cotizacion=intval($_POST['id_cotizacion']);
	
	 
	 $sql="UPDATE cotizaciones SET estado='$estado', terms='$condiciones', 	validity='$validez', delivery='$entrega', cantidad='$cantidad', precio='$precio', total_descuento='$descuento', note='$garantia' WHERE id='$id_cotizacion'";
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