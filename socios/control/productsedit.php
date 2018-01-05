<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
header("location: login.php");
exit;
}
$title="Editar Productos";
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if (isset($_GET['id'])){
	$id_producto=intval($_GET['id']);
	$query_product=mysqli_query($con,"select * from productos where  id_producto='$id_producto'");
	$rw_product=mysqli_fetch_array($query_product);
	$codigo=$rw_product['codigo_producto'];
	$modelo=$rw_product['modelo_producto'];
	$producto=$rw_product['nombre_producto'];
	$descripcion=$rw_product['descripcion_producto'];
	$id_cat=$rw_product['id_categoria'];
	$id_fab=$rw_product['id_fabricante'];
	$status_producto=$rw_product['status_producto'];
	$price=$rw_product['price'];
	$price_offer=$rw_product['price_offer'];
	$tumb=$rw_product['tumb'];
	$img=$rw_product['img'];
	
}else {
	exit;
}
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
	<link href="css/preview-image.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
	<!-- include summernote css/js-->
	<link href="summernote/summernote.css" rel="stylesheet">
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
		  <li><a href="productslist.php">Productos</a></li>
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-7">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Editar producto</h3>
			<form class="form-horizontal" id="editar_productos">
				 
			  <div class="form-group">
				<label for="codigo" class="col-sm-2 control-label">Código</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $codigo;?>" required>
				  <input type="hidden" value="<?php echo $id_producto;?>" id="id_producto" name="id_producto">		
				</div>
			  </div>
			  <div class="form-group">
				<label for="modelo" class="col-sm-2 control-label">Modelo</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="modelo" value="<?php echo $modelo;?>" name="modelo">
				</div>
			  </div>
			  <div class="form-group">
				<label for="producto" class="col-sm-2 control-label">Producto</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="producto" value="<?php echo $producto;?>" required name="producto">
				</div>
			  </div>
			  <div class="form-group">
				<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
				<div class="col-sm-10">
				  <textarea class="form-control " rows="5" id="descripcion" required name="descripcion"><?php echo $descripcion;?></textarea>
				</div>
			  </div>
			  <div class="form-group">
				<label for="id_fabricante" class="col-sm-2 control-label">Fabricante</label>
				<div class="col-sm-10">
				  <select class="form-control" id="id_fabricante" name="id_fabricante" required>
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
			  </div>
			  <div class="form-group">
				<label for="id_categoria" class="col-sm-2 control-label">Categoría</label>
				<div class="col-sm-10">
				  <select class="form-control" id="cat" name="cat" required>
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
			  </div>
			  <div class="form-group">
				<label for="estado" class="col-sm-2 control-label">Estado</label>
				<div class="col-sm-10">
				  <select class="form-control" id="estado" required name="estado">
					<option value="0" <?php if ($status_producto==0){echo "selected";}?>>Inactivo</option>
					<option value="1" <?php if ($status_producto==1){echo "selected";}?>>En Stock</option>
					<option value="2" <?php if ($status_producto==2){echo "selected";}?>>Disponible</option>
				 </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="price" class="col-sm-2 control-label">Precio</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="price" name="price" value="<?php echo number_format($price,2,'.','');?>">
				</div>
			  </div>
			  <div class="form-group">
				<label for="price_offer" class="col-sm-2 control-label">Oferta</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="price_offer" name="price_offer" value="<?php echo number_format($price_offer,2,'.','');?>">
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
			<h3><span class="glyphicon glyphicon-edit"></span> Datos técnicos</h3>
			<div class='text-right'>
			<a href="#"  data-toggle="modal" data-target="#myModal"><i class='glyphicon glyphicon-plus'></i>
				  Agregar
			</a>
			</div>
			<div id="ms4">
			<?php
			$sql_ficha=mysqli_query($con,"select * from ficha_tecnica where id_producto='$id_producto'");
			$num=mysqli_num_rows($sql_ficha);
			if ($num>0){
			?>
			<table class="table">
				<tr>
					<th>Propiedad</th>
					<th>Valor</th>
					<td></td>
				</tr>
				<?php
					while ($rw_ficha=mysqli_fetch_array($sql_ficha)){
						$descripcion_ficha=$rw_ficha['descripcion_ficha'];
						list($propiedad,$valor)=explode("||",$descripcion_ficha);
						$id_ficha=$rw_ficha['id_ficha'];
						?>
						<tr>
							<td><?php echo $propiedad;?></td>
							<td><?php echo $valor;?></td>
							<td><a href='#' onclick="eliminar_ficha('<?php echo $id_ficha;?>')"><i class='glyphicon glyphicon-trash'></i></a></td>
						</tr>
						<?php
					}
				?>
			</table>
			<?php
			}
			?>
			</div>
		</div>
		<div class="col-md-5">
		 <h3 ><span class="glyphicon glyphicon-picture"></span> Imágenes</h3>
		 <form class="form-horizontal">
		 
			<div class="form-group">
				<label for="fileToUpload" class="col-sm-3 control-label">Imagen principal</label>
				<div class="col-sm-9">
				
				 
				 <div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 250px;" >
									  <img class="img-rounded" src="../<?php echo $img;?>" />
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;"></div>
								  <div>
									<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
									<span class="fileinput-exists" onclick="upload_image();">Cambiar imagen</span><input type="file" name="fileToUpload" id="fileToUpload" required onchange="upload_image();"></span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Cancelar</a>
								  </div>
					</div>
					<div class="upload-msg"></div>
					
				</div>
			  </div>
			  
			<div class="form-group">
				<label for="fileToUpload" class="col-sm-3 control-label">Imagen miniatura</label>
				<div class="col-sm-9">
				
				 
				 <div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 250px;" >
									  <img class="img-rounded" src="../<?php echo $tumb;?>" />
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;"></div>
								  <div>
									<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
									<span class="fileinput-exists" >Cambiar imagen</span><input type="file" name="fileToUpload1" id="fileToUpload1" required onchange="upload_image1();"></span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Cancelar</a>
								  </div>
					</div>
					<div class="upload-msg1"></div>
					
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="fileToUpload" class="col-sm-3 control-label">Más Imágenes</label>
				<div class="col-sm-9">
				
				 
				 <div class="fileinput fileinput-new" data-provides="fileinput">
								  <div>
									<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
									<span class="fileinput-exists" >Agregar otra imagen</span><input type="file" name="fileToUpload2" id="fileToUpload2" required onchange="upload_image2();"></span>
									
								  </div>
					</div>
					<div class="upload-msg2">
					<?php
					$query_images=mysqli_query($con,"select * from images where id_producto='$id_producto'");
					while ($rw_images=mysqli_fetch_array($query_images)){
						$url=$rw_images['url'];
						$id_image=$rw_images['id_image'];
						?>
						<div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 250px;" >
						  <img class="img-rounded" src="../<?php echo $url;?>" />
						  <a href="#" onclick="eliminar('<?php echo $id_image;?>');"><i class='glyphicon glyphicon-trash'></i> Eliminar</a>
						</div>
						 
						<?php
					}
					?>
					</div>
					
				</div>
			  </div>
			  <h3 ><span class="glyphicon glyphicon-download"></span> Documentos</h3>
			  
			   <div class="form-group">
				<label for="fileToUpload" class="col-sm-3 control-label">Documentos PDF</label>
				<div class="col-sm-9">
				
				 
				 <div class="fileinput fileinput-new" data-provides="fileinput">
								  <div>
									<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una archivo</span>
									<span class="fileinput-exists" >Agregar otro archivo</span><input type="file" name="fileToUpload3" id="fileToUpload3" required onchange="upload_pdf();"></span>
									
								  </div>
					</div>
					<div class="upload-msg3">
					<table class='table table-condensed'>
					<?php
					$query_pdf=mysqli_query($con,"select * from archivos_pdf where id_producto='$id_producto'");
					while ($rw_pdf=mysqli_fetch_array($query_pdf)){
						$url_archivo=$rw_pdf['url_archivo'];
						$descripcion_archivo=$rw_pdf['descripcion_archivo'];
							$id_archivo=$rw_pdf["id_archivo"];
						?>
						<tr>
							<td><a href='../<?php echo $url_archivo;?>' target='_blank'><?php echo $descripcion_archivo;?></a></td>
							<td> <a href='#' onclick="eliminar_pdf('<?php echo $id_archivo;?>');"><i class='glyphicon glyphicon-trash'></i> </a></td>
						</tr>
						 
						<?php
					}
					?>
					</table>
					</div>
					
				</div>
			  </div>
			  
		 </form>
		</div>
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
	</div><!-- /container -->
	<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" id="datos_tecnicos">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Datos técnicos</h4>
			  </div>
			  <div class="modal-body">
				
					  <div class="form-group">
						<label for="propiedad" class="col-sm-2 control-label">Propiedad</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="propiedad" name="propiedad" placeholder="Propiedad" required>
							<input type="hidden" id="id_producto_ficha" name="id_producto_ficha" value="<?php echo $id_producto;?>">	
						</div>
					  </div>
					  <div class="form-group">
						<label for="valor" class="col-sm-2 control-label">Valor</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required>
						</div>
					  </div>
					 
					 
					
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
				 </div>
			  </form>
			</div>
		  </div>
		</div>
		<?php include("footer.php");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script src="summernote/summernote.min.js"></script>
  </body>
</html>
	<script>
			function upload_image(){
				$(".upload-msg").text('Cargando...');
				var id_producto=$("#id_producto").val();
				var inputFileImage = document.getElementById("fileToUpload");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				data.append('id',id_producto);
				
				$.ajax({
					url: "ajax/upload.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
			function upload_image1(){
				$(".upload-msg1").text('Cargando...');
				var id_producto=$("#id_producto").val();
				var inputFileImage = document.getElementById("fileToUpload1");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				data.append('id',id_producto);
				
				$.ajax({
					url: "ajax/upload1.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg1").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
			
			function upload_image2(){
				$(".upload-msg2").text('Cargando...');
				var id_producto=$("#id_producto").val();
				var inputFileImage = document.getElementById("fileToUpload2");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				data.append('id',id_producto);
				
				$.ajax({
					url: "ajax/upload2.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg2").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
			function upload_pdf(){
				$(".upload-msg3").text('Cargando...');
				var id_producto=$("#id_producto").val();
				var inputFileImage = document.getElementById("fileToUpload3");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				data.append('id',id_producto);
				
				$.ajax({
					url: "ajax/upload_pdf.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg3").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
			function eliminar(id){
				var parametros = {"action":"delete","id":id};
						$.ajax({
							url:'ajax/upload2.php',
							data: parametros,
							 beforeSend: function(objeto){
							$(".upload-msg2").text('Cargando...');
						  },
							success:function(data){
								$(".upload-msg2").html(data);
								
							}
						})
					
				}
				
				function eliminar_pdf(id){
				var parametros = {"action":"delete","id":id};
						$.ajax({
							url:'ajax/upload_pdf.php',
							data: parametros,
							 beforeSend: function(objeto){
							$(".upload-msg3").text('Cargando...');
						  },
							success:function(data){
								$(".upload-msg3").html(data);
								
							}
						})
					
				}
				
				function eliminar_ficha(id){
				var parametros = {"action":"delete","id":id};
						$.ajax({
							url:'ajax/datos_tecnicos.php',
							data: parametros,
							 beforeSend: function(objeto){
							$("#ms4").text('Cargando...');
						  },
							success:function(data){
								$("#ms4").html(data);
								
							}
						})
					
				}
			
	</script>
	<script>
		$("#editar_productos").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_producto.php",
				  type: "POST",
				  data: $("#editar_productos").serialize(),
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
		$("#datos_tecnicos").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/datos_tecnicos.php",
				  type: "POST",
				  data: $("#datos_tecnicos").serialize(),
				   beforeSend: function(objeto){
					$("#ms4").html("Cargando...");
				  },
				  success:function(data){
						$("#ms4").html(data).fadeIn('slow');
						
					}
			});
			 e.preventDefault();
		});
	</script>
	
	<script>
$(document).ready(function() {
$('#descripcion').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	['link',['linkDialogShow', 'unlink','video']],
	['view', ['codeview']],
    
  ],height: 200,
  focus: true 
  
});

$('#descripcion').summernote('code','<?php echo $descripcion;?>');

});
</script>
