<div class ="col-xs-12 col-sm-12 col-md-12 col-lg-9 productos_con">
	<?php 
		$nums=1;
		$sql_productos=mysqli_query($con,"select * from productos where status_producto!=0 order by id_producto desc limit 0,12");
		//$sql_productos=mysqli_query($con,"select * from articulo where estado='A' order by idarticulo desc limit 0,12");
		while($row=mysqli_fetch_array($sql_productos)){
			$id_producto=intval($row['id_producto']);
			$id_categoria=intval($row['id_categoria']);
			$slug=create_slug($row['nombre_producto']);	
		/*
		$id_producto=intval($row['idproducto']);
			$id_categoria=intval($row['idcategoria']);
			$slug=create_slug($row['nombre']);	
			*/
		?>
	<!-- Inicio Producto -->
	<div class="col-sm-6 col-md-3 producto">
			<div class="thumbnail" >
					<h4 class="text-center"><span class="label label-info"><?php echo $row['modelo_producto'];?></span></h4>
					<a href="producto/<?php echo $id_producto;?>/<?php echo $slug;?>">
						<img src="<?php echo $row['tumb'];?>" class="img-responsive producto_img" alt="<?php echo $row['nombre_producto'];?>" title="<?php echo $row['nombre_producto'];?>">
					</a>
					<div class="caption">
						<div class="row">
							<div class="col-md-12 col-xs-12 text-center">
								<p><strong><?php echo $row['nombre_producto'];?></strong></p>
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<a href="producto/<?php echo $id_producto;?>/<?php echo $slug;?>" class="btn btn-info btn-block btn-product"><span class="glyphicon glyphicon-list"></span> Ver detalles</a>
							</div>
						</div>

					</div>
			</div>
	</div>
	<!-- Fin Producto -->		
		<?php
		if ($nums%4==0){
			echo "<div class='clearfix'></div>";
		}
		$nums++;
		}
	?>
	
	<!-- Inicio Producto
	<div class="col-sm-6 col-md-3 producto">
			<div class="thumbnail" >
					<h4 class="text-center"><span class="label label-info">Datalogic</span></h4>
					<img src="http://www.pos99.com.au/media/catalog/product/cache/1/small_image/300x/9df78eab33525d08d6e5fb8d27136e95/d/a/datalogic_qd2130_stand.jpg" class="img-responsive producto_img">
					<div class="caption">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<p><strong>Datalogic QScan Imager QD2130 USB</strong></p>
							</div>
							<div class="col-md-6 col-xs-6 price">
								<h3>
								<label>$649.99</label></h3>
							</div>
						</div>
						<p><small>Linear Imager KBW/USB/Wand/RS-232 Multi-Interface, Black Kit Includes Imager, Stand and USB Cable.</small></p>
						<div class="row">
							<div class="col-md-12">
								<a href="#" class="btn btn-success btn-block btn-product"><span class="glyphicon glyphicon-shopping-cart"></span>Cotizar Producto</a></div>
						</div>

					</div>
			</div>
	</div>
	 Fin Producto -->

</div>
</div> <!-- Final de Container Sidebar  !-->

