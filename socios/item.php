<div class ="col-xs-12 col-sm-12 col-md-12 col-lg-9 productos_con">
	<div class="row-fluid">
	   <ol class="breadcrumb">
		  <li><a href=""> <i class="glyphicon glyphicon-home"></i> Inicio</a></li>
		  <li><a href="categoria/<?php echo intval($id_categoria_padre);?>/<?php echo create_slug($categoria_principal)?>"><?php echo $categoria_principal;?></a></li>
		  <?php 
			if ($categoria_padre!=0){
		  ?>
		  <li><a  href="categoria/<?php echo intval($categoria);?>/<?php echo create_slug($categoria_principal)?>/<?php echo create_slug($categoria_level)?>"><?php echo $categoria_level;?></a></li>
			<?php }?>
			<li class="active"><?php echo $nombre_producto;?></li>
			
		</ol>
			
	</div>
<!-- Inicio Detalle -->
    <!-- Imagen -->
	<div class="col-xs-12 col-sm-4 img_producto row">
         <a href="<?php echo $imagen_producto;?>" class="thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-title="<?php echo $nombre_producto;?>"> 
            <img src="<?php echo $imagen_producto;?>" class="img-responsive" alt="<?php echo $nombre_producto;?>" title="<?php echo $nombre_producto;?>">
         </a>
		 <div class="row">
		 <?php 
			$count_img=3;
			$sql_images=mysqli_query($con,"select * from images where id_producto='$id_producto'");
			while ($rw_image=mysqli_fetch_array($sql_images)){
				?>
				<div class="col-xs-6 col-sm-6">
					 <a href="<?php echo $rw_image['url'];?>" class="thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-title="<?php echo $nombre_producto;?>"> 
						<img src="<?php echo $rw_image['url'];?>" class="img-responsive" alt="<?php echo $nombre_producto;?>" title="<?php echo $nombre_producto;?>">
					 </a>
				</div>
				<?php
				if ($count_img%2==0){
					echo "<div class='clearfix'></div>";
				}
				$count_img++;
			}
		 ?>
         </div>
        
		
	</div>
	<!-- Descripcion --> 
	<div class="col-xs-12 col-sm-8 des_producto ">
		<h1 class="h1_producto"><?php echo $nombre_producto;?></h1>
		<?php 
				if ($show_price==1){
					echo "<h3 class='text-info'>Precio: $business_currency_symbol ".number_format($price,2)."</h3>";
					$text_quote="Comprar";
					$text_modal="Enviar orden";
					$text_consulta="Estoy interesado en el producto";
				} else {
					$text_quote="Cotizar producto";
					$text_modal="Consultar precio";
					$text_consulta="Por favor, envíeme listado de precios";
				}
		?>
		<p class="stock_producto">
				Modelo: <strong><span class='text-muted'><?php echo $modelo_producto;?></span></strong>
				
		</p>
		<p class="h3_precio">
			<?php 
				$sql_fabricante=mysqli_query($con,"select nombre_fabricante from fabricantes where id_fabricante='$id_fabricante'");
				$rw_fabricante=mysqli_fetch_array($sql_fabricante);
				$nombre_fabricante= $rw_fabricante['nombre_fabricante'];
			?>
			<span class="h3_marca">
			Fabricante: 
			<a href="marca/<?php echo $id_fabricante;?>/<?php echo create_slug($nombre_fabricante);?>"><?php echo $nombre_fabricante;?></a>
			</span>
			
		</p>
		

		
		
			<p class="stock_producto">
				Disponibilidad:
				<?php 
					if ($status_producto==1){
						?>
						<strong><span class='text-success'>En Stock</span></strong>
						<?php
					}
					if ($status_producto==2){
						?>
						<strong><span class='text-warning'>Consulte disponibilidad</span></strong>
						<?php
					}
				?>
				

			
			</p>
		
		<div class="input-group col-xs-12 col-sm-5">
			
			<input type="hidden" class="form-control" value="<?php echo intval($id_producto);?>" id="id_producto">
			
				<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal">
					<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> <?php echo $text_quote;?>
				</button>
			
		</div><!-- /input-group -->
		<br>
	</div>
<!-- Fin Detalle -->
<!-- Inicio Tabs -->
<div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Descripción</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Especificaciones</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Descargas</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                        	<?php echo $descripcion;?>

                        </div>
                        <div class="tab-pane fade" id="tab2default">
							<table class="table table-bordred table-striped">
								<tr>
									<td colspan=2><strong>Ficha Técnica</strong></td>
									<td colspan=2></td>
								</tr>
                        	<?php
								$sql_ficha=mysqli_query($con,"select * from ficha_tecnica where id_producto='$id_producto'");
								while ($rw_ficha=mysqli_fetch_array($sql_ficha)){
									$descripcion_ficha=$rw_ficha['descripcion_ficha'];
									list($propiedad,$valor)=explode("||",$descripcion_ficha);
									?>
								<tr>
									<td><strong><?php echo $propiedad;?></strong></td>
									<td><?php echo $valor;?></td>
									<td></td>
									<td></td>
								</tr>								
									<?php
								}
							?>
							</table>
                        </div>
                        <div class="tab-pane fade" id="tab3default">
                        	<table class="table table-bordred table-striped">
								<tr>
									<td colspan=2><strong>Descripción</strong></td>
									<td colspan=2></td>
								</tr>
								<tr>
									<td>Ficha Técnica de <?php echo $nombre_producto;?></td>
									<td><a href="ficha-tecnica/<?php echo $id_producto;?>/<?php echo create_slug($nombre_producto);?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-download"></i> Descargar Archivo</a></td>
									<td></td>
									<td></td>
								</tr>
                        	<?php
								$sql_pdf=mysqli_query($con,"select * from archivos_pdf where id_producto='$id_producto'");
								while ($rw_pdf=mysqli_fetch_array($sql_pdf)){
									$descripcion_archivo=$rw_pdf['descripcion_archivo'];
									$url_archivo=$rw_pdf['url_archivo'];
									?>
								<tr>
									<td><?php echo $descripcion_archivo;?></td>
									<td><a href="<?php echo $url_archivo?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-download"></i> Descargar Archivo</a></td>
									<td></td>
									<td></td>
								</tr>								
									<?php
								}
							?>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Fin Tabs-->
</div>
</div> <!-- Final de Container Sidebar -->

</div> <!-- Final de Container Sidebar 

	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Consultar precio</h4>
      </div>
      <div class="modal-body">
	  <div id="resultados_ajax" class="text-center"></div>
        <form class="form-horizontal"  method="post" id="guardar_datos">


<!-- Textarea -->
<div class="form-group">
  <label class="col-md-3 control-label" for="mensaje">Tu consulta</label>
  <div class="col-md-8">                     
    <textarea rows="3" class="form-control" id="mensaje" name="mensaje"><?php echo $text_consulta;?> "<?php echo $nombre_producto.", modelo: ".$modelo_producto; ?>"
	</textarea>
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="nombres">Cantidad</label>  
  <div class="col-md-8">
 <input type="number" min="1" class="form-control" value="1" id="cantidad" required>
  <span class="help-block">Cantidad de productos que deseas agregar</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="nombres">Tu nombre</label>  
  <div class="col-md-8">
  <input id="nombres" name="nombres" type="text" placeholder="Nombres y Apellidos" class="form-control" required="">
  <span class="help-block">Quisiéramos saber como tratarte</span>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="telefono">Teléfono</label>  
  <div class="col-md-8">
  <input id="telefono" name="telefono" type="text" placeholder="Nº de télefono" class="form-control" required="">
  <span class="help-block">Ingresa un número de teléfono</span>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="email">Tu email</label>  
  <div class="col-md-8">
  <input id="email" name="email" type="email" placeholder="Correo eléctronico" class="form-control" required="">
  <span class="help-block">La respuesta a la pregunta llegará a ese E-mail</span>  
  </div>
</div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success"><?php echo $text_modal;?></button>
      </div>
	  </form>
    </div>
  </div>
</div>

