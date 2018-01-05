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
include("sidebar.php");
include("main.php"); 
include("marcas.php"); 
include("principales.php");
include("modal_load.php");
include("footer.php");
?>

    <!-- Le javascript -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/init.js"></script>
	<script>
	$(document).ready(function () {
		$('#memberModal').modal('show');
	})
	</script>
</body>
</html>
<?php

 /* } else if(isset($_SESSION['idsocio'])) {
    header("Location:socio.php"); */
  } else{
	  header("Location:index.html");
  }
  
?>