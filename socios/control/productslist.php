<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Listado de productos";
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
$active_productos="active";
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
	   <?php 
			if ($user_id_db==1){
	   ?>
		 <ol class="breadcrumb">
		  <li><a href="productslist.php">Inicio</a></li>
		  <li class="active">Productos</li>
		</ol>
			<div class="row">
			  <div class="col-xs-3">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Buscar por código" id="q" onkeyup="load(1);">
					<span class="btn btn-default input-group-addon" onclick="load(1);"><i class="glyphicon glyphicon-search"></i></span>	
				</div>	
			  </div>
			  <div class="col-xs-3">
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
			  <div class="col-xs-3">
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
			  
			  <div class="col-xs-3 text-right">
				  <a href='productsadd.php' class="btn btn-default" ><span class="glyphicon glyphicon-plus"></span> Agregar Productos</a>
			  </div>
			  
			</div>
		 
		  <br>
		  <div id="loader" class="text-center"> <span><img src="./img/ajax-loader.gif"></span></div>
		  <div class="outer_div"></div><!-- Datos ajax Final -->
			<?php 
				} 
				else
				{
					?>
					<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
						<h4>Acceso denegado!</h4> 
						<p>El acceso fue denegado porque no tiene privilegios suficientes para acceder a este módulo</p> 
						<p> <a href="quoteslist.php"  class="btn btn-danger">Ir a cotizaciones</a>  </p>
					</div>
					<?php
				}
				
			?>
	  </div>

    </div> <!-- /container -->
	<?php include("footer.php");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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