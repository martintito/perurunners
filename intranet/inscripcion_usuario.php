<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Inscripción Sede Central</title>
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
button {
 border: none;
 background: #3a7999;
 color: #f2f2f2;
 padding: 10px;
 font-size: 18px;
 border-radius: 5px;
 position: relative;
 box-sizing: border-box;
 transition: all 500ms ease;
}

button:before {
 content:'';
 position: absolute;
 top: 0px;
 left: 0px;
 width: 100%;
 height: 0px;
 background: rgba(255,255,255,0.3);
 border-radius: 5px;
 transition: all 2s ease;
}
button:hover:before {
 height: 42px;
}
button:hover {
 background: rgba(0,0,0,0);
 color: #3a7999;
 box-shadow: inset 0 0 0 3px #3a7999;
}
</style>

<script type="text/javascript" src="public/js/funciones.js"></script>
        
<!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="public/js/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/jquery.numeric.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
	<!--alert-->
	<link rel="stylesheet" type="text/css" href="public/js/swat/sweet/lib/sweet-alert.css">
	<script type="text/javascript" src="public/js/swat/sweet/lib/sweet-alert.min.js"></script>
	  <!-- Javascript -->
        <script type="text/javascript" src="public/js/bootbox.min.js"></script>

	<script type="text/javascript" src="public/scripts/Socio_reg.js"></script>
	<script type="text/javascript" src="public/scripts/Combos.js"></script>
    <script type="text/javascript" src="public/scripts/jquery.toaster.js"></script>

</head>

<body>
<form id="form_socio" name="form_socio" action="" accept-charset="utf-8" method="post" enctype="multipart/form-data">
<div id="contenedorinscripcion">
  <div id="tituloinscripcion">
  <img src="../img/logosani_inscrip.png" width="195" height="166" style="float:left;"/>
  <h1>Estás a un paso de ser parte de<br />PERU RUNNERS</h1>
  <h2>SEDE CENTRAL - USUARIOS</h2>
  </div>
  <div id="clear"></div>
  <div id="subtituloinscripcion">
  <h1>1. DATOS PERSONALES Y DE CONTACTO</h1>
  </div>
  
  <div class="textogris18" id="forminscripcion">
   <div>
	<span style=" float:left;">
	<font style="color:red">Debes tener 18 años para crear una cuenta de Usuario y llenar todos los datos solicitados obligatorios: (*)</font>
	</span><br>
  </div>
  
Apellido Paterno (*):&emsp;<input id="paterno" name="paterno" type="text" class="casillasinscripcion" style="width: 370px;" required="">
    <span style=" float:right;">
  Subir su fotografía actual (*):<br>
	<input type="file" name="fotografia" id="fotografia" autofocus="" required="">
	</span><br>
  Apellido Materno (*):&emsp;<input id="materno" name="materno" type="text" class="casillasinscripcion" style="width: 370px;" required=""><br>
  Nombres (*):&emsp;<input id="nombre" name="nombre" type="text" class="casillasinscripcion" style="width: 370px;" required="">
      <span style=" float:right;">
  Ciudadanía (*):&emsp;<select name="pais" id="pais" size="1" class="casillasinscripcion" style="width:215px;height: 30px;">
	
			</select></span><br>
  Dirección:&emsp;<textarea id="direccion" name="direccion" type="text" class="casillasinscripcion" style="width: 370px;" rows="2"></textarea>
    <span style=" float:right;">
  Distrito (*):&emsp;<select name="distrito" id="distrito" size="1" class="casillasinscripcion" style="width:215px;height: 30px;">
	
			</select></span><br>
  Tipo de Documento (*):&emsp;<select name="tipo_doc" id="tipo_doc" size="1" class="casillasinscripcion" style="width: 140px;height: 30px;">
			<option value="DNI" selected="">DNI</option>
			<option value="CE">CE</option>
  </select>
    <span style=" float:right;">
  Nº de Documento (*):&emsp;<input name="num_doc" id="num_doc" type="number" class="casillasinscripcion" style="width: 200px;" required="" max="999999999999" pattern=""/></span><br />
  Fecha de Nacimiento (aaaa-mm-dd) (*):&emsp;<input type="date" class="casillasinscripcion" style="width: 140px;" id="fecha_nac" name="fecha_nac" required=""/>
 <span style=" float:right;">
 Estado Civil (*):&emsp;<select name="estado_civil" id="estado_civil" size="1" class="casillasinscripcion" style="width: 200px;height: 30px;">
			<option value="Soltero" selected="">Soltero</option>
			<option value="Casado">Casado</option>
			<option value="Viudo">Viudo</option>
			<option value="Divorciado">Divorciado</option>
  </select></span><br>
  
  Correo Electrónico (*):&emsp;<input id="email" name="email" type="text" class="casillasinscripcion" style="width: 445px;" required="" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"/><br>
  Repita su Correo Electrónico (*):&emsp;<input id="email2" name="email2" type="text" class="casillasinscripcion" style="width: 445px;" required="" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"/><br>
  Teléfono Fijo:&emsp;<input name="tele_fijo" id="tele_fijo" type="number"class="casillasinscripcion" style="width: 130px;"/>
  <span style=" float:right;">
  Teléfono Móvil (*):&emsp;<input name="celular" id="celular" type="number" class="casillasinscripcion" style="width: 130px;" required=""/>
  </span><br />
  
  Género (*):&emsp;<input name="sexo" type="radio" id="sexo" value="M" checked=""/>Masculino<input name="sexo" type="radio" id="sexo" value="F"  />Femenino&emsp;&emsp;&emsp;&emsp;
  Talla de Polo (*):&emsp;<select name="talla_pol" id="talla_pol" size="1" class="casillasinscripcion" style="width: 100px;height: 30px;">
		<option value="S">S</option>
		<option value="M">M</option>
		<option value="L">L</option>
		<option value="XL">XL</option>
  </select>&emsp;&emsp;&emsp;&emsp;
  Talla de Zapatilla (*):&emsp;<select name="talla_zap" id="talla_zap" size="1" class="casillasinscripcion" style="width: 110x;height: 30px;">
		<option value="3.5">3.5</option>
		<option value="4">4</option>
		<option value="4.5">4.5</option>
		<option value="5">5</option>
		<option value="5.5">5.5</option>
		<option value="6">6</option>
		<option value="6.5">6.5</option>
		<option value="7">7</option>
		<option value="7.5">7.5</option>
		<option value="8">8</option>
		<option value="8.5">8.5</option>
		<option value="9">9</option>
		<option value="9.5">9.5</option>
		<option value="10">10</option>
		<option value="10.5">10.5</option>
		<option value="11">11</option>
  </select><br>
  
  </div>
  <div id="subtituloinscripcion">
  <h1>2. RESPONDE A ESTAS PREGUNTAS</h1>
  </div>
    <div class="textogris18" id="forminscripcion">

 ¿Tienes alguna discapacidad? (*):&emsp;<input name="discapacidad" id="radio1" type="radio" value="N" checked=""/>NO<input name="discapacidad" id="radio2" type="radio" value="S" />SI
&emsp;&emsp;
 <select name="tipo_discapacidad" id="tipo_discapacidad" size="1" class="casillasinscripcion" style="width: 300px;height: 30px;">
		<option value="Tengo discapacidad visual">Tengo discapacidad visual</option>
		<option value="Silla de ruedas">Silla de ruedas</option>
		<option value="Me falta un miembro">Me falta un miembro</option>
		<option value="Otros">Otros</option>
  </select>
  <input name="discapa" type="hidden" id="discapa" class="casillasinscripcion" style="width: 445px;"/>
  <br>
¿Cuántas veces corres por semana? (*):&emsp;<input name="corres" id="corres" type="radio" value="0-2" checked=""/>0 a 2 veces
&emsp;<input name="corres" id="corres" type="radio" value="3-4" />3 a 4 veces&emsp;<input name="corres" id="corres" type="radio" value="5-7" />5 a más veces
<br>

  ¿Eres miembro de un club de carreras? (*):&emsp;
 <input name="club" id="club1" type="radio" value="N" checked=""/>No<input name="club" id="club2" type="radio" value="S" />Si
  &emsp;<input name="nombre_club" type="text" id="nombre_club" placeholder="Ingrese nombre del club" class="casillasinscripcion" style="width: 445px;"/>
  <br>
<font style="font-weight:bold;color:blue;">Contacto de emergencia:</font><br>
Nombres (*):&emsp;<span><input name="nombre_contacto" id="nombre_contacto" type="text" class="casillasinscripcion" style="width: 300px;" required="" /></span><br />
Teléfono (*):&emsp;<span><input name="telefono_contacto" id="telefono_contacto" type="number" class="casillasinscripcion" style="width: 200px;" required="" /></span><br />
  <input name="estado" id="estado" type="hidden" value="U"/>
 </div>

  <div id="membresiainscripcion">
    <!--
  <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Normal</span><br />
    S/. 0.00
    </div>
    <br />
    <input type="radio" value="1" name="membresia" id="membresia" checked=""/>Normal
    </div>&emsp;&emsp;
	
	
  	<div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Trimestral</span><br />
    S/. 240.00
    </div>
    <br />
    <input type="radio" value="2" name="membresia" id="membresia"/>Trimestral
    </div>&emsp;&emsp;
    
    <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Semestral</span><br />
    S/. 410.00
    </div>
    <br />
    <input type="radio" value="3" name="membresia" id="membresia"/>Semestral
    </div>&emsp;&emsp;
    
    <div id="membresia">
    <div id="membresiaprecio">
    <span style="font-size: 30px;">Anual - VIP</span><br />
    S/. 760.00
    </div>
    <br />
    <input type="radio" value="4" name="membresia" id="membresia"/>Anual - VIP
    </div>
	 
	-->
    <br><br>
<!--
  <input type="submit" class="" name="submit" id="submit" value="GRABAR INSCRIPCIÓN"> 
  -->
   <button type="submit" class="" name="submit" id="submit">GRABAR INSCRIPCIÓN</button>
    <div id="clear50"></div>
<span class="fininscripcion">Para cualquier consulta, por favor comunicarse al correo <a href="info@perurunners.com">info@perurunners.com</a></span> 
 </div>

</div>
</form>

</body>
</html>
