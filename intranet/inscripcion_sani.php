<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscripción Sede San Isidro</title>
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
  <img src="../img/logosani_inscrip.png" width="195" height="166" style="float:left;"/>
  <h1>Estás a un paso de ser parte de<br />PERU RUNNERS</h1>
  <h2>SEDE CENTRAL</h2>
  </div>
  <div id="clear"></div>
  <div id="subtituloinscripcion">
  <h1>1. DATOS PERSONALES Y DE CONTACTO</h1>
  </div>
  <div class="textogris18" id="forminscripcion">
  Apellido Paterno:&emsp;<input id="paterno" name="paterno" type="text" class="casillasinscripcion" style="width: 370px;" required=""><br>
  Apellido Materno:&emsp;<input id="materno" name="materno" type="text" class="casillasinscripcion" style="width: 370px;" required=""><br>
  Nombres:&emsp;<input id="nombre" name="nombre" type="text" class="casillasinscripcion" style="width: 370px;" required=""><br>
  Dirección:&emsp;<textarea id="direccion" name="direccion" type="text" class="casillasinscripcion" style="width: 370px;" rows="2" required></textarea>
    <span style=" float:right;">
  Distrito:&emsp;<select name="distrito" id="distrito" size="1" class="casillasinscripcion" style="width: 200px;height: 30px;">
				<option value="San Isidro">San Isidro</option>
				<option value="San Isidro">San Borja</option>
				<option value="San Isidro">Miraflores</option>
				<option value="San Isidro">El Agustino</option>
			</select></span><br>
  Tipo de Documento:&emsp;<select name="tipo_doc" id="tipo_doc" size="1" class="casillasinscripcion" style="width: 140px;height: 30px;">
			<option value="DNI">DNI</option>
			<option value="DNI">CE</option>
  </select>
    <span style=" float:right;">
  Nº de Documento:&emsp;<input name="num_doc" id="num_doc" type="number" class="casillasinscripcion" style="width: 200px;" required="" /></span><br />
  Fecha de Nacimiento (aaaa-mm-dd):&emsp;<input type="date" class="casillasinscripcion" style="width: 140px;" id="fecha_nac" name="fecha_nac"/><br>
  
  Correo Electrónico:&emsp;<input id="email" name="email" type="text" class="casillasinscripcion" style="width: 445px;" required=""/><br>
  Teléfono Fijo:&emsp;<input name="tele_fijo" id="tele_fijo" type="number"class="casillasinscripcion" style="width: 130px;" />
  <span style=" float:right;">
  Teléfono Móvil:&emsp;<input name="celular" id="celular" type="number" class="casillasinscripcion" style="width: 130px;"/>
  </span><br />
  
  Género:&emsp;<input name="sexo" type="radio" id="sexo" value="M" checked=""/>Masculino<input name="sexo" type="radio" id="sexo" value="F"  />Femenino&emsp;&emsp;&emsp;&emsp;
  Talla de Polo:&emsp;<select name="talla_pol" id="talla_pol" size="1" class="casillasinscripcion" style="width: 100px;height: 30px;">
		<option value="S">S</option>
		<option value="M">M</option>
		<option value="L">L</option>
		<option value="XL">XL</option>
  </select>&emsp;&emsp;&emsp;&emsp;
  Talla de Zapatilla:&emsp;<select name="talla_zap" id="talla_zap" size="1" class="casillasinscripcion" style="width: 100x;height: 30px;">
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
  </select>

  </div>
  
   <div id="clear"></div>
  <div id="subtituloinscripcion">
  <h1>2. ESCOGE TU MEMBRESÍA</h1>
  </div>
  <div id="membresiainscripcion">
  <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Normal</span><br />
    S/. 0.00
    </div>
    <br />
    <input type="radio" value="N" name="membresia" id="membresia" checked=""/>Normal
    </div>&emsp;&emsp;
	
  	<div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Trimestral</span><br />
    S/. 240.00
    </div>
    <br />
    <input type="radio" value="T" name="membresia" id="membresia"/>Trimestral
    </div>&emsp;&emsp;
    
    <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Semestral</span><br />
    S/. 410.00
    </div>
    <br />
    <input type="radio" value="S" name="membresia" id="membresia"/>Semestral
    </div>&emsp;&emsp;
    
    <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Anual - VIP</span><br />
    S/. 760.00
    </div>
    <br />
    <input type="radio" value="A" name="membresia" id="membresia"/>Anual - VIP
    </div>
    <br><br>
  <input type="submit" class="pagaahora" name="grabar" id="grabar" value="GRABAR INSCRIPCIÓN">
    <div id="clear50"></div>
<span class="fininscripcion">Para cualquier consulta, por favor comunicarse al correo <a href="mailto:clubrunnersperu@gmail.com">clubrunnersperu@gmail.com</a></span> 
  </div>

</div>
</form>
</body>
</html>
