<div class="container">
	<!-- Static navbar -->
      <nav class="navbar navbar-default menu">
        <div class="container-fluid menu_left">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="<?php if (isset($active_index)){echo $active_index;}?>"><a class="menu_a" href="">INICIO</a></li>
              <li class="<?php if (isset($active_nosotros)){echo $active_nosotros;}?>"><a class="menu_a" href="nosotros">QUIENES SOMOS</a></li>
              <li class="<?php if (isset($active_servicio)){echo $active_servicio;}?>"><a class="menu_a" href="servicio">SERVICIO AL CLIENTE</a></li>
       <!--       <li class="<?php if (isset($active_contacto)){echo $active_contacto;}?>"><a class="menu_a" href="contactenos">CONTACTENOS</a></li> --> 
			<!--	  
			  <li class="<?php if (isset($active_cuenta)){echo $active_cuenta;}?>"><a class="menu_a" href="cuenta.php">MI PERFIL</a></li>
			  <li class="<?php if (isset($active_datos)){echo $active_datos;}?>"><a class="menu_a" href="datos.php">ACTUALIZAR</a></li>
            -->
			<li class="<?php if (isset($active_cuenta)){echo $active_cuenta;}?>">
				<?php
				    if($_SESSION['estado']=='A'){
						echo "<a class='menu_a' href='cuenta.php'>MI PERFIL</a>";
					}
				?>
				</li>	
				 <li class="<?php if (isset($active_datos)){echo $active_datos;}?>">
				<?php
				    if($_SESSION['estado']=='A'){
						echo "<a class='menu_a' href='datos.php'>ACTUALIZAR</a>";
					}else{
						echo "<a class='menu_a' href='sersocio.php'>SER SOCIO ACTIVO</a>";
					}
				?>
				</li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav
</div>
<div class="row-fluid slider_container">
    <div class="container slider">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 diapo_l">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<?php 
				$data_slide_to=0;
				$sql_slider=mysqli_query($con,"select * from slider where estado=1 order by orden");
				$nums_slides=mysqli_num_rows($sql_slider);
				?>
				<!-- Indicators -->
				  <ol class="carousel-indicators">
				<?php
				$active_slide="active";
				for ($i=0; $i<$nums_slides; $i++){
					?>
					<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" class="<?php echo $active_slide;?>"></li>
					<?php
					$active_slide="";
				}
				?>
				</ol>
				<?php
				while ($rw_slider=mysqli_fetch_array($sql_slider)){
				?>
				
				 <!-- Wrapper for slides -->
				 <?php 
					if ($data_slide_to==0){
						echo "<div class=\"carousel-inner\" role=\"listbox\">";
						$active="active";
					}
				 ?>
				  
					<div class="item <?php echo $active;?>">
					  <img src="img/slider/<?php echo $rw_slider['url_image'];?>" alt="..." class="img-responsive">
					  <div class="slide-text">
						<h3><?php echo $rw_slider['titulo'];?></h3>
						<p><?php echo $rw_slider['descripcion'];?></p>
						<a class='btn btn-<?php echo $rw_slider['estilo_boton'];?> text-right' href="<?php echo $rw_slider['url_boton'];?>"><?php echo $rw_slider['texto_boton'];?></a>
					  </div>
					  <div class="carousel-caption">
						
						
					  </div>
					</div>
					
					
				  
				<?php
				$active="";
				$data_slide_to++;				
				}
			?>
              
			   </div> 	
              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
              </a>
            </div>
		
          </div>
			<div class="">
		  <!--abrr
		<img src="../intranet/Files/Socios/1234.png">
		-->
		<img src="../intranet/<?php echo $_SESSION['foto_socio'];?>" width="263px" height=""  class="img-responsive" />
		<!-- <img src="panel/<?php //echo $business_logo_url;?>" class="img-responsive"> -->

		<font style="color:green;font-size:20px"><?php echo $_SESSION['nombres'].' '.$_SESSION['paterno'].' '.$_SESSION['materno'];?></font>
        </div>
	</div>

</div>
