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
							<input type="text" class="form-control" placeholder="Buscar por nombre" id="q" onkeyup="load(1);">
							<span class="btn btn-default input-group-addon" onclick="load(1);"><i class="glyphicon glyphicon-search"></i></span>
						</div>	
					  </div>
			  
					  
					  
			  
					
					
					<div class="col-md-8 col-xs-12 ">
						<div class="btn-group btn-group-sm pull-right">
							<?php if ($permisos_editar==1){?>
							<a href="manufactureradd.php"  class="btn btn-default"><i class='fa fa-plus'></i> Agregar Fabricante</a>
							<?php }?>
							
							 

						</div>
                    </div>
					<div class="col-xs-12">
						<div id="loader" class="text-center"></div>
						
					</div>
					<input type='hidden' id='per_page' value='15'>
					
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
			url:'./ajax/fabricantes_ajax.php',
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
	function eliminar_fabricante(id){
		var q=$("#q").val();
		page=1;
		var parametros = {"action":"ajax","page":page,"q":q,"id":id};
		if(confirm('Esta acción  eliminará de forma permanente el fabricante \n\n Desea continuar?')){
		$.ajax({
			url:'./ajax/fabricantes_ajax.php',
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