<?php
	include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscripción Sede Women's Run Club</title>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
</head>

<body>
<form id="form1" name="form1" action="procesar.php" accept-charset="utf-8" method="post">
<div id="contenedorinscripcion">
  <div id="tituloinscripcion">
  <img src="../img/logowomen_inscrip.png" width="195" height="166" style="float:left;"/>
  <h1>Estás a un paso de ser parte de<br />PERU RUNNERS</h1>
  <h2>SEDE Women's Run Club</h2>
  </div>
  <div id="clear"></div>
  <div id="subtituloinscripcion">
  <h1>1. DATOS PERSONALES Y DE CONTACTO</h1>
  </div>
  <div class="textogris18" id="forminscripcion">
  Nombre Completo: <input id="nombre" name="nombre" type="text" class="casillasinscripcion" style="width: 370px;"><span style=" float:right;">Tipo de Documento: <select name="tipo_doc" id="tipo_doc" size="1" class="casillasinscripcion" style="width: 140px;height: 30px;">
    <?php
		$sent="select * from constantes where tipo='D' and activo=1";
		$rs=mysql_db_query($sys_dbname,$sent);
		while ($ob=mysql_fetch_array($rs))
			echo "<option value='".$ob['id']."'>".$ob['valor']."</option>";
	?>
  </select></span><br />
  
  Fecha de Nacimiento (aaaa-mm-dd): <input type="text" class="casillasinscripcion" style="width: 90px;" id="fecha_nac" name="fecha_nac"/><span style=" float:right;">Nº de Documento: <input name="n_doc" id="n_doc" type="text" class="casillasinscripcion" style="width: 200px;"/></span><br />
  
  Email: <input id="email" name="email" type="text" class="casillasinscripcion" style="width: 260px;"/>&emsp;&emsp;Teléfono Fijo:&emsp;<input name="telef_fijo" id="telef_fijo" type="text"class="casillasinscripcion" style="width: 130px;" /><span style=" float:right;">Teléfono Móvil: <input name="celular" id="celular" type="text" class="casillasinscripcion" style="width: 130px;"/></span><br />
  
  Sexo: <input name="sexo" type="radio" id="sexo" value="M" /> Masculino <input name="sexo" type="radio" id="sexo" value="F"  /> Femenino&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Talla de Polo&emsp;<select name="talla" id="talla" size="1" class="casillasinscripcion" style="width: 140px;height: 30px;">
    <?php
		$sent="select * from constantes where tipo='C' and activo=1";
		$rs=mysql_db_query($sys_dbname,$sent);
		while ($ob=mysql_fetch_array($rs))
			echo "<option value='".$ob['id']."'>".$ob['valor']."</option>";
	?>
  </select>
  </div>
  
   <div id="clear"></div>
  <div id="subtituloinscripcion">
  <h1>2. ESCOGE TU MEMBRESÍA</h1>
  </div>
  <div id="membresiainscripcion">
  	<div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Trimestral</span><br />
    S/. 240.00
    </div>
    <br />
    <input type="submit" class="pagaahora" value="Paga ahora" name="t7"/>
    </div>&emsp;&emsp;
    
    <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Semestral</span><br />
    S/. 410.00
    </div>
    <br />
    <input type="submit" class="pagaahora" value="Paga ahora" name="t8"/>
    </div>&emsp;&emsp;
    
    <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Anual - VIP</span><br />
    S/. 760.00
    </div>
    <br />
    <input type="submit" class="pagaahora" value="Paga ahora" name="t9"/>
    </div>
  
    <div id="clear50"></div>
<span class="fininscripcion">Para cualquier consulta, por favor comunicarse al correo <a href="mailto:clubrunnersperu@gmail.com">clubrunnersperu@gmail.com</a></span> 
  </div>

</div>
</form>
</body>
</html>
