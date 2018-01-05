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
      <?php if ($permisos_editar==1){?>
		<section class="content-header">
			<div class="row">
				<ol class="breadcrumb">
				  <li><a href="productslist.php">Inicio</a></li>
				  <li><a href="customerslist.php">Clientes</a></li>
				  <li class="active">Agregar</li>
				</ol>
				 <div class="col-md-6">
			
					<form class="form-horizontal" id="agregar_cliente">
						 
					  <div class="form-group">
						<label for="nombres" class="col-sm-4 control-label">Nombres</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="nombres" name="nombres" required>
						 </div>
					  </div>

					  <div class="form-group">
						<label for="telefono" class="col-sm-4 control-label">Teléfono</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="telefono" name="telefono" required>
						 </div>
					  </div>
					  <div class="form-group">
						<label for="email" class="col-sm-4 control-label">Email</label>
						<div class="col-sm-8">
						  <input type="email" class="form-control" id="email" name="email"  required>
						 </div>
					  </div>
					  
					 
					  
					  
					 
					 
					 
					  <div class="form-group">
					  <div id='loader'></div>
					  <div class='outer_div'></div>
						<div class="col-sm-offset-4 col-sm-8">
						  <button type="submit" class="btn btn-success">Actualizar datos</button>
						</div>
					  </div>
					</form>
				</div>	
			  		  
			  
					
					
					
					
					
             </div>
				
			 
        </section>
		 <!-- Main content -->

     
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
		$("#agregar_cliente").submit(function(e) {
			  $.ajax({
				  url: "ajax/agregar_cliente.php",
				  type: "POST",
				  data: $("#agregar_cliente").serialize(),
				   beforeSend: function(objeto){
					$("#loader").html("Cargando...");
				  },
				  success:function(data){
						$(".outer_div").html(data).fadeIn('slow');
						$("#loader").html("");
					}
			});
			 e.preventDefault();
		});
	</script>
	