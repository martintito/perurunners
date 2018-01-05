<?php
session_start();
if(isset($_SESSION['idsocio'])){
$active_index="active";
include("config/conexion.php");
include("slug.php");//Slug URL amigables
$meta_description="$business_name Peru Runners - cada paso es contigo";
include ("header.php");
//include ("logo.php");
include("slider.php");
//include("sidebar.php");
?>
<div class="container contenedor_principal">
	<section id="title">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<h1>Información Personal</h1>
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
                    <input id="idsocio" type="hidden" maxlength="50" class="form-control" name="idsocio" placeholder="" autofocus="" value="<?php echo $_SESSION["idsocio"]; ?>"  />
  <br>
  <div class="col-sm-6">
 Sede: &emsp;<input id="paterno" name="paterno" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["nom_sede"]; ?>" >
 </div>                       
					   <div class="col-sm-6"> 	
							  Apellido Paterno:&emsp;<input id="paterno" name="paterno" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["paterno"]; ?>" >
</div>
</div>
<br>
<div class="row">
<div class="col-sm-6">

	Apellido Materno:&emsp;<input id="materno" name="materno" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["materno"]; ?>"><br>
  
   </div>
   <div class="col-sm-6">
Nombres:&emsp;<input id="nombre" name="nombre" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["nombres"]; ?>">
   </div>
   </div>
  <br>
<div class="row">
  <div class="col-sm-6">
  Ciudadanía:&emsp;<input id="nombre" name="nombre" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["nom_pais"]; ?>">
	</div>
	 <div class="col-sm-6">
  Distrito:&emsp;<input id="nombre" name="nombre" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["nom_distrito"]; ?>">
</div>
</div>
<br>

<div class="row">
 <div class="col-sm-6">
    Dirección:&emsp;<textarea id="direccion" name="direccion" type="text" class="form-control" style="width: 370px;" rows="2" readonly=""><?php echo $_SESSION["direccion"]; ?></textarea>
</div>
 <div class="col-sm-6">
    Fecha de Nacimiento (aaaa-mm-dd):&emsp;<input type="text" class="form-control" style="width: 140px;" id="fecha_nac" name="fecha_nac" readonly="" value="<?php echo $_SESSION["fecha_nac"]; ?>"/>
  </div>
</div>
<br>

<div class="row">
 <div class="col-sm-6">
   Nº de Documento:&emsp;<input name="num_doc" id="num_doc" type="text" class="form-control" style="width: 200px;" readonly="" value="<?php echo $_SESSION["numero"]; ?>"/>
 </div>
  <div class="col-sm-6">
	  Tipo de Documento:&emsp;<input id="nombre" name="nombre" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["documento"]; ?>">
 </div>
</div>
<br>

<div class="row">
 <div class="col-sm-6">
  Teléfono Fijo:&emsp;<input name="tele_fijo" id="tele_fijo" type="text"class="form-control" style="width: 200px;" readonly="" value="<?php echo $_SESSION["telef_fijo"]; ?>"/>
 </div>
 <div class="col-sm-6">
   Teléfono Móvil:&emsp;<input name="celular" id="celular" type="text" class="form-control" style="width: 200px;" readonly="" value="<?php echo $_SESSION["telef_celu"]; ?>"/>
 </div>
</div>

<br>
<div class="row">
 <div class="col-sm-6">
  Correo Electrónico:&emsp;<input id="email" name="email" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["email"]; ?>"/><br>
  </div>
  <div class="col-sm-6">
 Estado Civil:&emsp;<input id="materno" name="materno" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["est_civil"]; ?>">
 </div>
</div>

<br>
<div class="row">
 <div class="col-sm-6">
 Talla de Polo:&emsp;<input id="materno" name="materno" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["talla_polo"]; ?>">
 </div>

  <div class="col-sm-6">
  Talla de Zapatilla:&emsp;<input id="materno" name="materno" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["talla_zapa"]; ?>">
 </div>
</div>
<!--
<br>
<div class="row">
 <div class="col-sm-6">
  Género:&emsp;<input name="sexo" type="radio" id="sexo" value="M" class="form" checked=""/>
  &emsp;Masculino &emsp;&emsp;<input name="sexo" type="radio" id="sexo" value="F" class="form"/>&emsp;Femenino
 
 </div>
  <div class="col-sm-6">

 </div>
</div>    
-->
<br>
<div class="row">
 <div class="col-sm-6">
 Nombre del Contacto:&emsp;<input id="nombre_contacto" name="nombre_contacto" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["nom_contacto"]; ?>">
  </div>
  <div class="col-sm-6">
   Teléfono del Contacto:&emsp;<input name="telefono_contacto" id="telefono_contacto" type="text" class="form-control" style="width: 200px;" readonly="" value="<?php echo $_SESSION["telef_contacto"]; ?>"/>
 </div>
</div>   

<br>
<div class="row">
 <div class="col-sm-6">
Número de tarjeta:&emsp;<input name="numero_tarjeta" id="numero_tarjeta" type="text" class="form-control" style="width: 300px;" readonly="" value="<?php echo $_SESSION["num_tarjeta"]; ?>"/>
 </div>
  <div class="col-sm-6">
  Tipo de Tarjeta:&emsp;<input name="numero_tarjeta" id="numero_tarjeta" type="text" class="form-control" style="width: 300px;" readonly="" value="<?php echo $_SESSION["tipo_tarjeta"]; ?>"/>
 </div>
</div> 

<div class="row">
 <div class="col-sm-6">
 Banco:&emsp;<input name="banco" id="banco" type="text" class="form-control" style="width: 300px;" readonly="" value="<?php echo $_SESSION["nom_banco"]; ?>"/>
 </div>

</div> 
<br>
<div class="row">
	<div class="col-sm-6"> 	
Nombre de Usuario:&emsp;<input id="nombre_usuario" name="nombre_usuario" type="text" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["login"]; ?>" >
</div>
<div class="col-sm-6">

Contraseña Actual:&emsp;<input id="clave_usuario" name="clave_usuario" type="password" class="form-control" style="width: 370px;" readonly="" value="<?php echo $_SESSION["clave"]; ?>"><br>
  
   </div>
   <div class="col-sm-6">
   </div>
      <div class="col-sm-6">
 
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
               
                        </div>                   
					</div>
                </form>
            </div><!--/.col-sm-8-->
			
	  </div>
		
    </section><!--/#contact-page-->
</div>

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