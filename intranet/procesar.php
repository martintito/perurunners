<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

<?php
if(isset($_POST['grabar'])){
	$pat = $_POST['paterno'];
	$mat = $_POST['materno'];
	$nom = $_POST['nombre'];
	$dir = $_POST['direccion'];
	$dis = $_POST['distrito'];
	$sede = $_POST['sede'];
	$doc = $_POST['tipo_doc'];
	$num = $_POST['num_doc'];
	$fec = $_POST['fecha_nac'];
	$mail = $_POST['email'];
	$tel = $_POST['tele_fijo'];
	$cel = $_POST['celular'];
	$gen = $_POST['sexo'];
	$talp = $_POST['talla_pol'];
	$talz = $_POST['talla_zap'];
	include 'connect.php';
	$sql="insert into socio values(0,'$pat','$mat','$nom','$doc','$num','$dir','$dis','$sede','$mail','$fec','$gen','$tel','$cel','$talp','$talz','$num','$num','1')";
	$res=mysqli_query($con,$sql);
	if($res){
		echo 'Registro grabado';
	}else{
		echo 'Error: ',mysqli_connect_error();
	}
}
?>  
</body>
</html>