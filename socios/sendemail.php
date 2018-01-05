<?php
date_default_timezone_set('America/El_Salvador');//Hora formato de El Salvador
/* Llamar la Cadena de Conexion*/
include ("config/conexion.php");
if (isset($_POST["email"])){
	$email=strip_tags($_POST["email"]);
	$mensaje=strip_tags($_POST["mensaje"]);
	$nombres=strip_tags($_POST["nombres"]);
	$asunto=strip_tags($_POST["asunto"]);
	
		/*SIGUE RECOLECTANDO DATOS PARA FUNCION MAIL*/
	$message = '<p>Mensaje del formulario de contáctenos en el sitio web según el detalle siguiente:</p> ';
	$message .= '<p>Fecha:'.date('d-m-Y H:i:s').'</p> ';
	$message .= '<p>solicitud hecha por: '.$nombres.'</p> ';
	$message .= '<p>Mensaje: '.$mensaje.'</p> ';

	$websiteName=$nombres;
	$emailAddress=$email;
	$header = "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$header .= "From: ". $websiteName . " <" . $emailAddress . ">\r\n";
	$email_inbox=$business_email;
	$subject=$asunto;			
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

