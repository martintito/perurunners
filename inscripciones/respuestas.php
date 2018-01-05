<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscripción Exitosa - Peru Runners</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #fff;
}
</style>
</head>

<body>
<div id="contenedorinscripcion">
  <div id="tituloinscripcion">
  <img src="logopr.png" width="150" height="150" style="float:left;"/>
  <h1>Ya eres parte de<br />
  </h1>
  <h2>Peru Runners</h2>
  </div>
  <div id="clear"></div>
  <div id="subtituloinscripcion">
  <h1>TU OPERACIÓN SE HA REALIZADO CON ÉXITO</h1>
  </div>
  <div class="textogris18" id="forminscripcion">
  Tu pago de inscripción para Peru Runners ha sido realizado con éxito.
En breve se te enviará un mail al correo que registraste con todas las indicaciones sobre tu sede de entrenamiento, beneficios y otros.<br />
<strong>Team Peru Runners</strong></div>
  
   <div id="clear"></div>
  <div id="subtituloinscripcion">
  <h1>--- MIRA LOS DATOS DE TU OPERACIÓN ---</h1>
  </div>
  
  <div class="textogris18" id="forminscripcion">
  <?php
	include "connect.php";
	$sent="select * from constantes where id=1";
	$rs=mysql_db_query($sys_dbname,$sent);
	$ob=mysql_fetch_array($rs);
	$ApiKey = $ob['valor'];
	$merchant_id = $_REQUEST['merchantId'];
	$referenceCode = $_REQUEST['referenceCode'];
	$TX_VALUE = $_REQUEST['TX_VALUE'];
	$New_value = number_format($TX_VALUE, 1, '.', '');
	$currency = $_REQUEST['currency'];
	$transactionState = $_REQUEST['transactionState'];
	$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
	$firmacreada = md5($firma_cadena);
	$firma = $_REQUEST['signature'];
	$reference_pol = $_REQUEST['reference_pol'];
	$cus = $_REQUEST['cus'];
	$extra1 = $_REQUEST['description'];
	$pseBank = $_REQUEST['pseBank'];
	$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
	$transactionId = $_REQUEST['transactionId'];

	if ($_REQUEST['transactionState'] == 4 ) {
		$estadoTx = "Transacción aprobada";
	}
	
	else if ($_REQUEST['transactionState'] == 6 ) {
		$estadoTx = "Transacción rechazada";
	}
	
	else if ($_REQUEST['transactionState'] == 104 ) {
		$estadoTx = "Error";
	}
	
	else if ($_REQUEST['transactionState'] == 7 ) {
		$estadoTx = "Transacción pendiente";
	}
	
	else {
		$estadoTx=$_REQUEST['mensaje'];
	}
	
	
	if (strtoupper($firma) == strtoupper($firmacreada)) {
	?>
	<table>
	<tr>
	<td>Estado de la transaccion</td>
	<td><?php echo $estadoTx; ?></td>
	</tr>
	<tr>
	<tr>
	<td>ID de la transaccion</td>
	<td><?php echo $transactionId; ?></td>
	</tr>
	<tr>
	<td>Referencia de la venta</td>
	<td><?php echo $reference_pol; ?></td> 
	</tr>
	<tr>
	<td>Referencia de la transaccion</td>
	<td><?php echo $referenceCode; ?></td>
	</tr>
	<tr>
	<?php
	if($pseBank != null) {
	?>
		<tr>
		<td>cus </td>
		<td><?php echo $cus; ?> </td>
		</tr>
		<tr>
		<td>Banco </td>
		<td><?php echo $pseBank; ?> </td>
		</tr>
	<?php
	}
	?>
	<tr>
	<td>Valor total</td>
	<td>S/<?php echo number_format($TX_VALUE); ?></td>
	</tr>
	<tr>
	<td>Moneda</td>
	<td><?php echo $currency; ?></td>
	</tr>
	<tr>
	<td>Descripción</td>
	<td><?php echo ($extra1); ?></td>
	</tr>
	<tr>
	<td>Entidad:</td>
	<td><?php echo ($lapPaymentMethod); ?></td>
	</tr>
	</table>
<?php
}

?>

  
  </strong></div>
  
    <div id="clear50"></div>
<span class="fininscripcion">-----<br />
Para cualquier consulta, por favor comunicarse al correo <a href="mailto:clubrunnersperu@gmail.com">clubrunnersperu@gmail.com</a></span> 
  </div>

</div>
</body>
</html>
