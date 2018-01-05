<!-- Marcas -->
<div class="container-fluid marcas">
  <div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-12">
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner"><!-- Inner Inicio-->
          <div class="item  active">
            <div class="row">
         		<?php 
					$nums=1;
					$sql_marcas=mysqli_query($con,"select * from fabricantes");
					$count=mysqli_num_rows($sql_marcas);
					while ($rw_marcas=mysqli_fetch_array($sql_marcas)){
						$logo_url=$rw_marcas['logo_url'];
						$id_fabricante=intval($rw_marcas['id_fabricante']);
						$nombre_fabricante=$rw_marcas['nombre_fabricante'];
						
						
					?>
					<div class="col-md-3">
						<a class="thumbnail" href="marca/<?php echo $id_fabricante;?>/<?php echo create_slug($nombre_fabricante)?>"><img class="img-responsive" alt="" src="img/marcas/<?php echo $logo_url;?>"></a>
					</div>
					<?php
						if ($nums%4==0 and $nums!=$count){
						?>
						</div>
						</div>
						<div class="item">
						<div class="row">
						<?php	
						
						}
						$nums++;
					}	
					
				?>
					
            </div>
          </div>
         
         
        </div><!-- Inner FIN-->
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>
</div> 
</div>
<!-- Fin Marcas -->