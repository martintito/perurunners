<?php 
$destinatario1 = "alricaldi@hotmail.com"; 
$destinatario = $mail; 
$asunto = "Bienvenido al Club de Socios PERU RUNNERS"; 
$cuerpo = "<DOCTYPE html>
<html> 
<head>
<meta charset=utf-8>
<title>Club de Socios Activos</title> 
</head> 
<body> 
<h2>Hola estimado $nom !</h2> 
<p> 
<b>Bienvenido al Club de Socios PERU RUNNERS</b>. 
</p> 
<p>
Estamos encantados de tenerte como Socio Activo de PERU RUNNERS
</p>
<p>
Tu nombre de usuario es:<b> $num </b>
</p>
<p>
Tu clave de usuario es:<b> $num </b>
</p>
<br>Visite nuestro Portal Web haciendo click en: <a href='http://www.perurunners.com'>PERU RUNNERS</a>
</body>
</html>"; 
//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
//dirección del remitente 
$headers .= "From: Alejandro Ricaldi Rosas <info@perurunners.com>\r\n"; 
mail($destinatario,$asunto,$cuerpo,$headers) ;
mail($destinatario1,$asunto,$cuerpo,$headers) ;
//echo 'correo enviado';