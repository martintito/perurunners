<?php 
	include ("connect.php");
	$sent="select * from vcorreo where id_pagos=".$_REQUEST['id'];
	$rs=mysql_db_query($sys_dbname,$sent);
	$ob=mysql_fetch_array($rs);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bienvenid@ a Peru Runners</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 25px;
	margin-right: 0px;
	margin-bottom: 0px;
}

section{
	width:800px;
	height:auto;
	margin-left:auto;
	margin-right:auto;
}

#logo_pr{
	width:150px;
	height:150px;
	background-image:url(http://www.perurunners.com/inscripciones/logopr.png);
}

#contenido1{
	margin-top:30px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size:14px;
	line-height:20px;
}

#contenido2{
	margin-top:30px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size:14px;
	line-height:20px;
}

#contenido3{
	margin-top:30px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size:14px;
	line-height:20px;
	margin-bottom:30px;
}
</style>
</head>

<body>


<section>

	<div id="logo_pr">
    </div>
    
  <div id="contenido1">
    
    Hola <?php echo $ob['nombre']; ?><br>
<br>
¡Bienvenid@ a Peru Runners Club!<br>
<br>
Ya eres parte del club de corredores más grande del Perú, el cual cuenta con 10 sedes y programas de entrenamientos ubicados en los principales puntos deportivos de Lima, con un staff de entrenadores altamente capacitados y certificados.
    
  </div>
    
    <div id="contenido2">
<?php echo $ob['correo']; ?>  </div>
    
     <div id="contenido3">
    
    Además de un entrenamiento de primera calidad, PERU RUNNERS CLUB te ofrece beneficios exclusivos para ti, los cuales podrás exigir presentando tu carnet de socio. Entérate de todos los beneficios que tenemos para ti entrando a: www.perurunners.com/beneficios. Recuerda recoger tu carnet en las oficinas de PERU RUNNERS:<br>
<br>
- Dirección: Calle Víctor Maúrtua 140, of. 603, San Isidro<br>
<br>
- Horario de atención: Lunes a Viernes de 9 a.m. – 1 p.m. / 3 p.m. – 6 p.m.<br>
<br>
Ante cualquier duda o consulta puedes escribirnos a clubperurunners@gmail.com<br>
<br>
Nuevamente, ¡bienvenido al club!<br>
<br>
PERU RUNNERS<br>
www.perurunners.com
    
    </div>

</section>

</body>
</html>
