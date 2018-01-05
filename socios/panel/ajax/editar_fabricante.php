<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_FILES['fileToUpload']) ){

	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre_fabricante = mysqli_real_escape_string($con,(strip_tags($_POST['nombre_fabricante'], ENT_QUOTES)));
	$id_fabricante = intval($_POST['id_fabricante']);
	
	$carpeta = "../../img/marcas/";
	$target_file = $carpeta . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$errors[]= "El archivo es una imagen - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$errors[]= "El archivo no es una imagen.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$errors[]="Lo sentimos, archivo ya existe.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 524288) {
			$errors[]= "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 0.5 MB";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$errors[]= "Lo sentimos, sólo archivos JPG, JPEG, PNG & GIF  son permitidos.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$errors[]= "Lo sentimos, tu archivo no fue subido.";
		// if everything is ok, try to upload file
		}else {
			
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			   $ruta=$_FILES["fileToUpload"]["name"];
			  $sql="update fabricantes set nombre_fabricante='$nombre_fabricante', logo_url='$ruta' where  id_fabricante='$id_fabricante'";
				 $query = mysqli_query($con,$sql);
				
				if ($query) {
					$messages[] = "Datos  han sido guardados satisfactoriamente.";
				} else {
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				} 	
			   
			} else {
			   $errors[]= "Lo sentimos, hubo un error subiendo el archivo.";
			}
	
	
			
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
else if($_SERVER['REQUEST_METHOD'] == "POST" )
{
	/* Llamar la Cadena de Conexion*/ 
	include ("../../config/conexion.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre_fabricante = mysqli_real_escape_string($con,(strip_tags($_POST['nombre_fabricante'], ENT_QUOTES)));
	$id_fabricante = intval($_POST['id_fabricante']);
	 $sql="update fabricantes set nombre_fabricante='$nombre_fabricante' where  id_fabricante='$id_fabricante'";
	$query = mysqli_query($con,$sql);
	if ($query) {
		$messages[] = "Datos  han sido guardados satisfactoriamente.";
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