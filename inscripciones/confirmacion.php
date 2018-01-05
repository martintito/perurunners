<?php
  include "connect.php";
  $insc=substr($_REQUEST['reference_sale'],(strpos($_REQUEST['reference_sale'],'-')+1),strlen($_REQUEST['reference_sale']));
  $sent="insert into pagos (inscripcion, moneda, total, descripcion, reference, cod_estado, estado, fecha_p, fecha_c, fecha_r, entidad) values ('".$insc."', '".$_REQUEST['currency']."', '".$_REQUEST['value']."', '".$_REQUEST['description']."', '".$_REQUEST['reference_sale']."', '".$_REQUEST['response_code_pol']."', '".$_REQUEST['response_message_pol']."', '".$_REQUEST['transaction_date']."', '".$_REQUEST['date']."', DATE_ADD(NOW(), INTERVAL 3 HOUR), '".$_REQUEST['payment_method_name']."')";
  $rs=mysql_db_query($sys_dbname, $sent);
  $nuevo_id=mysql_insert_id();
  $sent="select * from vcorreo where id_pagos=".$nuevo_id;
  $rs=mysql_db_query($sys_dbname, $sent);
  $ob=mysql_fetch_array($rs);
require_once("PHPMailer/class.phpmailer.php");
if($nuevo_id!=0){
	$body = file_get_contents('http://perurunners.com/inscripciones/correo_bienvenida.php?id='.$nuevo_id);
	$mail = new PHPMailer();
	$mail->From = "inscripcionesOnLine@perurunners.com";
	$mail->FromName = "Peru Runners";
	$mail->Subject = "Bienvenido a Peru Runners Club";
	$mail->Body = $body;
	$mail->IsHTML(true);
	$mail->AddAddress($ob['email'], $ob['nombre']);
	$mail->AddBCC("royperezp@gmail.com", "Rpp");
	$mail->Send();
	if(!$mail->send()) 
	{
		echo "Error al enviar el correo: " . $mail->ErrorInfo;
	} 
	else 
	{
		echo "Mensaje al socio enviado correctamente";
	}
	$sent= "select * from vdatos where id=".$ob['id_inscripciones'];
	$rs1=mysql_db_query($sys_dbname, $sent);
  	$ob1=mysql_fetch_array($rs1);
	$body = '<table width="200" border="1">
  <tbody>
    <tr>
      <td colspan="2">Datos del participante</td>
    </tr>
    <tr>
      <td>Id</td>
      <td>'.$ob1['id'].'</td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td>'.$ob1['nombre'].'</td>
    </tr>
    <tr>
      <td>Tipo doc.</td>
      <td>'.$ob1['tipo_doc'].'</td>
    </tr>
    <tr>
      <td>N. doc.</td>
      <td>'.$ob1['n_doc'].'</td>
    </tr>
    <tr>
      <td>Fecha de Nac</td>
      <td>'.$ob1['fecha_nac'].'</td>
    </tr>
    <tr>
      <td>email</td>
      <td>'.$ob1['email'].'</td>
    </tr>
    <tr>
      <td>Telef. Fijo</td>
      <td>'.$ob1['telef_fijo'].'</td>
    </tr>
    <tr>
      <td>Celular</td>
      <td>'.$ob1['celular'].'</td>
    </tr>
    <tr>
      <td>Sexo</td>
      <td>'.$ob1['sexo'].'</td>
    </tr>
    <tr>
      <td>Talla de polo</td>
      <td>'.$ob1['talla'].'</td>
    </tr>
    <tr>
      <td>Fecha y hora Inscripción</td>
      <td>'.$ob1['fecha_ins'].'</td>
    </tr>
    <tr>
      <td>Membresia</td>
      <td>'.$ob1['tipo'].'</td>
    </tr>
  </tbody>
</table>';
	$mail1 = new PHPMailer();
	$mail1->From = "inscripcionesOnLine@perurunners.com";
	$mail1->FromName = "Peru Runners";
	$mail1->Subject = "Nueva inscripción a Peru Runners Club";
	$mail1->Body = $body;
	$mail1->IsHTML(true);
	$mail1->AddAddress('clubrunnersperu@gmail.com', 'Peru Runners');
	$mail1->AddBCC("royperezp@gmail.com", "Rpp");
	$mail1->Send();
	if(!$mail1->send()) 
	{
		echo "Error al enviar el correo: " . $mail1->ErrorInfo;
	} 
	else 
	{
		echo "Mensaje al socio enviado correctamente";
	}
}
?>