<div class ="col-xs-12 col-sm-12 col-md-9 col-lg-9 productos_con">
	<div class="row-fluid">
	   <ol class="breadcrumb">
		  <li><a href=""> <i class="glyphicon glyphicon-home"></i> Inicio</a></li>
		  <li class='active'><?php echo $nombre_fabricante;?></li>
		 </ol>
			
	</div>
	<?php 
		$per_page = 12; //how much records you want to show
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$offset = ($page - 1) * $per_page;
		$nums=1;
		$count_query   = mysqli_query($con, "select count(*) AS numrows from productos, fabricantes where productos.id_fabricante=fabricantes.id_fabricante and  productos.id_fabricante='$id_fabricante' and productos.status_producto!=0");
		$rows= mysqli_fetch_array($count_query);
		$numrows = $rows['numrows'];
		$total_pages = ceil(($numrows) / $per_page);
		$sql_productos=mysqli_query($con,"select * from productos, fabricantes where productos.id_fabricante=fabricantes.id_fabricante and  productos.id_fabricante='$id_fabricante' and productos.status_producto!=0 order by productos.nombre_producto limit $offset,$per_page");
		while($row=mysqli_fetch_array($sql_productos)){
			$id_producto=intval($row['id_producto']);
			$id_categoria=intval($row['id_categoria']);
			$slug=create_slug($row['nombre_producto']);
			
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
		<div class='clearfix'></div>
		<?php 
			if ($total_pages>1){
		?>
		<nav class="text-right">
		  <ul class="pagination">
			<li>
			  <a href="pagina/1/marca/<?php echo $id_fabricante;?>/<?php echo $lbl_marca;?>" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
			  </a>
			</li>
			<?php 
				 for ($i = 1; $i <= $total_pages; $i++) {
					 if ($i==$page){$active="active";}
					 else {$active="";}
					 ?>
					 <li class="<?php echo $active;?>"><a href="pagina/<?php echo $i;?>/marca/<?php echo $id_fabricante;?>/<?php echo $lbl_marca;?>"><?php echo $i;?></a></li>
					 <?php
				 }
			?>
		
			<li>
			  <a href="pagina/<?php echo $total_pages;?>/marca/<?php echo $id_fabricante;?>/<?php echo $lbl_marca;?>" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			  </a>
			</li>
		  </ul>
		</nav>
			<?php }?>

</div>
</div> <!-- Final de Container Sidebar 