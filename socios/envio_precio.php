<?php
include("config/conexion.php");
if (isset($_POST["email"])){
	$email=mysqli_real_escape_string($con,(strip_tags($_POST['email'], ENT_QUOTES)));
	$mensaje=strip_tags($_POST["mensaje"]);
	$nombres=mysqli_real_escape_string($con,(strip_tags($_POST['nombres'], ENT_QUOTES)));
	$telefono=mysqli_real_escape_string($con,(strip_tags($_POST['telefono'], ENT_QUOTES)));
	$id_producto=intval($_POST["id_producto"]);
	$cantidad=intval($_POST["cantidad"]);
	$fecha=date("Y-m-d");
		/*SIGUE RECOLECTANDO DATOS PARA FUNCION MAIL*/
	$message = '<p>Hola, ha sido registrado una nueva solicitud de precios en el sitio web según el detalle siguiente:</p> ';
	$message .= '<p>Fecha:'.date('d-m-Y H:i:s').'</p> ';
	$message .= '<p>solicitud hecha por: '.$nombres.'</p> ';
	$message .= '<p>Mensaje: '.$mensaje.'</p> ';

	$websiteName=$nombres;
	$emailAddress=$email;
	$header = "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html; charset=UTF-8\r\n";
	$header .= "From: ". $websiteName . " <" . $emailAddress . ">\r\n";
	$email_inbox=$business_email;
	$id_cliente= id_cliente($email);
	$precio=precio($id_producto);
	
	if ($id_cliente==0){
		agregar_cliente($nombres,$telefono,$email,$fecha);
		$id_cliente= id_cliente($email);
		agregar_cotizacion($fecha,$id_cliente,$id_producto,$cantidad,$precio);
	} else {
		agregar_cotizacion($fecha,$id_cliente,$id_producto,$cantidad,$precio);
	}
	
	
	$subject="CONSULTA DE PRECIOS";			
	if  (mail($email_inbox,$subject,$message,$header)){
		?>
		<div class="alert alert-success alert-dismissible text-left" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Bien hecho!</strong> Datos enviados exitosamente,  tan pronto como podamos responderemos a tu consulta.
		</div>
		<?php
	}else {
		?>
		<div class="alert alert-danger alert-dismissible text-left" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Error!</strong> No fue posible enviar los datos, le sugerimos que intente nuevamente, si el error persiste escribenos un correo electrónico a info@puntosdeventa.com
		</div>
		<?php
	}	
	/*FINALIZA RECOLECTANDO DATOS PARA FUNCION MAIL*/
}
?>

<?php
	function id_cliente($email){
		global $con;
		$sql=mysqli_query($con,"select id_cliente from clientes where email='".$email."'");
		$count=mysqli_num_rows($sql);
		if ($count==0){
			return $id_cliente=0;
		} else {
			$rw=mysqli_fetch_array($sql);
			return $rw['id_cliente'];
		}
		
	}
	function agregar_cliente($nombres,$telefono, $email,$fecha){
		global $con;
		$insert=mysqli_query($con,"insert into clientes (nombres, telefono, email, agregado) values ('$nombres','$telefono','$email','$fecha')");
	}
	
	function agregar_cotizacion($fecha,$id_cliente,$id_producto,$cantidad,$precio){
		global $con;
		$insert=mysqli_query($con,"insert into cotizaciones (fecha, id_cliente, id_producto,cantidad,precio) values ('$fecha','$id_cliente','$id_producto','$cantidad','$precio')");
	}
	
	function precio($id_producto){
		global $con;
		$sql=mysqli_query($con,"select price from productos where id_producto='".$id_producto."'");
		$rw=mysqli_fetch_array($sql);
		return $rw['price'];
	}
	
	
?>