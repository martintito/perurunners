<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

<?php
	function extrae($codigo){
		$aux=substr($codigo,1,strlen($codigo));
		return $aux;	
	}
	include "connect.php";
	$sent="insert into inscripciones (nombre, tipo_doc, n_doc, fecha_nac, email, telef_fijo, celular, sexo, talla, fecha_ins) values ('".$_POST['nombre']."', '".$_POST['tipo_doc']."', '".$_POST['n_doc']."', '".$_POST['fecha_nac']."', '".$_POST['email']."', '".$_POST['telef_fijo']."', '".$_POST['celular']."', '".$_POST['sexo']."', '".$_POST['talla']."', DATE_ADD(NOW(), INTERVAL 3 HOUR))";
	if ($rs=mysql_db_query($sys_dbname, $sent)){
		echo '<script>
    	window.onload=function(){
				document.forms["form1"].submit();
			}
    </script>
		</head> 
<body>';
		$nuevo_id=mysql_insert_id();
		if(isset($_POST['t10']))
			$aux=10;
		
		if($aux!=""){
			$sent="select * from tipo where id=".$aux;
			$rs=mysql_db_query($sys_dbname, $sent);
			$ob=mysql_fetch_array($rs);
			$sent1="select * from constantes where tipo='A' and activo=1 order by id";
			$rs1=mysql_db_query($sys_dbname, $sent1);
			$ob1=mysql_fetch_array($rs1);
			$ApiKey = $ob1['valor'];
			echo '<form method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway" accept-charset="UTF-8" name="form1">';
			//echo '<form method="post" action="https://gateway.payulatam.com/ppp-web-gateway" accept-charset="UTF-8" name="form1">';
			echo '<input name="ApiKey" type="hidden" value="'.$ApiKey.'"/>';
			while ($ob1=mysql_fetch_array($rs1)){
				echo '<input name="'.$ob1['descripcion'].'" type="hidden" value="'.$ob1['valor'].'"/>';
				if($ob1['descripcion']==="merchantId")
					$aux2=$ob1['valor'];
			}
				
			echo '<input name="tax" type="hidden" value="0"/>
	<input name="taxReturnBase" type="hidden" value="0"/>';
			$aux1=$ob['reference']."-".$nuevo_id;
			echo '<input name="description" type="hidden" value="'.$ob['descripcion'].'"/>
	<input name="referenceCode" type="hidden" value="'.$aux1.'"/>
	<input name="amount" type="hidden" value="'.$ob['precio'].'"/>	
	<input name="currency" type="hidden" value="'.$ob['moneda'].'"/>';
			$firma=$ApiKey."~".$aux2."~".$aux1."~".$ob['precio']."~".$ob['moneda'];
			$firma_enc=md5($firma);
			echo '<input name="signature" value="'.$firma_enc.'" type="hidden"/>';
			echo '<input name="buyerEmail" value="'.$_POST['email'].'" type="hidden"/>';
			echo '<input name="test" value="1" type="hidden"/>';
			echo '<input name="buyerFullName" value="'.$_POST['nombre'].'" type="hidden"/>';
			echo '<input name="payerFullName" value="'.$_POST['nombre'].'" type="hidden"/>';
			echo '<input name="payerDocument" value="'.$_POST['n_doc'].'" type="hidden"/>';
			echo '<input name="payerPhone" value="'.$_POST['celular'].'" type="hidden"/>';
			echo '</form>';
		}
		

	}
	else{
		echo "ERROR EN EL INGRESO DE DATOS DEL PARTICIPANTE:".$sent;
		echo "</head> 
<body>";
	}
?>  
</body>
</html>