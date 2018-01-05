<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["fileToUpload"]["type"])){
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

$id_producto=intval($_POST['id']);
$target_dir = "../../manuales/";
$carpeta=$target_dir.$id_producto."/";
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

$target_file = $carpeta . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    $errors[]="Lo sentimos, archivo ya existe.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5242880) {
    $errors[]= "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 2.5 MB";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "pdf") {
    $errors[]= "Lo sentimos, sólo archivos PDF  son permitidos.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $errors[]= "Lo sentimos, tu archivo no fue subido.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $messages[]= "El Archivo ha sido subido correctamente.";
	   $ruta="manuales/$id_producto/".$_FILES["fileToUpload"]["name"];
	   $descripcion_archivo=$_FILES["fileToUpload"]["name"];
	 $insert=mysqli_query($con,"insert into archivos_pdf (descripcion_archivo, url_archivo, id_producto) values ('$descripcion_archivo','$ruta','$id_producto')");
	   
    } else {
       $errors[]= "Lo sentimos, hubo un error subiendo el archivo.";
    }
}

if (isset($errors)){
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Error!</strong> 
	  <?php
	  foreach ($errors as $error){
		  echo"<p>$error</p>";
	  }
	  ?>
	</div>
	<?php
}

if (isset($messages)){
	?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Aviso!</strong> 
	  <?php
	  foreach ($messages as $message){
		  echo"<p>$message</p>";
	  }
	  ?>
	</div>
	<?php
}

?>
				<table class='table table-condensed'>
					<?php
					$query_pdf=mysqli_query($con,"select * from archivos_pdf where id_producto='$id_producto'");
					while ($rw_pdf=mysqli_fetch_array($query_pdf)){
						$url_archivo=$rw_pdf['url_archivo'];
						$descripcion_archivo=$rw_pdf['descripcion_archivo'];
						$id_archivo=$rw_pdf["id_archivo"];
						?>
						<tr>
							<td><a href='../<?php echo $url_archivo;?>' target='_blank'><?php echo $descripcion_archivo;?></a></td>
							<td> <a href='#' onclick="eliminar_pdf('<?php echo $id_archivo;?>');"><i class='glyphicon glyphicon-trash'></i> </a></td>
						</tr>
						 
						<?php
					}
					?>
					</table>
<?php

}
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'delete'){
	/* Llamar la Cadena de Conexion*/ 
	include ("../../config/conexion.php");
	$id_archivo=intval($_REQUEST['id']);
	$get_url=mysqli_query($con,"select * from archivos_pdf where id_archivo='$id_archivo'");
	$rw_url=mysqli_fetch_array($get_url);
	$url_del=$rw_url['url_archivo'];
	$id_producto=$rw_url['id_producto'];
	//Borra el fichero
	$delete='../../'.$url_del;
	@unlink($delete);
	$delete_sql=mysqli_query($con,"delete from  archivos_pdf where id_archivo='$id_archivo'");
	?>
				<table class='table table-condensed'>
					<?php
					$query_pdf=mysqli_query($con,"select * from archivos_pdf where id_producto='$id_producto'");
					while ($rw_pdf=mysqli_fetch_array($query_pdf)){
						$url_archivo=$rw_pdf['url_archivo'];
						$descripcion_archivo=$rw_pdf['descripcion_archivo'];
						$id_archivo=$rw_pdf["id_archivo"];
						?>
						<tr>
							<td><a href='../<?php echo $url_archivo;?>' target='_blank'><?php echo $descripcion_archivo;?></a></td>
							<td> <a href='#' onclick="eliminar_pdf('<?php echo $id_archivo;?>');"><i class='glyphicon glyphicon-trash'></i> </a></td>
						</tr>
						 
						<?php
					}
					?>
					</table>
	<?php
	
}
?> 