<?php
$active_servicio="";
include("config/conexion.php");
include("slug.php");//Slug URL amigables
$sql=mysqli_query($con,"select * from paginas where id_pagina=3 and estado=1");
$rw=mysqli_fetch_array($sql);
$titulo=$rw['titulo'];
$contenido=$rw['descripcion'];
$canonical_link="politica-de-privacidad";
$meta_description="$business_name política de privacidad.";
include ("header.php");
include ("logo.php");
?>
<div class="container contenedor_principal">
	<section id="title">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<h1><?php echo $titulo;?></h1>
					</div>
					
					
				</div>
			</div>
    </section>
	    <section id="contact-page" class="container">
        <div class="row">
            <div class="col-sm-12">
				<?php echo $contenido;?>
 
            </div><!--/.col-sm-12-->
            
			
        </div>
		
    </section><!--/#contact-page-->
	<hr>
</div>
<?php 
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

	