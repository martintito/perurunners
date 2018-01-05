<?php
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if (isset($_GET['id'])){
	$id_categoria=intval($_GET['id']);
	$query_cat=mysqli_query($con,"select * from categorias where id_categoria='$id_categoria'");
	$rw_cat=mysqli_fetch_array($query_cat);
	$nombre_categoria=$rw_cat['nombre_categoria'];
	$parent=$rw_cat['parent'];

	
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
				  <li><a href="categorylist.php">Categorías</a></li>
				  <li class="active">Editar</li>
				</ol>
				<div class="col-md-6">
				 
					<form class="form-horizontal" id="editar_categorias">
						 
					  <div class="form-group">
						<label for="codigo" class="col-sm-4 control-label">Nombre categoría</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" value="<?php echo $nombre_categoria;?>" required>
						  <input type="hidden" value="<?php echo $id_categoria;?>" id="id_categoria" name="id_categoria">		
						</div>
					  </div>
					  <div class="form-group">
						<label for="modelo" class="col-sm-4 control-label">Categoría padre</label>
						<div class="col-sm-8">
						  <select class="form-control" id="parent" name="parent">
							<option value='0'>Sin categoría padre</option>
							<?php
							if ($parent!=0){
								$sql_parent=mysqli_query($con,"select * from categorias where parent=0 order by nombre_categoria");
								while ($rw_parent=mysqli_fetch_array($sql_parent)){
									$id_cat=$rw_parent['id_categoria'];
									$cat=$rw_parent['nombre_categoria'];
									if ($id_cat==$parent){$selected="selected";}
									else {$selected="";}
									?>
									<option value="<?php echo $id_cat;?>" <?php echo $selected?>><?php echo $cat;?></option>
									<?php
								}
							}
							?>
						  </select>
						</div>
					  </div>
					  <div class="form-group">
					  <div id='loader'></div>
					  <div class='outer_div'></div>
						<div class="col-sm-offset-2 col-sm-10">
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
		$("#editar_categorias").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_categoria.php",
				  type: "POST",
				  data: $("#editar_categorias").serialize(),
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