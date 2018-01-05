<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Listado de cotizaciones";
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
$active_cotizaciones="active";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/ico/favicon.ico">
    <title><?php echo $title;?></title>
    <!-- Bootstrap core CSS -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
  </head>
  <body>
	<?php include("top_menu.php");?>
	
    <div class="container">
		
      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">
		 <ol class="breadcrumb">
		  <li><a href="productslist.php">Inicio</a></li>
		  <li class="active">Cotizaciones</li>
		</ol>
			<div class="row">
			  <div class="col-xs-4">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Buscar por nombre del cliente" id="q" onkeyup="load(1);">
					<span class="btn btn-default input-group-addon" onclick="load(1);"><i class="glyphicon glyphicon-search"></i></span>
				</div>	
			  </div>
			  
			  
			  <div class="col-xs-4 text-right">
				  
			  </div>
			  
			</div>
		  
		  <br>
		  <div id="loader" class="text-center"> <span><img src="./img/ajax-loader.gif"></span></div>
		  <div class="outer_div"></div><!-- Datos ajax Final -->
	  </div>

    </div> <!-- /container -->
	<?php include("footer.php");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
  </body>
</html>
<script>
	$(document).ready(function(){
		load(1);
	});
	function load(page){
		var q=$("#q").val();
		
		var parametros = {"action":"ajax","page":page,"q":q};
		$.ajax({
			url:'./ajax/cotizaciones_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='../images/ajax-loader.gif'>");
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
	function eliminar(id){
		var q=$("#q").val();
		page=1;
		var parametros = {"action":"ajax","page":page,"q":q,"id":id};
		if(confirm('Esta acción  eliminará de forma permanente la cotización \n\n Desea continuar?')){
		$.ajax({
			url:'./ajax/cotizaciones_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='../images/ajax-loader.gif'>");
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
	}
</script>

<script>
	function descargar(id){
		 VentanaCentrada('./pdf/documentos/ver_cotizacion.php?id='+id,'Cotizacion','','1024','768','true');
	 	}
</script>
<script>
	function  actualiza_cotizacion(id_cotizacion,valor,id_campo,tipo){
		
		
		if (isNaN(valor)){
			alert('Esto no es un número válido');
			$("#"+id_campo).focus();
			return false;
		}
		var q=$("#q").val();
		page=1;
		var parametros = {"action":"ajax","page":page,"q":q,"id_cotizacion":id_cotizacion,"valor":valor,"tipo":tipo};
		$.ajax({
			url:'./ajax/cotizaciones_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='../images/ajax-loader.gif'>");
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
</script>