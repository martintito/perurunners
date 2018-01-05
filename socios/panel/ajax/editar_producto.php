<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id_producto"])){

	// escaping, additionally removing everything that could be (html/javascript-) code
     $codigo = mysqli_real_escape_string($con,(strip_tags($_POST['codigo'], ENT_QUOTES)));
	 $modelo = mysqli_real_escape_string($con,(strip_tags($_POST['modelo'], ENT_QUOTES)));
	 $producto = mysqli_real_escape_string($con,(strip_tags($_POST['producto'], ENT_QUOTES)));
	 $descripcion = mysqli_real_escape_string($con,($_POST['descripcion']));
	 $id_fabricante = intval($_POST['id_fabricante']);
	 $categoria = intval($_POST['cat']);
	 $estado = intval($_POST['estado']);
	 $price = floatval($_POST['price']);
	 $price_offer = floatval($_POST['price_offer']);
	 $id_producto=intval($_POST['id_producto']);
	 $sql="UPDATE productos SET codigo_producto='$codigo', nombre_producto='$producto', descripcion_producto='$descripcion', modelo_producto='$modelo', id_fabricante='$id_fabricante', id_categoria='$categoria', status_producto='$estado', price='$price', price_offer='$price_offer' WHERE id_producto='$id_producto'";
	 $query = mysqli_query($con,$sql);
	// if user has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido actualizados satisfactoriamente.";
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