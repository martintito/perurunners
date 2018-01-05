<!DOCTYPE html>
<html lang="en">
<head>
<?php include("view/head.php");?>
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
	<?php include("view/leftpanel.php");?>
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    
    <div class="headerbar">
		<?php include("view/headerbar.php"); ?>
    </div><!-- headerbar -->
    
    <div class="pageheader">
      <?php include("view/pageheader.php");?>
    </div>
    
    <div class="contentpanel">
      <?php if ($permisos_ver==1){?>
		<section class="content-header">
				<div class="row">
					<div class="col-md-4 col-xs-12">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Buscar por nombre del cliente" id="q" onkeyup="load(1);">
							<span class="btn btn-default input-group-addon" onclick="load(1);"><i class="glyphicon glyphicon-search"></i></span>
						</div>	
					  </div>
			  
					<div class="col-xs-12">
						<div id="loader" class="text-center"></div>
						
					</div>
					
					
             </div>
				
			 
        </section>
		 <!-- Main content -->
        <section class="content">
			<div id="resultados_ajax"></div>
			<div class="outer_div"></div><!-- Datos ajax Final -->         
        </section><!-- /.content -->
     
      <?php 
	  } 
	  else
	  {
		include("view/access_denied.php");
	  }
	  ?>
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->
  

  
  
</section>


<?php
include ("view/js.php")
?>
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