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
						<h1>Quiero ser Socio Activo</h1>
						<p>Sólo tienes que actualizar los siguientes datos obligatorios;</p>
					</div>
				</div>
			</div>
    </section>
	    <section id="contact-page" class="container">
		 <form  class="contact-form"  method="post" id="form_socio" name="form_socio" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-8">
                <div id="resultados_ajax"></div>
               
            <div class="row">
				<input id="idsocio" type="hidden" name="idsocio" value="<?php echo $_SESSION["idsocio"]; ?>"  />
				<input id="num_doc" type="hidden" name="num_doc" value="<?php echo $_SESSION["numero"]; ?>"  />
				<input id="id_sede" type="hidden" name="id_sede" value="<?php echo $_SESSION["id_sede"]; ?>"  />
				<input id="id_distrito" type="hidden" name="id_distrito" value="<?php echo $_SESSION["id_dist"]; ?>"  />
				<input id="id_banco" type="hidden" name="id_banco" value="<?php echo $_SESSION["id_banco"]; ?>"  />
				<input id="id_memb" type="hidden" name="id_memb" value="<?php echo $_SESSION["id_memb"]; ?>"  />
			</div>

<br>
<div class="row">
  <div class="col-sm-6">
<h3>Datos de la Tarjeta para el pago de Membresía</h3>
 </div>
 </div>
 <div class="row">
 <div class="col-sm-6">
<br>Número de tarjeta (*):&emsp;<span><input name="numero_tarjeta" id="numero_tarjeta" type="text" class="form-control" style="width: 300px;" required="" value="<?php echo $_SESSION["num_tarjeta"]; ?>"/></span><br />
 </div>
  <div class="col-sm-6">
  <br>Tipo de Tarjeta (*):&emsp;<select name="tipo_tarjeta" id="tipo_tarjeta" size="1" class="form-control" style="width: 140px;height:35px;">
		<option value="credito" <?php if($_SESSION['tipo_tarjeta']=='credito') echo 'selected'?>>Crédito</option>
		<option value="debito"<?php if($_SESSION['tipo_tarjeta']=='debito') echo 'selected'?>>Débito</option>
  </select>
 </div>
</div> 

<div class="row">
 <div class="col-sm-4">
 Banco (*):&emsp;<select name="banco" id="banco" size="1" class="form-control" style="width:215px;height:35px;">
	
			</select>
 </div>
  <div class="col-sm-4">
 Seleccione una Sede (*): &emsp; 
  <select name="sede" id="sede" size="1" class="form-control" style="width: 200px;height:35px;">
	
  </select>
 </div>
 
   <div class="col-sm-4">
 Seleccione una Membresía (*): &emsp; 
  <select name="membresias" id="membresias" size="1" class="form-control" style="width: 200px;height:35px;"></select>
 </div>

</div> 
</div>
</div>

<br><br>
<div class="">
		<font style="color:blue">Descarga los Terminos y Condiciones del Club Peru Runners </font>
		<a href="../files/Contrato de Membresia para Club Peru Runners.pdf" target="_blank">Aquí</a><br>
		    <input type="checkbox" value="" name="acepta_termino" id="acepta_termino"/>
He leído y acepto los términos y condiciones del contrato de membresía para pertenecer al Club de Peru Runners.<br>
		<font style="color:blue">Descarga deslinde de responsabilidades </font>
		<a href="../files/Deslinde de responsabilidades.pdf" target="_blank">Aquí</a><br>
		    <input type="checkbox" value="" name="acepta_deslinde" id="acepta_deslinde"/>
He leído y acepto la renuncia de responsabilidades y liberación en los eventos y actividades de Peru Runners.<br>
  </div>
  <br><br>
  <input name="estado" id="estado" type="hidden" value="A"/>
<div class="form-group">
       <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg" style="margin-left:290px"><span class="glyphicon glyphicon-"></span>Grabar Datos</button>
</div> 
<br>
<span class="">Para cualquier consulta, por favor comunicarse al correo <a href="#">info@perurunners.com</a></span> 
</form> 
    </section><!--/#contact-page-->
		
</div>
	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/scripts/Combos.js"></script>
	<script type="text/javascript" src="public/scripts/Usuario_act.js"></script>
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

	