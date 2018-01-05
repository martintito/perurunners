<div class="row-fluid principales">
	<div class="container">
	<?php
	$sql_banner_bottom=mysqli_query($con,"select * from banner where estado=1 and posicion=2 order by orden limit 0,4");
	while ($rw_banner_bottom=mysqli_fetch_array($sql_banner_bottom)){
		?>
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 thumbnail" style="border: 0px solid #ddd;">
			<h3 class='text-center'><?php echo $rw_banner_bottom['titulo'];?></h3>
			<a href="<?php echo $rw_banner_bottom['url_boton'];?>" >
				<img src="img/banner/<?php echo $rw_banner_bottom['url_image'];?>" class="img-responsive">
			</a>
		</div>
	<?php	
	}
	?>
		
		
	</div>
</div>