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
                     <div class="col-md-3 col-xs-6">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Buscar por código" id="q" onkeyup="load(1);">
							<span class="btn btn-default input-group-addon" onclick="load(1);"><i class="glyphicon glyphicon-search"></i></span>	
						</div>	
					  </div>
					  <div class="col-md-3 col-xs-6">
						<select class="form-control" id="id_fabricante" name="id_fabricante" onchange="load(1)">
							<option value="">Selecciona la fabricante</option>
							<?php
							$query_fab=mysqli_query($con,"select id_fabricante, nombre_fabricante from fabricantes order by nombre_fabricante");
							while ($rw_fab=mysqli_fetch_array($query_fab)){
								$nombre_fabricante=$rw_fab['nombre_fabricante'];
								$id_fabricante=$rw_fab['id_fabricante'];
								if ($id_fabricante==$id_fab){$selected="selected";}else {$selected="";}
								?>
								<option value="<?php echo $id_fabricante;?>" <?php echo $selected;?>><?php echo $nombre_fabricante;?></option>
								<?php
							}
							?>
						</select>
					  </div>
					  <div class="col-md-3 col-xs-12">
						  <select class="form-control" id="cat" name="cat" onchange="load(1);">
							<option value="">Selecciona la categoría</option>
							<?php
							$query_cat=mysqli_query($con,"select * from categorias where parent=0 order by nombre_categoria");
							while ($rw_cat=mysqli_fetch_array($query_cat)){
								$nombre_categoria=$rw_cat['nombre_categoria'];
								$id_categoria=$rw_cat['id_categoria'];
								if ($id_categoria==$id_cat){$selected="selected";}else {$selected="";}
								?>
								
								<?php
								$sql2_cat=mysqli_query($con,"select * from categorias where parent='$id_categoria' order by nombre_categoria");
								$nums2=mysqli_num_rows($sql2_cat);
								if ($nums2>0){
									echo "<optgroup label = '$nombre_categoria'>";	
									while ($rw2_cat=mysqli_fetch_array($sql2_cat)){
										$nombre2_categoria=$rw2_cat['nombre_categoria'];
										$id2_categoria=$rw2_cat['id_categoria'];
										if ($id2_categoria==$id_cat){$selected="selected";}else {$selected="";}
										?>
										<option value="<?php echo $id2_categoria;?>" <?php echo $selected;?>><?php echo "&nbsp;&nbsp;$nombre_categoria > ".$nombre2_categoria;?></option>
										<?php
									}
									echo "</optgroup>";
								} else {
									?>
									<option value="<?php echo $id_categoria;?>" <?php echo $selected;?>><?php echo $nombre_categoria;?></option>
									<?php
								}
							}
							?>
						</select>
					  </div>
			  
					
					
					<div class="col-md-3 col-xs-12">
						<div class="btn-group btn-group-sm pull-right">
							<?php if ($permisos_editar==1){?>
							<a href="productsadd.php"  class="btn btn-default"><i class='fa fa-plus'></i> Agregar Productos</a>
							<?php }?>
							
							 

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

</body>
</html>
<script>
	$(document).ready(function(){
		load(1);
	});
	function load(page){
		var q=$("#q").val();
		var cat=$("#cat").val();
		var id_fab=$("#id_fabricante").val();
		var parametros = {"action":"ajax","page":page,"q":q,"cat":cat,"id_fab":id_fab};
		$.ajax({
			url:'./ajax/productos_ajax.php',
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
	function eliminar_producto(id){
		var q=$("#q").val();
		var cat=$("#cat").val();
		var id_fab=$("#id_fabricante").val();
		page=1;
		var parametros = {"action":"ajax","page":page,"q":q,"cat":cat,"id_fab":id_fab,"id":id};
		if(confirm('Esta acción  eliminará de forma permanente el producto \n\n Desea continuar?')){
		$.ajax({
			url:'./ajax/productos_ajax.php',
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
function cambiar_estado(id_producto,estado){
	var q=$("#q").val();
	var cat=$("#cat").val();
	var id_fab=$("#id_fabricante").val();
	page=1;
	var parametros = {"action":"ajax","page":page,"q":q,"cat":cat,"id_fab":id_fab,"id_producto":id_producto,"estado":estado};
	$.ajax({
		url:'./ajax/productos_ajax.php',
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
<script>
function show_price(id_producto){
	
	if ($('#show_price_'+id_producto).is(':checked')) {
		var show_price=1;
	} else {
		var show_price=0;
	}
	var q=$("#q").val();
	var cat=$("#cat").val();
	var id_fab=$("#id_fabricante").val();
	page=1;
	var parametros = {"action":"ajax","page":page,"q":q,"cat":cat,"id_fab":id_fab,"id_producto":id_producto,"show_price":show_price};
	$.ajax({
		url:'./ajax/productos_ajax.php',
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