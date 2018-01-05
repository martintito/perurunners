<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id_producto_ficha"])){

	// escaping, additionally removing everything that could be (html/javascript-) code
     $propiedad = mysqli_real_escape_string($con,(strip_tags($_POST['propiedad'], ENT_QUOTES)));
	 $valor = mysqli_real_escape_string($con,(strip_tags($_POST['valor'], ENT_QUOTES)));
	 $id_producto=intval($_POST['id_producto_ficha']);
	 $descripcion_ficha="$propiedad || $valor ";
	 $sql="INSERT INTO ficha_tecnica (descripcion_ficha, id_producto) VALUES ('$descripcion_ficha','$id_producto')";
	 $query = mysqli_query($con,$sql);
	// if user has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido agregados satisfactoriamente.";
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
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'delete'){
	/* Llamar la Cadena de Conexion*/ 
	include ("../../config/conexion.php");
	$id_ficha=intval($_REQUEST['id']);
	$get_id=mysqli_query($con,"select * from ficha_tecnica where id_ficha='$id_ficha'");
	$rw_id=mysqli_fetch_array($get_id);
	$id_producto=$rw_id['id_producto'];
	$delete=mysqli_query($con,"delete from ficha_tecnica where id_ficha='$id_ficha'");
}
?>

			<?php
			$sql_ficha=mysqli_query($con,"select * from ficha_tecnica where id_producto='$id_producto'");
			$num=mysqli_num_rows($sql_ficha);
			if ($num>0){
			?>
			<table class="table">
				<tr>
					<th>Propiedad</th>
					<th>Valor</th>
					<td></td>
				</tr>
				<?php
					while ($rw_ficha=mysqli_fetch_array($sql_ficha)){
						$descripcion_ficha=$rw_ficha['descripcion_ficha'];
						list($propiedad,$valor)=explode("||",$descripcion_ficha);
						$id_ficha=$rw_ficha['id_ficha'];
						?>
						<tr>
							<td><?php echo $propiedad;?></td>
							<td><?php echo $valor;?></td>
							<td><a href='#' onclick="eliminar_ficha('<?php echo $id_ficha;?>')"><i class='glyphicon glyphicon-trash'></i></a></td>
						</tr>
						<?php
					}
				?>
			</table>
			<?php
			}
			?>