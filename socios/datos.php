<?php
session_start();
if(isset($_SESSION['idsocio'])){
$active_datos="active";
include("config/conexion.php");
include("slug.php");//Slug URL amigables
$sql=mysqli_query($con,"select * from paginas where id_pagina=1 and estado=1");
$rw=mysqli_fetch_array($sql);
$titulo=$rw['titulo'];
$contenido=$rw['descripcion'];
$canonical_link="datos";
$meta_description="$business_name es el principal organizador de eventos deportivos";
include ("header.php");
//include ("logo.php");
include("slider.php");
?>
<div class="container contenedor_principal">
	<section id="title">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<h1>Actualizar</h1>
					</div>
				</div>
			</div>
    </section>
	    <section id="contact-page" class="container">
        <div class="row">
            <div class="col-sm-8">
                <div id="resultados_ajax"></div>
                <form  class="contact-form"  method="post" id="form_socio" name="form_socio" enctype="multipart/form-data">
            <div class="row">
<input id="idsocio" type="hidden" name="idsocio" value="<?php echo $_SESSION["idsocio"]; ?>"  />
<input id="num_doc" type="hidden" name="num_doc" value="<?php echo $_SESSION["numero"]; ?>"  />
<input id="id_sede" type="hidden" name="id_sede" value="<?php echo $_SESSION["id_sede"]; ?>"  />
<input id="id_distrito" type="hidden" name="id_distrito" value="<?php echo $_SESSION["id_dist"]; ?>"  />
<input id="id_banco" type="hidden" name="id_banco" value="<?php echo $_SESSION["id_banco"]; ?>"  />
				</div>
<br>
<div class="row">
 <div class="col-sm-6">
    Dirección:&emsp;<textarea id="direccion" name="direccion" type="text" class="form-control" style="width: 370px;" rows="2"><?php echo $_SESSION["direccion"]; ?></textarea>
</div>
	 <div class="col-sm-6">
  Distrito:&emsp;<select name="distrito" id="distrito" size="1" class="form-control" style="width:250px;height:35px;">
	 </select>
</div>
</div>
<div class="row">
 <div class="col-sm-6">
  Teléfono Fijo:&emsp;<input name="tele_fijo" id="tele_fijo" type="number"class="form-control" style="width: 200px;" value="<?php echo $_SESSION["telef_fijo"]; ?>"/>
 </div>
 <div class="col-sm-6">
   Teléfono Móvil:&emsp;<input name="celular" id="celular" type="number" class="form-control" style="width: 200px;" value="<?php echo $_SESSION["telef_celu"]; ?>"/>
 </div>
</div>

<br>
<div class="row">
 <div class="col-sm-6">
  Correo Electrónico:&emsp;<input id="email" name="email" type="text" class="form-control" style="width: 370px;" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" value="<?php echo $_SESSION["email"]; ?>"/>
 <br> Repite Correo Electrónico:&emsp;<input id="email_repite" name="email_repite" type="text" class="form-control" style="width: 370px;" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" value="<?php echo $_SESSION["email"]; ?>"/>
  <br>
  </div>
  <div class="col-sm-6">
 Estado Civil:&emsp;<select name="estado_civil" id="estado_civil" size="1" class="form-control" style="width: 200px;height: 35px;">
	 <?php
 $array = array('Soltero','Casado','Viudo','Divorciado');
 foreach($array as $item){
 ?>
		<option value="<?php echo $item;?>" <?php if($_SESSION['est_civil']==$item) echo 'selected'?>><?php echo $item;?></option>
<?php
 }
?>	
  </select>
 </div>
</div>
<br>
<div class="row">
  <div class="col-sm-6">
<h3>Datos de la Tarjeta</h3>
 </div>
 </div>
 <div class="row">
 <div class="col-sm-6">
<br>Número de tarjeta:&emsp;<span><input name="numero_tarjeta" id="numero_tarjeta" type="text" class="form-control" style="width: 300px;" required="" value="<?php echo $_SESSION["num_tarjeta"]; ?>"/></span><br />
 </div>
  <div class="col-sm-6">
  <br>Tipo de Tarjeta:&emsp;<select name="tipo_tarjeta" id="tipo_tarjeta" size="1" class="form-control" style="width: 140px;height:35px;">
		<option value="credito" <?php if($_SESSION['tipo_tarjeta']=='credito') echo 'selected'?>>Crédito</option>
		<option value="debito"<?php if($_SESSION['tipo_tarjeta']=='debito') echo 'selected'?>>Débito</option>
  </select>
 </div>
</div> 

<div class="row">
 <div class="col-sm-6">
 Banco:&emsp;<select name="banco" id="banco" size="1" class="form-control" style="width:215px;height:35px;">
	
			</select>
 </div>
  <div class="col-sm-6">
 Seleccione una Sede: &emsp; 
  <select name="sede" id="sede" size="1" class="form-control" style="width: 200px;height:35px;">
	
  </select>
 </div>
</div> 
<br>
<div class="row">
  <div class="col-sm-6">
<h3>Datos de Inicio de Sesión</h3>
 </div>
 </div>
<div class="row">
	<div class="col-sm-6"> 	
Nombre de Usuario:&emsp;<input id="nombre_usuario" name="nombre_usuario" type="text" class="form-control" style="width: 370px;" value="<?php echo $_SESSION["login"]; ?>" >
</div>
<div class="col-sm-6">
Contraseña Actual:&emsp;<input id="clave_usuario" name="clave_usuario" type="password" class="form-control" style="width: 370px;" required="" value="<?php echo $_SESSION["clave"]; ?>"><br>
</div>
<div class="col-sm-6"> 	
Nuevo Nombre de Usuario:&emsp;<input id="nuevo_usuario" name="nuevo_usuario" type="text" class="form-control" style="width: 370px;" value="<?php echo $_SESSION["login"]; ?>" >
</div>
   <div class="col-sm-6">
Contraseña Nueva:&emsp;<input id="clave_nueva" name="clave_nueva" type="password" class="form-control" style="width: 370px;" value="<?php echo $_SESSION["clave"]; ?>" >
   </div>
<div class="col-sm-6"> 	
Repite Nuevo Nombre de Usuario:&emsp;<input id="repite_usuario" name="repite_usuario" type="text" class="form-control" style="width: 370px;" value="<?php echo $_SESSION["login"]; ?>" >
</div>
      <div class="col-sm-6">
Repite Contraseña Nueva:&emsp;<input id="clave_repite" name="clave_repite" type="password" class="form-control" style="width: 370px;" value="<?php echo $_SESSION["clave"]; ?>">
  </div>
   </div>
<br>
<div class="row">
 <div class="col-sm-6">

 </div>
  <div class="col-sm-6">

 </div>
</div> 
<br><br>
<div class="form-group">
       <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg" style="margin-left:290px"><span class="glyphicon glyphicon-"></span>Actualizar Datos</button>
</div>                  
					</div>
<div class="col-sm-4">
<div class="row">
<br>
	<div class="col-sm-6">
				Subir su fotografía actual:<br>
				<input type="file" name="fotografia" id="fotografia" autofocus="">
				<input id="foto_socio" name="foto_socio" type="text" class="form-control" style="width: 370px;" value="<?php echo $_SESSION["foto_socio"]; ?>">
			</div>
</div>
<br><br>
<div class="row">
 <div class="col-sm-6">
 Talla de Polo:&emsp;<select name="talla_pol" id="talla_pol" size="1" class="form-control" style="width: 100px;height: 35px;">
 <?php
 $array = array('S','M','L','XL');
 foreach($array as $item){
 ?>
		<option value="<?php echo $item;?>" <?php if($_SESSION['talla_polo']==$item) echo 'selected'?>><?php echo $item;?></option>
<?php
 }
?>
  </select>
 </div>

  <div class="col-sm-6">

	Talla de Zapatilla:&emsp;<select name="talla_zap" id="talla_zap" class="form-control" style="width:100px;height:35px;">
	<?php
		for($i=3;$i<=11;$i+=0.5){
			
	?>
	<option value="<?php echo $i;?>" <?php if($_SESSION['talla_zapa']==$i) echo 'selected'?>><?php echo $i;?></option>
	<?php
		}
	?>
  </select>
  </div>
  </div>
  <br>
 
</div><!--/.col-sm-4-->	
   <div class="col-sm-4">
     <div class="row">  
   <h3>Datos del Contacto</h3>
</div> 
</div>

 <div class="col-sm-4">
  <div class="row">  
 <div class="col-sm-6">
 <br>Nombre del Contacto:&emsp;<input id="nombre_contacto" name="nombre_contacto" type="text" class="form-control" style="width: 370px;" required="" value="<?php echo $_SESSION["nom_contacto"]; ?>">
  </div>
</div> 
</div>

   <div class="col-sm-4">
  <div class="row">
  <div class="col-sm-6">
   <br>Teléfono del Contacto:&emsp;<input name="telefono_contacto" id="telefono_contacto" type="number" class="form-control" style="width: 200px;" value="<?php echo $_SESSION["telef_contacto"]; ?>"/>
 </div>
</div> 
</div>
                </form>
		</div>
    </section><!--/#contact-page-->
		
</div>
	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/scripts/Combos.js"></script>
	<script type="text/javascript" src="public/scripts/Socio_act.js"></script>
<?php

//include("main.php"); 
//include("marcas.php"); 
//include("principales.php");
include("modal_load.php");
include("footer.php");

  } else{
	  header("Location:index.html");
  }
  
?>

	