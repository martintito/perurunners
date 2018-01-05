<?php
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
include ("functions.php");
$id_autor= $_SESSION['user_id_posv'];
$fecha=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"insert into paginas (autor, fecha, estado) values ('$id_autor','$fecha','0')");
$sql_last=mysqli_query($con,"select LAST_INSERT_ID(id_pagina) as last from paginas order by id_pagina desc limit 0,1");
$rw=mysqli_fetch_array($sql_last);
$id_pagina=$rw['last'];
if (isset($id_pagina)){
	$id_pagina=intval($id_pagina);
	$query_pagina=mysqli_query($con,"select * from paginas where id_pagina='$id_pagina'");
	$rw=mysqli_fetch_array($query_pagina);
	$titulo=$rw['titulo'];
	$slug=$rw['slug'];
	$descripcion=$rw['descripcion'];
	$estado=$rw['estado'];
	$url=url();
	
		
}else {
	exit;
}
?>
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
		  <li><a href="subscriberslist.php">Suscriptores</a></li>
		  <li class="active">Agregar</li>
		</ol>
		 <div class="col-md-6">
		 
			<form class="form-horizontal" id="guardar_suscriptores">
			  <div class="form-group">
				<label for="nombres" class="col-sm-4 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombres" name="nombres" >
				  <input type="hidden" value="<?php echo $id;?>" id="id" name="id">		
				</div>
			  </div>

			  <div class="form-group">
				<label for="apellidos" class="col-sm-4 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidos" name="apellidos" >
				 </div>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-sm-4 control-label">Correo electrónico</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="email" name="email"  required>
				 </div>
			  </div>
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success">Guardar datos</button>
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
		$("#guardar_suscriptores").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/guardar_suscriptores.php",
				  type: "POST",
				  data: $("#guardar_suscriptores").serialize(),
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