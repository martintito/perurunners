<?php
session_start();
if(isset($_SESSION['idsocio'])){
$active_contacto="active";
include("config/conexion.php");
include("slug.php");//Slug URL amigables
$canonical_link="contactenos";
$meta_description="$business_name formulario de contacto.";
include ("header.php");
include ("logo.php");
?>
<div class="container contenedor_principal">
	<section id="title">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<h1>Contáctenos</h1>
					</div>
					
					
				</div>
			</div>
    </section>
	    <section id="contact-page" class="container">
        <div class="row">
            <div class="col-sm-8">
                <h4>Formulario de Contacto</h4>
                <div id="resultados_ajax"></div>
                <form  class="contact-form"  method="post" id="guardar_datos" role="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Nombre completo" name="nombres" id="nombres">
                            </div>
                            <div class="form-group">
                                <select class="form-control" required name="asunto" id="asunto">
									<option value="">Selecciona el asunto</option>
									<option value="Servicio General al Ciente">Servicio general al ciente</option>
									<option value="Soporte de productos">Soporte de productos</option>
									<option value="Sugerencias">Sugerencias</option>
								</select>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" required="required" placeholder="Correo electrónico" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-envelope"></span> Enviar mensaje</button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="mensaje" id="mensaje" required="required" class="form-control" rows="8" placeholder="Mensaje"></textarea>
                        </div>
                    </div>
                </form>
            </div><!--/.col-sm-8-->
            <div class="col-sm-4">
                <label>Nuestra Dirección</label>
				<p><i class="fa fa-map-marker "></i> <?php echo $business_address;?></p>
				<label>Teléfono</label>
				<p><i class="fa fa-phone"></i> <?php echo $business_phone;?></p>
				<label>Correo Electrónico</label>
				<p><i class="fa fa-envelope"></i> <?php echo $business_email;?></p>
				
            </div><!--/.col-sm-4-->
			<iframe src="mapa_google.php" width="100%" height="415" frameborder="0" style="border:0" allowfullscreen></iframe>
			
	  </div>
		
    </section><!--/#contact-page-->
</div>
<?php 
include("marcas.php"); 
include("principales.php");
include("footer.php");
?>

    <!-- Le javascript -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/init.js"></script>
</body>
</html>

	<script>
		$("#guardar_datos" ).submit(function() {
		var mensaje=$("#mensaje").val();//mensaje
		var nombres=$("#nombres").val();//nombres
		var asunto=$("#asunto").val();//asunto
		var email=$("#email").val();//email
		
		/*Inicia validacion*/
		if (mensaje=="")
		{
		alert("Ingresa el mensaje");
		$("#mensaje").focus();
		return false;
		}
		if (nombres=="")
		{
		alert("Ingresa tu nombre");
		$("#nombres").focus();
		return false;
		}
		if (email=="")
		{
		alert("Ingresa tu email");
		$("#email").focus();
		return false;
		}
		  /*Finaliza validacion*/
		  var parametros = {"mensaje" : mensaje,"nombres" : nombres, "email": email,"asunto":asunto};
		  $.ajax({
				type: "POST",
				url: "sendemail.php",
				data: parametros,
				 beforeSend: function(objeto){
					 $('#resultados_ajax').html('<div><img src="images/ajax-loader.gif"/></div>');
					
				  },
				success: function(datos){
				$("#resultados_ajax").html(datos);
				
			  }
		});
			return false;
		})
</script>
<?php
 /* } else if(isset($_SESSION['idsocio'])) {
    header("Location:socio.php"); */
  } else{
	  header("Location:index.html");
  }
?>