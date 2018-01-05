<?php
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
include ("functions.php");

if (isset($_GET['id'])){
	$id_pagina=intval($_GET['id']);
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
<link rel="stylesheet" href="css/bootstrap-wysihtml5.css" />
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
		  <li><a href="pageslist.php">Páginas</a></li>
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-11">
		
			<form class="form-horizontal" id="editar_pagina">
				 
			 
			  
			  <div class="form-group">
				<label for="titulo" class="col-sm-3 control-label">Título de la página</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="titulo" value="<?php echo $titulo;?>" required name="titulo"><input type="hidden" class="form-control" id="id_pagina" value="<?php echo $id_pagina;?>" required name="id_pagina">
				</div>
			  </div>
			  <div class="form-group">
				<label for="titulo" class="col-sm-3 control-label">Enlace permanente</label>
				<div class="col-sm-5">
				  <input type="text" class="form-control" id="url" value="<?php echo str_replace("panel/","",$url);?>" required name="url" readonly>
				</div><div class="col-sm-4">
				  <input type="text" class="form-control" id="slug" value="page/<?php echo $slug;?>" required name="slug" readonly>
				</div>
			  </div>
			  <div class="form-group">
				<label for="descripcion" class="col-sm-3 control-label">Contenido</label>
				<div class="col-sm-9">
				  <textarea class="form-control " rows="9"  id="descripcion" required name="descripcion"><?php echo $descripcion;?></textarea>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-9">
				  <select class="form-control" id="estado" required name="estado">
					<option value="0" <?php if ($estado==0){echo "selected";}?>>No publicada</option>
					<option value="1" <?php if ($estado==1){echo "selected";}?>>Publicada</option>
				 </select>
				</div>
			  </div>
			  
			 
			  
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-offset-3 col-sm-9">
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
<script src="js/wysihtml5-0.3.0.min.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>
</body>
</html>
<script>
		$("#editar_pagina").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_pagina.php",
				  type: "POST",
				  data: $("#editar_pagina").serialize(),
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

<script>
jQuery(document).ready(function(){
    "use strict";
	// HTML5 WYSIWYG Editor
	jQuery('#descripcion').wysihtml5({color: true,html:true});
});	
</script>
